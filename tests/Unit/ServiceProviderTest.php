<?php

namespace Milad\FilamentArCaptchaField\Tests\Unit;

use Milad\FilamentArCaptchaField\FilamentArCaptchaFieldServiceProvider;
use Milad\FilamentArCaptchaField\Tests\TestCase;

class ServiceProviderTest extends TestCase
{
    public function test_config_file_is_publishable(): void
    {
        $this->artisan('vendor:publish', [
            '--provider' => FilamentArCaptchaFieldServiceProvider::class,
            '--tag' => 'config',
        ])->assertSuccessful();

        $this->assertFileExists(config_path('filament-arcaptcha-field.php'));
    }

    public function test_config_values_are_loaded(): void
    {
        $this->assertEquals('test-site-key', config('filament-arcaptcha-field.site_key'));
        $this->assertEquals('test-secret-key', config('filament-arcaptcha-field.secret_key'));
        $this->assertEquals('fa', config('filament-arcaptcha-field.options.lang'));
        $this->assertEquals('light', config('filament-arcaptcha-field.options.theme'));
    }

    public function test_views_are_loaded(): void
    {
        $this->assertTrue(
            $this->app['view']->exists('filament-arcaptcha-field::components.arcaptcha')
        );
    }
}

