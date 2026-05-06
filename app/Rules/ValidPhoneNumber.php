<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberUtil;

class ValidPhoneNumber implements ValidationRule
{
    /**
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value) || ! str_starts_with($value, '+')) {
            $fail('The :attribute must be in international format (e.g. +380501234567).');

            return;
        }

        $util = PhoneNumberUtil::getInstance();

        try {
            $parsed = $util->parse($value);
        } catch (NumberParseException) {
            $fail('The :attribute is not a valid phone number.');

            return;
        }

        if (! $util->isValidNumber($parsed)) {
            $fail('The :attribute is not a valid phone number.');
        }
    }
}
