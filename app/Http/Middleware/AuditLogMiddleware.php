<?php

namespace App\Http\Middleware;

use App\Services\Utils;
use Closure;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuditLogMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $startTime = microtime(true);
        $response = $next($request);
        $endTime = microtime(true);
        $executionTime = $endTime - $startTime;

        $executionTimeMs = number_format($executionTime * 1000, 2);

        if ($response->isSuccessful()) {
            $this->logAudit($request, 'success', $response->status(), $executionTimeMs);
        } elseif ($response->isRedirection()) {
            $this->logAudit($request, 'redirect', $response->status(), $executionTimeMs);
        } else {
            $this->logAudit($request, 'error', $response->status(), $executionTimeMs);
        }

        return $response;
    }

    protected function logAudit(Request $request, string $status, int $responseStatus, float $executionTime): void
    {
        $sendedInfo = $request->except('_token', '_method');

        $sendedInfo = [
            'method' => $request->method(),
        ];

        if ($request->route('id')) {
            $decryptedId = Utils::decryptId($request->route('id'));
            $sendedInfo['id'] = $decryptedId;
        }
        $urlSegments = explode('/', $request->fullUrl());
        foreach ($urlSegments as &$segment) {
            if ($this->isEncryptedId($segment)) {
                $segment = Utils::decryptId($segment);
            }
        }
        $decryptedUrl = implode('/', $urlSegments);

        $uriSegments = explode('/', $request->getRequestUri());
        foreach ($uriSegments as &$segment) {
            if ($this->isEncryptedId($segment)) {
                $segment = Utils::decryptId($segment);
            }
        }
        $decryptedUri = implode('/', $uriSegments);

        $otherData = $request->except('_method', '_token');
        if (!empty($otherData)) {
            $sendedInfo = array_merge($sendedInfo, $otherData);
        }

        if (!empty($sendedInfo)) {
            $audit = [
                'user_id' => $request->user()->id,
                'user_email' => $request->user()->email,
                'ip' => $request->ip(),
                'sended_info' => $sendedInfo,
                'created_at' => now()->toDateTimeString(),
                'status' => $status,
                'response_code' => $responseStatus,
                'url' => $decryptedUrl,
                'uri' => $decryptedUri,
                'execution_time' => $executionTime . 'ms',
            ];

            $auditJson = json_encode($audit, JSON_PRETTY_PRINT);
            $auditJson = stripslashes($auditJson);
            Log::info($auditJson);
        }
    }

    private function isEncryptedId(string $segment): bool
    {
        return preg_match('/^[A-Za-z0-9=]+$/', $segment) && strlen($segment) > 20;
    }



}
