[![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/blumilksoftware/codestyle?style=for-the-badge)](https://packagist.org/packages/blumilksoftware/codestyle)
[![Packagist Version](https://img.shields.io/packagist/v/blumilksoftware/codestyle?style=for-the-badge)](https://packagist.org/packages/blumilksoftware/codestyle)
[![Packagist Downloads](https://img.shields.io/packagist/dt/blumilksoftware/codestyle?style=for-the-badge)](https://packagist.org/packages/blumilksoftware/codestyle/stats)

![Logo](./logo.png)

## blumilksoftware/codebase
A common codestyle helper for all Blumilk projects.

### Usage
Add package to our project:
```shell
composer require blumilksoftware/codestyle --dev
```

Then run following to create configuration file and add scripts to the `composer.json` file:
```shell
./vendor/bin/codestyle init
```

Or you can create `codestyle.php` file in your project's root directory:
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
    "csf": "./vendor/bin/php-cs-fixer fix --diff --config codestyle.php"
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

#### Additional configuration
If you want to disable risky rules, you can add `withoutRiskyFixers` method to the config file:
```php
return $config->withoutRiskyFixers()->config();
```

If you want to enable ignoring marked file, you can add `ignoreMarkedFiles` method to the config file:
```php
return $config->ignoreMarkedFiles()->config();
```
and then add `// php-cs-fixer-ignore-file` to the file which you want to ignore.

#### Upgrading guide
Upgrading guide is available in [upgrading.md](./upgrading.md) file.

### Contributing
In cloned or forked repository, run:
```shell
cp .env.example .env
composer install
```

There are scripts available for package codestyle checking and testing:

| Command         | Description                                                  |
|-----------------|--------------------------------------------------------------|
| `composer cs`   | Runs codestyle against the package itself                    | 
| `composer csf`  | Runs codestyle with fixer enabled against the package itself | 
| `composer test` | Runs all test cases                                          | 
| `composer unit` | Runs tests for package features                              | 
| `composer e2e`  | Runs tests for codestyle rules                               | 


There is also the Docker Compose configuration available:
```shell
docker compose up -d
docker compose exec php php -v
docker compose exec php composer -V
```

There are also Makefile commands available:
```shell
make run
make shell
make stop
```

Please maintain our project guidelines:
* keep issues well described, labeled and in English,
* add issue number to all your commits,
* add issue number to your branch name,
* squash your commits into one commit with standardized name.
