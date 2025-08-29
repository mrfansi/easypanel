# Development Commands for Easypanel SDK

## Testing

- `composer test` or `vendor/bin/pest` - Run all tests
- `vendor/bin/pest --coverage` - Run tests with coverage
- `vendor/bin/pest --filter=<pattern>` - Run specific tests

## Code Quality

- `composer format` or `vendor/bin/pint` - Fix code style with Laravel Pint
- `composer analyse` or `vendor/bin/phpstan analyse` - Static analysis
- `vendor/bin/pint --test` - Check code style without fixing

## Package Development

- `composer prepare` or `php vendor/bin/testbench package:discover --ansi` - Package discovery
- `composer dump-autoload` - Regenerate autoloader

## Git Commands (macOS)

- `git status` - Check repository status
- `git add .` - Stage all changes
- `git commit -m "message"` - Commit changes
- `git push` - Push to remote

## File Operations (macOS)

- `ls -la` - List files with details
- `find . -name "*.php"` - Find PHP files
- `grep -r "pattern" src/` - Search in source files
- `cat filename` - Display file content
