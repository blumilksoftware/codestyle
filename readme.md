![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/blumilksoftware/codestyle?style=for-the-badge) ![Packagist Version](https://img.shields.io/packagist/v/blumilksoftware/codestyle?style=for-the-badge) ![Packagist Downloads](https://img.shields.io/packagist/dt/blumilksoftware/codestyle?style=for-the-badge)

## blumilksoftware/codebase
A common codestyle helper for all Blumilk projects.

### Usage
Add package to our project:
```shell
composer require blumilksoftware/codestyle --dev
```

Then create `codestyle.php` file in your project's root directory:
```php
<?php

declare(strict_types=1);

use Blumilk\Codestyle\Config;

return new Config();
```

#### Configuration
You can configure paths and rules in `Config` class constructor:
```php
<?php

declare(strict_types=1);

use Blumilk\Codestyle\Config;
use Blumilk\Codestyle\Configuration\Defaults\LaravelPaths;

$paths = new LaravelPaths();

$config = new Config(
    paths: $paths->filter("app", "tests")->add("src"),
);

return $config->config();
```

Or:
```php
<?php

declare(strict_types=1);

use Blumilk\Codestyle\Config;
use Blumilk\Codestyle\Configuration\Defaults\LaravelPaths;

$config = new Config(
    paths: new LaravelPaths(LaravelPaths::LARAVEL_8_PATHS),
);

return $config->config();
```


Or:
```php
<?php

declare(strict_types=1);

use Blumilk\Codestyle\Config;
use Blumilk\Codestyle\Configuration\Defaults\Paths;

$config = new Config(
    paths: new Paths("src"),
);

return $config->config();
```

#### Usage with Composer
Add scripts to your `composer.json` file:
```json
{
  "scripts": {
    "cs": "./vendor/bin/php-cs-fixer fix --dry-run --diff --config codestyle.php",
    "csf":  "./vendor/bin/php-cs-fixer fix --diff --config codestyle.php"
  }
}
```

Then run following command to check codestyle:
```shell
composer cs
```

or following to fix found errors:
```shell
composer csf
```

#### Upgrading guide from 0.x
With version 1.x we removed `symplify/easy-coding-standard` dependency in the project. The checklist for updating old projects is as follows:
- [ ] update the main dependency `blumilksoftware/codestyle` to version `^1.0` in `composer.json` file
- [ ] run `composer update blumilksoftware/codestyle -W`
- [ ] rename `ecs.php` to `codestyle.php`
- [ ] update scripts in `composer.json` file
- [ ] update scripts in Github Actions
- [ ] the constructor of `Blumilk\Codestyle\Config` lost two parameters: `$sets` and `$skipped`; all manipulations of rules should be done on base `$rules` list
- [ ] `Blumilk\Codestyle\Configuration\Defaults\LaravelPaths` returns a default Laravel 9 directory schema; for Laravel 8 additional parameter `LaravelPaths::LARAVEL_8_PATHS` should be added

### Contributing
In cloned or forked repository, run:
```shell
cp .env.example .env
composer install
```

There are scripts available for package codestyle checking and testing:
```shell
composer cs
composer csf
composer test
composer unit
composer e2e
```

There is also the Docker Compose configuration available:
```shell
docker-compose up -d
docker-compose exec php php -v
docker-compose exec php composer -V
```

Please maintain our project guidelines:
* keep issues well described, labeled and in English,
* add issue number to all your commits,
* add issue number to your branch name,
* squash your commits into one commit with standardized name.
