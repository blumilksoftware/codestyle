## blumilksoftware/codebase
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

You can configure paths, set lists, skipped and additional rules in `Config` constructor:
```php
<?php

declare(strict_types=1);

use Blumilk\Codestyle\Config;
use Blumilk\Codestyle\Configuration\Paths;

$paths = new class() implements Paths {
    public function get(): array
    {
        return ["src"];
    }
};

$config = new Config(
    paths: $paths
);

return $config->config();
```

Then run:
```shell
composer ecs
```
