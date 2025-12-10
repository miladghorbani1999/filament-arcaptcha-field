<?php

namespace Milad\FilamentArCaptchaField\Tests\Unit;

use Milad\FilamentArCaptchaField\Forms\Components\ArCaptcha;
use Milad\FilamentArCaptchaField\Tests\TestCase;

class ArCaptchaOptionsTest extends TestCase
{
    public function test_options_override_config_values(): void
    {
        $component = ArCaptcha::make('captcha')
            ->options([
                'lang' => 'en',
                'theme' => 'dark',
            ]);

        $options = $component->getOptions();

        $this->assertEquals('en', $options['lang']);
        $this->assertEquals('dark', $options['theme']);
    }

    public function test_options_merge_with_config(): void
    {
        $component = ArCaptcha::make('captcha')
            ->options([
                'lang' => 'en',
            ]);

        $options = $component->getOptions();

        $this->assertEquals('en', $options['lang']);
        $this->assertEquals('light', $options['theme']);
    }

    public function test_options_can_add_new_keys(): void
    {
        $component = ArCaptcha::make('captcha')
            ->options([
                'custom_option' => 'custom_value',
            ]);

        $options = $component->getOptions();

        $this->assertEquals('custom_value', $options['custom_option']);
        $this->assertEquals('fa', $options['lang']); 
    }

    public function test_empty_options_uses_config_only(): void
    {
        $component = ArCaptcha::make('captcha')
            ->options([]);

        $options = $component->getOptions();

        $this->assertEquals('fa', $options['lang']);
        $this->assertEquals('light', $options['theme']);
    }
}

