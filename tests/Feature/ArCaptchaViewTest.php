<?php

namespace Milad\FilamentArCaptchaField\Tests\Feature;

use Milad\FilamentArCaptchaField\Forms\Components\ArCaptcha;
use Milad\FilamentArCaptchaField\Tests\TestCase;

class ArCaptchaViewTest extends TestCase
{
    public function test_view_can_be_rendered(): void
    {
        $component = ArCaptcha::make('captcha');

        $view = view($component->getView(), [
            'field' => $component,
            'getFieldWrapperView' => fn () => 'filament::components.field-wrapper',
            'getId' => fn () => 'test-id',
            'getStatePath' => fn () => 'captcha',
        ]);

        $html = $view->render();

        $this->assertStringContainsString('arcaptcha-widget-test-id', $html);
    }

    public function test_view_contains_site_key(): void
    {
        $component = ArCaptcha::make('captcha')
            ->siteKey('test-site-key');

        $view = view($component->getView(), [
            'field' => $component,
            'getFieldWrapperView' => fn () => 'filament::components.field-wrapper',
            'getId' => fn () => 'test-id',
            'getStatePath' => fn () => 'captcha',
        ]);

        $html = $view->render();

        $this->assertStringContainsString('test-site-key', $html);
    }

    public function test_view_contains_arcaptcha_script(): void
    {
        $component = ArCaptcha::make('captcha');

        $view = view($component->getView(), [
            'field' => $component,
            'getFieldWrapperView' => fn () => 'filament::components.field-wrapper',
            'getId' => fn () => 'test-id',
            'getStatePath' => fn () => 'captcha',
        ]);

        $html = $view->render();

        $this->assertNotEmpty($html);
    }

    public function test_view_has_alpine_data(): void
    {
        $component = ArCaptcha::make('captcha');

        $view = view($component->getView(), [
            'field' => $component,
            'getFieldWrapperView' => fn () => 'filament::components.field-wrapper',
            'getId' => fn () => 'test-id',
            'getStatePath' => fn () => 'captcha',
        ]);

        $html = $view->render();

        $this->assertStringContainsString('x-data', $html);
        $this->assertStringContainsString('arcaptchaResponse', $html);
    }

    public function test_view_has_callback_functionality(): void
    {
        $component = ArCaptcha::make('captcha');

        $view = view($component->getView(), [
            'field' => $component,
            'getFieldWrapperView' => fn () => 'filament::components.field-wrapper',
            'getId' => fn () => 'test-id',
            'getStatePath' => fn () => 'captcha',
        ]);

        $html = $view->render();

        $this->assertStringContainsString('callback', $html);
        $this->assertStringContainsString('expired-callback', $html);
    }

    public function test_view_has_reset_functionality(): void
    {
        $component = ArCaptcha::make('captcha');

        $view = view($component->getView(), [
            'field' => $component,
            'getFieldWrapperView' => fn () => 'filament::components.field-wrapper',
            'getId' => fn () => 'test-id',
            'getStatePath' => fn () => 'captcha',
        ]);

        $html = $view->render();

        $this->assertStringContainsString('reset', $html);
        $this->assertStringContainsString('arcaptcha-reset', $html);
    }
}

