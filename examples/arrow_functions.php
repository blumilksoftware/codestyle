<?php

declare(strict_types=1);

array_filter([1, 2, 3, 4], fn(int $i): bool => $i % 2 === 0);
