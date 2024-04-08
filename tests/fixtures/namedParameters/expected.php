<?php

declare(strict_types=1);

$class = new ErrorsThresholdExceeded(
    requestsNumber: $requests,
    errorsNumber: $errors,
    percentage: $percentage,
);

$result = $reader->merge($merge, new Api(), flag: CONSTANT);
