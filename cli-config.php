<?php

require 'vendor/autoload.php';

use Doctrine\DBAL\DriverManager;
use Doctrine\Migrations\Configuration\Migration\PhpFile;
use Doctrine\Migrations\Configuration\Connection\ExistingConnection;
use Doctrine\Migrations\DependencyFactory;

$config = new PhpFile('migrations.php'); // Or use one of the Doctrine\Migrations\Configuration\Configuration\* loaders

$conn = DriverManager::getConnection([
        'dbname' => 'dummy_db',
        'user' => 'root',
        'password' => 'password',
        'host' => 'dummy.mysql',
        'driver' => 'pdo_mysql',
    ]
);

return DependencyFactory::fromConnection($config, new ExistingConnection($conn));
