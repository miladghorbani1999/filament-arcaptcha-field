<?php

namespace Ghorbani\FilamentArCaptchaField\Forms\Components;

use Filament\Forms\Components\Field;
use Mohammadv184\ArCaptcha\ArCaptcha as ArCaptchaLib;

class ArCaptcha extends Field
{
    protected string $view = 'filament-arcaptcha-field::components.arcaptcha';

    protected string | \Closure | null $siteKey = null;

    protected string | \Closure | null $secretKey = null;

    protected array $options = [];

    public function siteKey(string | \Closure | null $siteKey): static
    {
        $this->siteKey = $siteKey;

        return $this;
    }

    public function secretKey(string | \Closure | null $secretKey): static
    {
        $this->secretKey = $secretKey;

        return $this;
    }

    public function options(array $options): static
    {
        $this->options = $options;

        return $this;
    }

    public function getSiteKey(): ?string
    {
        return $this->evaluate($this->siteKey) ?? config('filament-arcaptcha-field.site_key');
    }

    public function getSecretKey(): ?string
    {
        return $this->evaluate($this->secretKey) ?? config('filament-arcaptcha-field.secret_key');
    }

    public function getOptions(): array
    {
        return array_merge(config('filament-arcaptcha-field.options', []), $this->options);
    }

    public function getArCaptchaInstance(): ArCaptchaLib
    {
        return new ArCaptchaLib(
            $this->getSiteKey(),
            $this->getSecretKey(),
            $this->getOptions()
        );
    }

    public function verify(string $response): bool
    {
        return $this->getArCaptchaInstance()->verify($response);
    }
}

