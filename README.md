# Easypanel SDK

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mrfansi/easypanel.svg?style=flat-square)](https://packagist.org/packages/mrfansi/easypanel)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/mrfansi/easypanel/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/mrfansi/easypanel/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/mrfansi/easypanel/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/mrfansi/easypanel/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/mrfansi/easypanel.svg?style=flat-square)](https://packagist.org/packages/mrfansi/easypanel)

A comprehensive Laravel package for integrating with EasyPanel API. This package provides a clean, fluent interface for
managing projects, services, monitoring, and settings on your EasyPanel server infrastructure.

## Features

- 🚀 **Complete API Coverage** - Full support for all 353+ Easypanel API endpoints across 45 service categories
- 🛡️ **Type Safety** - Built with PHP 8.4+ strict types and comprehensive validation
- 🏗️ **SOLID Architecture** - Following SOLID principles with dependency injection
- ✅ **Comprehensive Testing** - Unit and feature tests with high coverage
- 📦 **Laravel Integration** - Service provider, facades, and configuration
- 🔧 **Error Handling** - Detailed exception handling with specific error types
- 🎯 **Service Organization** - Organized by API domains with 40+ service classes
- 🗄️ **Database Support** - MySQL, MariaDB, PostgreSQL, MongoDB, Redis services
- ☁️ **Storage Providers** - S3, Dropbox, Google Drive, FTP, SFTP, Local storage
- 🔄 **Backup Management** - Volume and database backup automation
- 🚀 **Infrastructure** - Traefik, Cloudflare Tunnel, Docker Builder management
- 📊 **Monitoring** - Actions tracking, notifications, system monitoring
- 🎨 **Customization** - Branding, themes, custom configurations

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
// Application services
$service = Easypanel::servicesApp()->inspectService('project-name', 'service-name');

// Database services
$mysql = Easypanel::servicesMySql()->inspectService('project-name', 'db-service');
$postgres = Easypanel::servicesPostgres()->inspectService('project-name', 'pg-service');
$mongo = Easypanel::servicesMongo()->inspectService('project-name', 'mongo-service');
$redis = Easypanel::servicesRedis()->inspectService('project-name', 'redis-service');

// WordPress services
$users = Easypanel::servicesWordPress()->getUsers('project-name', 'wp-service');
$themes = Easypanel::servicesWordPress()->getThemes('project-name', 'wp-service');

// Box services (custom containers)
$container = Easypanel::servicesBox()->inspectService('project-name', 'box-service');

// Docker Compose services
$compose = Easypanel::servicesCompose()->inspectService('project-name', 'compose-service');

// Common service operations
$error = Easypanel::servicesCommon()->getServiceError('project-name', 'service-name');
Easypanel::servicesCommon()->setNotes('project-name', 'service-name', 'Updated notes');
```

### Actions Management

```php
// List actions for a service
$actions = Easypanel::actions()->listActions('my-project', 'my-service');

// Get action details
$action = Easypanel::actions()->getAction('action-id');

// Kill running action
Easypanel::actions()->killAction('action-id');
```

### Git Operations

```php
// Get SSH public key for deployments
$key = Easypanel::git()->getPublicKey('project-name', 'service-name');

// Generate new SSH key
Easypanel::git()->generateKey('project-name', 'service-name');
```

### Infrastructure Management

```php
// Cluster operations
$nodes = Easypanel::cluster()->listNodes();
$command = Easypanel::cluster()->addWorkerCommand();
Easypanel::cluster()->removeNode('node-id');

// Traefik configuration
$config = Easypanel::traefik()->getCustomConfig();
Easypanel::traefik()->setEnv('TRAEFIK_LOG_LEVEL=DEBUG');
Easypanel::traefik()->restart();

// Cloudflare Tunnel management
$tunnels = Easypanel::cloudflareTunnel()->listTunnels($apiToken, $accountId);
Easypanel::cloudflareTunnel()->createTunnelRule([
    'projectName' => 'my-project',
    'serviceName' => 'my-service',
    'subdomain' => 'app',
    'domain' => 'example.com',
    'path' => '/',
    'internalProtocol' => 'http',
    'internalPort' => 3000,
    'zoneId' => 'zone-id'
]);

// Notifications
$channels = Easypanel::notifications()->listNotificationChannels();
Easypanel::notifications()->createNotificationChannel([
    'name' => 'Discord Alerts',
    'target' => [
        'type' => 'discord',
        'url' => 'https://discord.com/api/webhooks/...'
    ],
    'events' => [
        'updateAvailable' => ['enabled' => true],
        'appDeploy' => ['enabled' => true]
    ]
]);
```

### Storage Providers

```php
// List available storage providers
$providers = Easypanel::storageProvidersCommon()->list();

// Create S3 storage provider
Easypanel::storageProvidersS3()->createProvider(
    'aws',          // subtype: aws, backblaze, digital-ocean, wasabi, other
    'AWS Backup',   // name
    'access-key',   // accessKeyId
    'secret-key',   // secretAccessKey
    'my-bucket',    // bucket
    'us-east-1'     // region
);

// Create local storage provider
Easypanel::storageProvidersLocal()->createProvider('Local Backup', '/backup/path');

// Create Dropbox provider
Easypanel::storageProvidersDropbox()->createProvider('Dropbox Backup');
```

### Backup Management

```php
// Volume backups
$mounts = Easypanel::volumeBackups()->listVolumeMounts('project-name', 'service-name');
Easypanel::volumeBackups()->createVolumeBackup([
    'projectName' => 'my-project',
    'serviceName' => 'my-service',
    'volumeName' => 'data',
    'storageProviderId' => 'provider-id',
    'storageProviderPath' => '/backups/volumes',
    'schedule' => '0 2 * * *',
    'enabled' => true
]);

// Database backups
$databases = Easypanel::databaseBackups()->getServiceDatabases('project-name', 'db-service');
Easypanel::databaseBackups()->createDatabaseBackup([
    'projectName' => 'my-project',
    'serviceName' => 'db-service',
    'databaseName' => 'app_db',
    'storageProviderId' => 'provider-id',
    'storageProviderPath' => '/backups/databases',
    'schedule' => '0 1 * * *',
    'enabled' => true
]);

// Restore database backup
Easypanel::databaseBackups()->restoreDatabaseBackup([
    'projectName' => 'my-project',
    'serviceName' => 'db-service',
    'storageProviderId' => 'provider-id',
    'path' => '/backups/databases/app_db_20240829.sql',
    'databaseName' => 'restored_db'
]);
```

### Container Management

```php
// Port mappings
$ports = Easypanel::ports()->listPorts('project-name', 'service-name');
Easypanel::ports()->createPort('project-name', 'service-name', [
    'published' => 8080,
    'target' => 80,
    'protocol' => 'tcp'
]);

// Volume mounts
$mounts = Easypanel::mounts()->listMounts('project-name', 'service-name');
Easypanel::mounts()->createMount('project-name', 'service-name', [
    'type' => 'volume',
    'name' => 'app-data',
    'mountPath' => '/app/data'
]);

// Docker builders
$builders = Easypanel::dockerBuilders()->listDockerBuilders();
Easypanel::dockerBuilders()->createDockerBuilder([
    'name' => 'high-memory-builder',
    'memory' => 4096,
    'memorySwap' => 8192,
    'cpus' => 2
]);
```

### System Administration

```php
// System setup
$status = Easypanel::setup()->getStatus();
Easypanel::setup()->setup(
    'admin@example.com',    // email
    'secure-password',      // password
    true,                   // subscribe to updates
    'api',                  // source
    true                    // accept terms
);

// System updates
$updateStatus = Easypanel::update()->getStatus();
Easypanel::update()->update();

// Server management
Easypanel::server()->reboot();

// Branding customization
$settings = Easypanel::branding()->getBasicSettings();
Easypanel::branding()->setBasicSettings(
    false,          // hideIp
    false,          // hideNotes
    'My Server',    // serverName
    '#1e40af'       // serverColor
);

// Two-factor authentication
Easypanel::twoFactor()->configure();
Easypanel::twoFactor()->enable('123456');
Easypanel::twoFactor()->disable();
```

### License Management

```php
// Portal License
$payload = Easypanel::portalLicense()->getLicensePayload();
Easypanel::portalLicense()->activate();
Easypanel::portalLicense()->deactivate();

// Lemon Squeezy License
$payload = Easypanel::lemonLicense()->getLicensePayload();
Easypanel::lemonLicense()->activateByOrder('order-id');
Easypanel::lemonLicense()->activate('license-key');
Easypanel::lemonLicense()->deactivate();
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
