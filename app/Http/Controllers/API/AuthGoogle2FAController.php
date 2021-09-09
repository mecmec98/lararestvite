<?php

namespace App\Http\Controllers\API;

use Auth;
use Google2FA;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthGoogle2FAGetQRCodeRequest;
use App\Http\Requests\AuthGoogle2FAVerifyCodeRequest;
use Illuminate\Http\JsonResponse;

/**
 * @group Multi-Factor Google
 * 
 * APIs for doing two factor authentication with Google
 */
class AuthGoogle2FAController extends Controller
{
    /**
     * Get QR Code
     *
     * This endpoint lets you get a QR code for a user.
     *
     * @authenticated
     * @param AuthGoogle2FAGetQRCodeRequest $request
     * @param User $user
     * @return void
     */
    public function getQRCode(AuthGoogle2FAGetQRCodeRequest $request, User $user): JsonResponse
    {
        $app_name = config('app.name');
        $username = $user->username;
        $qr =  Google2FA::getQRCodeInline(
            "$app_name:$username",
            $user->email,
            $user->google2fa_secret
        );
        if ($qr) {
            return response()->success(['qr' => $qr]);
        } else {
            return response()->error('Unable to generate QR');
        }
    }
    /**
     * Verify OTP
     *
     * This endpoint lets you verify the OTP from Google
     *
     * @param AuthGoogle2FAVerifyCodeRequest $request
     * @param User $user
     * @return JsonResponse
     */
    public function verifyCode(AuthGoogle2FAVerifyCodeRequest $request, int $id): JsonResponse
    {
        $user = Auth::user();
        // Get all 2FAs
        $google2fas = $user->google2fa->where('id', $id)->first();
        if (Google2FA::verifyKey($google2fas->secret_key, $request->code)) {
            \session(['googleVerified' => true]);
            return response()->success('code verified successfully');
        } else {
            return response()->error('unable to verify code');
        }
    }
}
