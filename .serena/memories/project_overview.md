# Easypanel SDK Project Overview

## Purpose

A comprehensive Laravel package for integrating with EasyPanel API. Provides a clean, fluent interface for managing
projects, services, monitoring, and settings on EasyPanel server infrastructure.

## Tech Stack

- **PHP**: 8.4+
- **Laravel**: 11.0+ || 12.0+
- **Testing**: PestPHP 4.0
- **Code Quality**: Laravel Pint, PHPStan (Larastan 3.0)
- **Architecture**: SOLID principles with dependency injection
- **Package Tools**: Spatie Laravel Package Tools

## Current Structure

- `src/Services/`: Service classes for different API domains
- `src/Http/`: HTTP client implementation
- `src/Exceptions/`: Custom exception classes
- `src/Data/`: Data transfer objects
- `src/Facades/`: Laravel facades
- `src/Validation/`: Request validation
- `openapi/`: 45 OpenAPI specification files with 353 total operations

## Existing Services

- `ProjectService`: Basic project operations (list, inspect, create, update, delete)
- `AuthService`: Authentication (login, logout, getUser, getSession)
- `MonitorService`: System monitoring
- `ServiceService`: Service management
- `SettingsService`: Settings management

## Missing Implementation

Based on OpenAPI specs, many service categories are not yet implemented, including:

- Services (App, Box, WordPress, Database services, etc.)
- Users management
- Certificates
- Domains
- Storage providers
- Backups
- Templates
- And many more (approximately 300+ endpoints missing)
