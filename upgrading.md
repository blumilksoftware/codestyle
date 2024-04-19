### Upgrading guide from 2.x to 3.x
The checklist for updating old projects is as follows:

- [ ] update the main dependency `blumilksoftware/codestyle` to version `^3.0` in `composer.json` file
- [ ] run `composer update blumilksoftware/codestyle`
- [ ] update `codestyle.php` file configuration paths if you are still using Laravel 10 because the default Laravel paths have changed to Laravel 11

### Upgrading guide from 1.x to 2.x
The checklist for updating old projects is as follows:

- [ ] update the main dependency `blumilksoftware/codestyle` to version `^2.0` in `composer.json` file
- [ ] run `composer update blumilksoftware/codestyle -W`

### Upgrading guide from 0.x to 1.x
With version 1.x we removed `symplify/easy-coding-standard` dependency in the project. The checklist for updating old projects is as follows:

- [ ] update the main dependency `blumilksoftware/codestyle` to version `^1.0` in `composer.json` file
- [ ] run `composer update blumilksoftware/codestyle -W`
- [ ] rename `ecs.php` to `codestyle.php`
- [ ] update scripts in `composer.json` file
- [ ] update scripts in Github Actions
- [ ] the constructor of `Blumilk\Codestyle\Config` lost two parameters: `$sets` and `$skipped`; all manipulations of rules should be done on base `$rules` list
- [ ] `Blumilk\Codestyle\Configuration\Defaults\LaravelPaths` returns a default Laravel 9 directory schema; for Laravel 8 additional parameter `LaravelPaths::LARAVEL_8_PATHS` should be added
