<?php

declare(strict_types=1);

$class = new ErrorsThresholdExceeded(
    requestsNumber: $requests,
    errorsNumber: $errors,
    percentage: $percentage,
);
