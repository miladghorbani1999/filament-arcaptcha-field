<?php

namespace Ghorbani\FilamentArCaptchaField\Rules;

use Illuminate\Contracts\Validation\Rule;
use Mohammadv184\ArCaptcha\ArCaptcha;

class ArCaptchaRule implements Rule
{
    protected ArCaptcha $arcaptcha;

    public function __construct(?string $siteKey = null, ?string $secretKey = null, array $options = [])
    {
        $siteKey = $siteKey ?? config('filament-arcaptcha-field.site_key');
        $secretKey = $secretKey ?? config('filament-arcaptcha-field.secret_key');
        $options = array_merge(config('filament-arcaptcha-field.options', []), $options);

        $this->arcaptcha = new ArCaptcha($siteKey, $secretKey, $options);
    }

    public function passes($attribute, $value): bool
    {
        if (empty($value)) {
            return false;
        }

        return $this->arcaptcha->verify($value);
    }

    public function message(): string
    {
        return __('The :attribute verification failed. Please try again.');
    }
}

