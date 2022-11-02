<?php

namespace App\Rules;

use Illuminate\Support\Facades\Http;
use Illuminate\Contracts\Validation\InvokableRule;

class RecaptchaValidate implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        // dd('Validator invoked!');
        // $fail('halted for now: ' . $value);

        // dd(config('recaptcha.secret_key'));

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('recaptcha.secret_key'),
            'response' => $value,
            'remoteip' => request()->ip(),
        ]);

        $error = $response->json('error-codes');

        if ($error) {
            if (
                in_array('missing-input-response', $error) ||
                in_array('invalid-input-response', $error)
            ) {
                $fail('Please solve the ReCAPTCHA challenge.');
            } else if (
                in_array('missing-input-secret', $error) ||
                in_array('invalid-input-secret', $error)
            ) {
                $fail('The ReCAPTCHA secret key is either missing or invalid.');
            } else if (in_array('bad-request', $error)) {
                $fail('Unable to validate the ReCAPTCHA challenge.');
            } else if (in_array('timeout-or-duplicate', $error)) {
                $fail('The ReCAPTCHA challenge has expired, please try again.');
            }
        } else if (!$response->json('success')) {
            $fail('The ReCAPTCHA challange has failed. Please try again.');
        }
    }
}
