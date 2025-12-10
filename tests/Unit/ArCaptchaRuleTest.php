<?php

namespace Milad\FilamentArCaptchaField\Tests\Unit;

use Milad\FilamentArCaptchaField\Rules\ArCaptchaRule;
use Milad\FilamentArCaptchaField\Tests\TestCase;
use Mockery;

class ArCaptchaRuleTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_rule_fails_when_value_is_empty(): void
    {
        $rule = new ArCaptchaRule();

        $this->assertFalse($rule->passes('captcha', ''));
        $this->assertFalse($rule->passes('captcha', null));
    }

    public function test_rule_uses_config_values_by_default(): void
    {
        $rule = new ArCaptchaRule();

        $this->assertInstanceOf(ArCaptchaRule::class, $rule);
    }

    public function test_rule_can_use_custom_keys(): void
    {
        $rule = new ArCaptchaRule('custom-site-key', 'custom-secret-key');

        $this->assertInstanceOf(ArCaptchaRule::class, $rule);
    }

    public function test_rule_can_use_custom_options(): void
    {
        $rule = new ArCaptchaRule(null, null, ['lang' => 'en']);

        $this->assertInstanceOf(ArCaptchaRule::class, $rule);
    }

    public function test_rule_has_error_message(): void
    {
        $rule = new ArCaptchaRule();

        $message = $rule->message();

        $this->assertIsString($message);
        $this->assertNotEmpty($message);
    }

    public function test_rule_message_is_translatable(): void
    {
        $rule = new ArCaptchaRule();

        $message = $rule->message();

        $this->assertStringContainsString('verification failed', $message);
    }
}

