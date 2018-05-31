<?php

namespace TubeHousePrice\Application\DatabaseConnection;

use Medoo\Medoo;

final class SqliteConnection extends Medoo
{
    private $pathToDatabaseFile;

    public function __construct($pathToDatabaseFile)
    {
        $this->pathToDatabaseFile = $pathToDatabaseFile;
        
        $options = [
            'database_type' => 'sqlite',
            'database_file' => $this->pathToDatabaseFile,
        ];
        parent::__construct($options);
    }
}