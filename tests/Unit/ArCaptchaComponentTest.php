<?php

namespace Milad\FilamentArCaptchaField\Tests\Unit;

use Milad\FilamentArCaptchaField\Forms\Components\ArCaptcha;
use Milad\FilamentArCaptchaField\Tests\TestCase;
use Mohammadv184\ArCaptcha\ArCaptcha as ArCaptchaLib;

class ArCaptchaComponentTest extends TestCase
{
    public function test_can_create_arcaptcha_component(): void
    {
        $component = ArCaptcha::make('captcha');

        $this->assertInstanceOf(ArCaptcha::class, $component);
        $this->assertEquals('captcha', $component->getName());
    }

    public function test_get_site_key_from_config(): void
    {
        $component = ArCaptcha::make('captcha');

        $this->assertEquals('test-site-key', $component->getSiteKey());
    }

    public function test_get_secret_key_from_config(): void
    {
        $component = ArCaptcha::make('captcha');

        $this->assertEquals('test-secret-key', $component->getSecretKey());
    }

    public function test_can_set_custom_site_key(): void
    {
        $component = ArCaptcha::make('captcha')
            ->siteKey('custom-site-key');

        $this->assertEquals('custom-site-key', $component->getSiteKey());
    }

    public function test_can_set_custom_secret_key(): void
    {
        $component = ArCaptcha::make('captcha')
            ->secretKey('custom-secret-key');

        $this->assertEquals('custom-secret-key', $component->getSecretKey());
    }

    public function test_can_set_site_key_via_closure(): void
    {
        $component = ArCaptcha::make('captcha')
            ->siteKey(fn () => 'closure-site-key');

        $this->assertEquals('closure-site-key', $component->getSiteKey());
    }

    public function test_get_options_merges_with_config(): void
    {
        $component = ArCaptcha::make('captcha')
            ->options(['lang' => 'en']);

        $options = $component->getOptions();

        $this->assertEquals('en', $options['lang']);
        $this->assertEquals('light', $options['theme']);
    }

    public function test_get_options_returns_config_when_no_custom_options(): void
    {
        $component = ArCaptcha::make('captcha');

        $options = $component->getOptions();

        $this->assertEquals('fa', $options['lang']);
        $this->assertEquals('light', $options['theme']);
    }

    public function test_get_arcaptcha_instance(): void
    {
        $component = ArCaptcha::make('captcha');

        $instance = $component->getArCaptchaInstance();

        $this->assertInstanceOf(ArCaptchaLib::class, $instance);
    }

    public function test_get_arcaptcha_instance_with_custom_keys(): void
    {
        $component = ArCaptcha::make('captcha')
            ->siteKey('custom-site')
            ->secretKey('custom-secret');

        $instance = $component->getArCaptchaInstance();

        $this->assertInstanceOf(ArCaptchaLib::class, $instance);
    }

    public function test_view_is_set_correctly(): void
    {
        $component = ArCaptcha::make('captcha');

        $this->assertEquals('filament-arcaptcha-field::components.arcaptcha', $component->getView());
    }

    public function test_fluent_methods_return_instance(): void
    {
        $component = ArCaptcha::make('captcha');

        $this->assertSame($component, $component->siteKey('test'));
        $this->assertSame($component, $component->secretKey('test'));
        $this->assertSame($component, $component->options([]));
    }
}

