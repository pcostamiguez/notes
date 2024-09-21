<?php

namespace App\Http\Middleware;

use App\Models\AuditLog;
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

        $status = $this->isEffectiveAction($request, $response) ? 'success' : 'attempt';

        $this->logAudit($request, $status, $response->getStatusCode(), $executionTimeMs);

        return $response;
    }

    private function isEffectiveAction(Request $request, Response $response): bool
    {
        if (in_array($request->method(), ['PUT', 'POST', 'DELETE'])) {
            if ($response->isRedirection()) {
                return false;
            }

            return in_array($response->getStatusCode(), [200, 201, 204]);
        }
        return true;
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

        $url = rtrim($request->fullUrl(), '/');
        $decryptedUrl = $this->decryptUrlSegments($url);

        $uri = rtrim($request->getRequestUri(), '/');
        $decryptedUri = $this->decryptUrlSegments($uri);

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

            AuditLog::create($audit);
            //$auditJson = json_encode($audit, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
            //Log::info($auditJson);
        }
    }

    private function decryptUrlSegments(string $url): string
    {
        $segments = explode('/', $url);
        foreach ($segments as &$segment) {
            if ($this->isEncryptedId($segment)) {
                $segment = Utils::decryptId($segment);
            }
        }
        return implode('/', $segments);
    }

    private function decryptSegments(string $url): string
    {
        $segments = explode('/', $url);
        foreach ($segments as &$segment) {
            if ($this->isEncryptedId($segment)) {
                $segment = Utils::decryptId($segment);
            }
        }
        return implode('/', $segments);
    }

    private function isEncryptedId(string $segment): bool
    {
        return preg_match('/^[A-Za-z0-9=]+$/', $segment) && strlen($segment) > 20;
    }
}
