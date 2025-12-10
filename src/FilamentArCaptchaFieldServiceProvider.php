<?php

namespace Milad\FilamentArCaptchaField;

use Illuminate\Support\ServiceProvider;

class FilamentArCaptchaFieldServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../../config/filament-arcaptcha-field.php' => config_path('filament-arcaptcha-field.php'),
        ], 'config');

        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'filament-arcaptcha-field');
    }

    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/filament-arcaptcha-field.php',
            'filament-arcaptcha-field'
        );
    }
}

