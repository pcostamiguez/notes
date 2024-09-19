<?php

namespace App\Services;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class Utils
{
    public static function decryptId(string $id): string|RedirectResponse
    {
        try {
            $decryptedId = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            Log::error(static::class . " - method: Utils::decryptId: " . $e->getMessage());
            return redirect()->route('home.index')->with('error', 'Failed to decrypt ID');
        }
        return $decryptedId;
    }
}
