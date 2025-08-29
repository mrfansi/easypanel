# Easypanel SDK

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mrfansi/easypanel.svg?style=flat-square)](https://packagist.org/packages/mrfansi/easypanel)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/mrfansi/easypanel/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/mrfansi/easypanel/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/mrfansi/easypanel/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/mrfansi/easypanel/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/mrfansi/easypanel.svg?style=flat-square)](https://packagist.org/packages/mrfansi/easypanel)

A comprehensive Laravel package for integrating with EasyPanel API. This package provides a clean, fluent interface for
managing projects, services, monitoring, and settings on your EasyPanel server infrastructure.

## Features

- 🚀 **Complete API Coverage** - Full support for EasyPanel API endpoints
- 🛡️ **Type Safety** - Built with PHP 8.4+ strict types and comprehensive validation
- 🏗️ **SOLID Architecture** - Following SOLID principles with dependency injection
- ✅ **Comprehensive Testing** - Unit and feature tests with high coverage
- 📦 **Laravel Integration** - Service provider, facades, and configuration
- 🔧 **Error Handling** - Detailed exception handling with specific error types
- 🎯 **Service Organization** - Organized by API domains (Projects, Services, Monitor, etc.)

## Installation

You can install the package via composer:

```bash
composer require mrfansi/easypanel
```

Publish the configuration file:

```bash
php artisan vendor:publish --tag="easypanel-config"
```

## Configuration

Add your EasyPanel credentials to your `.env` file:

```env
EASYPANEL_BASE_URL=https://your-easypanel-domain.com
EASYPANEL_AUTH_TOKEN=your-api-token
EASYPANEL_TIMEOUT=30
```

Get your API token by logging into your EasyPanel instance or using the auth endpoints.

## Usage

### Basic Usage

```php
use Mrfansi\Easypanel\Facades\Easypanel;

// List all projects
$projects = Easypanel::projects()->listProjects();

// Get system statistics
$stats = Easypanel::monitor()->getSystemStats();

// Authenticate and get user info
$user = Easypanel::auth()->getUser();
```

### Dependency Injection

```php
use Mrfansi\Easypanel\Easypanel;

class ProjectController extends Controller
{
    public function __construct(private Easypanel $easypanel) {}
    
    public function index()
    {
        return $this->easypanel->projects()->listProjects();
    }
}
```

### Project Management

```php
// List all projects
$projects = Easypanel::projects()->listProjects();

// Inspect a specific project
$project = Easypanel::projects()->inspectProject('my-project');

// Create a new project
$result = Easypanel::projects()->createProject([
    'name' => 'new-project',
    'description' => 'My new project'
]);
```

### Service Management

```php
// Inspect application service
$service = Easypanel::services()->inspectAppService('project-name', 'service-name');

// Get WordPress users
$users = Easypanel::services()->getWordPressUsers('project-name', 'wp-service');

// Get database service info
$db = Easypanel::services()->inspectMySqlService('project-name', 'db-service');
```

### Error Handling

```php
use Mrfansi\Easypanel\Exceptions\EasypanelAuthenticationException;
use Mrfansi\Easypanel\Exceptions\EasypanelValidationException;

try {
    $projects = Easypanel::projects()->listProjects();
} catch (EasypanelAuthenticationException $e) {
    // Handle authentication errors (401)
    logger()->error('Authentication failed: ' . $e->getMessage());
} catch (EasypanelValidationException $e) {
    // Handle validation errors (422)
    $errors = $e->getErrors();
    logger()->error('Validation failed', $errors);
}
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Muhammad Irfan](https://github.com/mrfansi)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
