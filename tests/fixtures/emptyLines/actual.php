<?php

declare(strict_types=1);

/**
 * @property string $id
 */

class Test
{
}

return [
    "default" => env("DB_CONNECTION", "mysql"),


    "connections" => [
        "sqlite" => [
            "driver" => "sqlite",
            "url" => env("DATABASE_URL"),
            "database" => env("DB_DATABASE", database_path("database.sqlite")),
            "prefix" => "",
            "foreign_key_constraints" => env("DB_FOREIGN_KEYS", true),
        ],
    ]
];
