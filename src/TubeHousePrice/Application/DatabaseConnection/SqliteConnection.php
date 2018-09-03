<?php

namespace TubeHousePrice\Application\DatabaseConnection;

use Medoo\Medoo;

final class SqliteConnection extends Medoo
{
    public function __construct($pathToDatabaseFile)
    {
        $options = [
            'database_type' => 'sqlite',
            'database_file' => $pathToDatabaseFile,
        ];
        parent::__construct($options);
    }
}