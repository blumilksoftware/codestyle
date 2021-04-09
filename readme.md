![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/blumilksoftware/codestyle?style=for-the-badge) ![Packagist Version](https://img.shields.io/packagist/v/blumilksoftware/codestyle?style=for-the-badge) ![Packagist Downloads](https://img.shields.io/packagist/dt/blumilksoftware/codestyle?style=for-the-badge)

## blumilksoftware/codebase
A common codestyle helper for all Blumilk projects.

### Usage
Add package to our project:
```shell
composer require blumilksoftware/codestyle --dev
```

Then create `ecs.php` file in your project's root directory:
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
    paths: $paths->filter("app", "tests")->add("src")
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
    paths: new Paths("src")
);

return $config->config();
```

#### Usage with Composer
Add script to your `composer.json` file:
```json
"scripts": {
  "ecs": "./vendor/bin/ecs check"
}
```

Then run:
```shell
composer ecs
```

# Contributing

### Requirements
- docker
- docker-compose

### installation

```shell
cp .env.example .env
# adjust '.env' file
docker-compose up -d
docker-compose exec php composer install
```
### shell
```shell
docker-compose exec php ash
```