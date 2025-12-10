# Tests

This directory contains all the tests for the Filament ArCaptcha Field package.

## Test Structure

- **Unit Tests** (`tests/Unit/`): Test individual components and classes in isolation
- **Feature Tests** (`tests/Feature/`): Test integration and behavior of components together

## Running Tests

To run all tests:

```bash
composer test
```

Or using PHPUnit directly:

```bash
vendor/bin/phpunit
```

To run specific test suites:

```bash
# Run only unit tests
vendor/bin/phpunit tests/Unit

# Run only feature tests
vendor/bin/phpunit tests/Feature

# Run a specific test file
vendor/bin/phpunit tests/Unit/ArCaptchaComponentTest.php
```

## Test Coverage

The tests cover:

- ✅ Service Provider configuration and bootstrapping
- ✅ ArCaptcha component creation and configuration
- ✅ Site key and secret key handling
- ✅ Options merging and customization
- ✅ ArCaptchaRule validation
- ✅ View rendering
- ✅ Integration with Filament forms

## Writing New Tests

When adding new features, make sure to:

1. Add unit tests for new classes/methods
2. Add feature tests for integration scenarios
3. Maintain at least 80% code coverage
4. Follow PSR-12 coding standards

