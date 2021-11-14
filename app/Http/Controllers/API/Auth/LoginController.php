<?php

namespace App\Http\Controllers\API\Auth;

use Log;
use Sentinel;
use Authy\AuthyApi;
use App\Models\User;
use App\Events\User\UserLoggedIn;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;

/**
 * @group User Management
 */
class LoginController extends Controller
{
    const AUTHY_SMS_CANCELLED    = 0;
    const AUTHY_SMS_SUCCESS      = 1;
    const AUTHY_SMS_FAILED       = 2;

    /**
     * Login API
     * 
     * This endpoint allows you to login users.
     * @param UserLoginRequest $request
     * @return JsonResponse
     */
    public function login(UserLoginRequest $request): JsonResponse
    {
        $credentials = $this->processCredentials($request);
        # attempt to login
        if ($user = Sentinel::stateless($credentials)) {
            if ($user->hasMFA() && notLocal() && hasAuthyConfig()) {
                // If has phone number
                // @codeCoverageIgnoreStart
                $verify = $this->sendOTP($user);
                switch ($verify) {
                    case self::AUTHY_SMS_SUCCESS:
                        broadcast(new UserLoggedIn($user->id));
                        return response()->success([
                            'verify' => true,
                            'token' => $user->createToken(config('app.name') . ': ' . $user->username, $user->allPermissions())->accessToken,
                            'mfa_verified' => false,
                        ]);
                        break;
                    case self::AUTHY_SMS_CANCELLED:
                        broadcast(new UserLoggedIn($user->id));
                        return response()->success([
                            'token' => $user->createToken(config('app.name') . ': ' . $user->username, $user->allPermissions())->accessToken,
                            'mfa_verified' => false,
                        ]);
                        break;
                    case self::AUTHY_SMS_FAILED:
                        return response()->error('Critical Error', 500);
                        break;
                }
                // @codeCoverageIgnoreEnd
            } else {
                broadcast(new UserLoggedIn($user->id));
                return response()->success([
                    'token' => $user->createToken(config('app.name') . ': ' . $user->username, $user->allPermissions())->accessToken,
                    'mfa_verified' => false
                ]);
            }
        } else {
            return response()->error('Invalid User', 401);
        }
    }

    /**
     * Undocumented function
     *
     * @param UserLoginRequest $request
     * @return array
     */
    private function processCredentials(UserLoginRequest $request): array
    {
        $login_type = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        return [
            $login_type => $request->username,
            "password" => $request->password,
        ];
    }

    /**
     * Send Authy OTP
     *
     * @codeCoverageIgnore
     * @param User $user
     * @return bool
     */
    private function sendOTP(User $user): bool
    {
        if (notLocal() && hasAuthyConfig()) {
            $authy_api = new AuthyApi(config('authy.app_secret'));
            $sms = $authy_api->requestSms($user->authy_id);
            if ($sms->ok()) {
                return self::AUTHY_SMS_SUCCESS;
            } else {
                return self::AUTHY_SMS_FAILED;
            }
        } else {
            return self::AUTHY_SMS_CANCELLED;
        }
    }
}
