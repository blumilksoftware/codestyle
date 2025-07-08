<?php

declare(strict_types=1);

class Php84
{
    public string $combinedCode {
        get => \sprintf("%s_%s", $this->languageCode, $this->countryCode);
        set (string $value) {
            [$this->languageCode, $this->countryCode] = explode("_", $value, 2);
        }
    }

    public function __construct(
        public string $languageCode,
        public string $countryCode {
            set (string $countryCode) {
                $this->countryCode = strtoupper($countryCode);
            }
        },
    ) {}
}
