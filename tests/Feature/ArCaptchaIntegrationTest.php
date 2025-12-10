<?php

namespace Milad\FilamentArCaptchaField\Tests\Feature;

use Milad\FilamentArCaptchaField\Forms\Components\ArCaptcha;
use Milad\FilamentArCaptchaField\Rules\ArCaptchaRule;
use Milad\FilamentArCaptchaField\Tests\TestCase;
use Illuminate\Support\Facades\Validator;

class ArCaptchaIntegrationTest extends TestCase
{
    public function test_arcaptcha_component_can_be_used_in_form_schema(): void
    {
        $component = ArCaptcha::make('captcha')
            ->required();

        $this->assertTrue($component->isRequired());
        $this->assertEquals('captcha', $component->getName());
    }

    public function test_arcaptcha_rule_can_be_used_in_validation(): void
    {
        $validator = Validator::make(
            ['captcha' => 'test-response'],
            ['captcha' => ['required', new ArCaptchaRule()]]
        );

        $this->assertInstanceOf(\Illuminate\Validation\Validator::class, $validator);
    }

    public function test_arcaptcha_rule_fails_on_empty_value(): void
    {
        $validator = Validator::make(
            ['captcha' => ''],
            ['captcha' => ['required', new ArCaptchaRule()]]
        );

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('captcha', $validator->errors()->toArray());
    }

    public function test_arcaptcha_component_with_custom_configuration(): void
    {
        $component = ArCaptcha::make('captcha')
            ->siteKey('custom-site-key')
            ->secretKey('custom-secret-key')
            ->options(['lang' => 'en', 'theme' => 'dark']);

        $this->assertEquals('custom-site-key', $component->getSiteKey());
        $this->assertEquals('custom-secret-key', $component->getSecretKey());
        
        $options = $component->getOptions();
        $this->assertEquals('en', $options['lang']);
        $this->assertEquals('dark', $options['theme']);
    }

    public function test_arcaptcha_component_state_path(): void
    {
        $component = ArCaptcha::make('captcha')
            ->statePath('form.captcha');

        $this->assertInstanceOf(ArCaptcha::class, $component);
    }

    public function test_arcaptcha_component_can_be_disabled(): void
    {
        $component = ArCaptcha::make('captcha')
            ->disabled();

        $this->assertInstanceOf(ArCaptcha::class, $component);
    }

    public function test_arcaptcha_component_can_be_hidden(): void
    {
        $component = ArCaptcha::make('captcha')
            ->hidden();

        $this->assertInstanceOf(ArCaptcha::class, $component);
    }

    public function test_arcaptcha_component_can_have_label(): void
    {
        $component = ArCaptcha::make('captcha')
            ->label('ArCaptcha Verification');

        $this->assertInstanceOf(ArCaptcha::class, $component);
    }

    public function test_arcaptcha_component_can_have_helper_text(): void
    {
        $component = ArCaptcha::make('captcha')
            ->helperText('Please complete the ArCaptcha verification');

        $this->assertInstanceOf(ArCaptcha::class, $component);
    }
}

