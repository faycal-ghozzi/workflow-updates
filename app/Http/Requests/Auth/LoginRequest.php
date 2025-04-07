<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate()
    {
        $this->ensureIsNotRateLimited();

        $credentials = [
            'samaccountname' => $this->username,
            'password' => $this->password,
        ];

        // Log the credentials for debugging
        Log::info('Attempting to authenticate user:', [
            'username' => $this->username,
            'credentials' => $credentials, // log all credentials (including password)
        ]);

        $authenticated = Auth::attempt($credentials, $this->filled('remember'));

        // Log the response of the authentication attempt
        Log::info('Authentication attempt response:', [
            'authenticated' => $authenticated,
            'username' => $this->username,
            'credentials' => $credentials, // optional: log credentials (be careful with passwords)
        ]);

        if (! $authenticated) {
            // Hit the rate limiter on failure
            RateLimiter::hit($this->throttleKey());

            // Log failed authentication attempt
            Log::warning('Authentication failed for user:', [
                'username' => $this->username,
                'credentials' => $credentials, // log credentials for debugging purposes
            ]);

            throw ValidationException::withMessages([
                'username' => __('auth.failed'),
            ]);
        }


        RateLimiter::clear($this->throttleKey());
        Log::info('User authenticated successfully:', [
            'username' => $this->username,
        ]);
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
    }
}
