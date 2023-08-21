<?php

declare(strict_types=1);

class Braces
{
    public function transform(array $data): void
    {
        if (trim($data[1]) === "Türkiye") {
            $countryName = "Turkey";
        } else {
            $countryName = $this->translate(trim($data[1]), "en");
        }

        if (trim($data[0]) === "Uşak") {
            $cityName = "Usak";
        } else {
            $cityName = $this->translate(trim($data[0]), "en");
        }
    }
}
