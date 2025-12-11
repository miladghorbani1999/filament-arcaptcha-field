# Filament ArCaptcha Field

Provides an ArCaptcha field for Filament Forms (V2-V3-V4), works in Admin-Panel and Frontend-Forms.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ghorbani/filament-arcaptcha-field.svg?style=flat-square)](https://packagist.org/packages/ghorbani/filament-arcaptcha-field)
[![Total Downloads](https://img.shields.io/packagist/dt/ghorbani/filament-arcaptcha-field.svg?style=flat-square)](https://packagist.org/packages/ghorbani/filament-arcaptcha-field)

This plugin is built on top of [arcaptcha/arcaptcha-php](https://github.com/arcaptcha/arcaptcha-php) package.

## Installation

You can install the package via composer:

```bash
composer require ghorbani/filament-arcaptcha-field
```

### Configuration

Publish the configuration file:

```bash
php artisan vendor:publish --provider="Ghorbani\FilamentArCaptchaField\FilamentArCaptchaFieldServiceProvider" --tag="config"
```

Add `ARCAPTCHA_SECRET_KEY` and `ARCAPTCHA_SITE_KEY` in your `.env` file:

```env
ARCAPTCHA_SITE_KEY=your-site-key
ARCAPTCHA_SECRET_KEY=your-secret-key
```

You can obtain these keys from [ArCaptcha Dashboard](https://arcaptcha.ir/dashboard).

## Usage

### In Admin Panel

```php
use Ghorbani\FilamentArCaptchaField\Forms\Components\ArCaptcha;

public static function form(Form $form): Form
{
    return $form->schema([
        // ... other fields
        ArCaptcha::make('captcha')
            ->required(),
    ]);
}
```

### In Frontend Forms

```php
use Ghorbani\FilamentArCaptchaField\Forms\Components\ArCaptcha;

public $captcha = ''; // must be initialized

protected function getFormSchema(): array
{
    return [
        // ... other fields
        ArCaptcha::make('captcha')
            ->required(),
    ];
}
```

### Custom Options

You can pass custom options to the ArCaptcha widget:

```php
ArCaptcha::make('captcha')
    ->options([
        'lang' => 'en',
        'theme' => 'dark',
    ])
```

### Custom Site Key and Secret Key

You can override the default site key and secret key:

```php
ArCaptcha::make('captcha')
    ->siteKey('your-custom-site-key')
    ->secretKey('your-custom-secret-key')
```

### Verification

#### Using Validation Rule

You can use the `ArCaptchaRule` for automatic validation:

```php
use Ghorbani\FilamentArCaptchaField\Rules\ArCaptchaRule;

// In your form rules
protected function getFormValidationRules(): array
{
    return [
        'captcha' => ['required', new ArCaptchaRule()],
    ];
}
```

Or in a Livewire component:

```php
use Ghorbani\FilamentArCaptchaField\Rules\ArCaptchaRule;

public function submit()
{
    $this->validate([
        'captcha' => ['required', new ArCaptchaRule()],
    ]);
    
    // Process form submission
}
```

#### Manual Verification

To verify the ArCaptcha response manually:

```php
use Ghorbani\FilamentArCaptchaField\Forms\Components\ArCaptcha;

$arcaptcha = ArCaptcha::make('captcha');

if ($arcaptcha->verify($data['captcha'])) {
    // Captcha is valid
} else {
    // Captcha is invalid
    throw new \Exception('Invalid captcha');
}
```

Or in a Livewire component:

```php
use Ghorbani\FilamentArCaptchaField\Forms\Components\ArCaptcha;

public function submit()
{
    $this->validate();
    
    $arcaptcha = ArCaptcha::make('captcha');
    
    if (!$arcaptcha->verify($this->captcha)) {
        $this->addError('captcha', 'Invalid captcha. Please try again.');
        return;
    }
    
    // Process form submission
}
```

## Configuration Options

The configuration file allows you to set default options:

```php
return [
    'site_key' => env('ARCAPTCHA_SITE_KEY', ''),
    'secret_key' => env('ARCAPTCHA_SECRET_KEY', ''),
    'options' => [
        'lang' => 'fa', // Language: 'fa' or 'en'
        'theme' => 'light', // Theme: 'light' or 'dark'
    ],
];
```

## Requirements

- PHP 8.1+
- Laravel 9.0+ or 10.0+ or 11.0+
- Filament 2.0+ or 3.0+ or 4.0+

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

If you discover any security related issues, please create an issue.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Credits

- [ArCaptcha PHP Library](https://github.com/arcaptcha/arcaptcha-php)
- [Filament](https://filamentphp.com/)

