# Code Style and Conventions

## PHP Standards

- **PHP Version**: 8.4+ with strict types (`declare(strict_types=1);`)
- **Namespace**: `Mrfansi\Easypanel\`
- **PSR Standards**: PSR-4 autoloading, PSR-12 coding standard
- **Code Style**: Laravel Pint for automated formatting

## Class Structure

- **Final classes**: Most concrete classes are `final`
- **Constructor promotion**: Use PHP 8+ constructor property promotion
- **Return types**: Always declare explicit return types
- **Type hints**: Use strict type hints for parameters

## Service Classes

- **Inheritance**: Extend `AbstractService`
- **Validation**: Use `RequestValidator` for input validation
- **HTTP Methods**: Use appropriate `makeRequest()`, `makePostRequest()`, `makePatchRequest()`, `makeDeleteRequest()`
- **Operation IDs**: Use dot notation (e.g., `projects.listProjects`)

## Exception Handling

- **Custom exceptions**: Use specific exception classes
- **Validation**: Throw `EasypanelValidationException` for validation errors
- **Authentication**: Throw `EasypanelAuthenticationException` for auth errors

## Documentation

- **PHPDoc**: Use for complex methods and public APIs
- **README**: Comprehensive usage examples
- **Type safety**: Leverage PHP 8.4+ features
