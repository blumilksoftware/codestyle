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

$config = new Config();

return $config->config();
```

#### Configuration
You can configure paths, set lists, skipped and additional rules in `Config` constructor:
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
    "csf": "./vendor/bin/ecs check --fix"
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
