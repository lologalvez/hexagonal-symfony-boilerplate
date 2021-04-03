<?php

require 'vendor/autoload.php';

use Doctrine\DBAL\DriverManager;
use Doctrine\Migrations\Configuration\Migration\PhpFile;
use Doctrine\Migrations\Configuration\Connection\ExistingConnection;
use Doctrine\Migrations\DependencyFactory;
use Symfony\Component\Dotenv\Dotenv;

$config = new PhpFile('migrations.php'); // Or use one of the Doctrine\Migrations\Configuration\Configuration\* loaders

(new Dotenv())->bootEnv('.env');

$conn = DriverManager::getConnection([
        'dbname' => $_ENV['MYSQL_DATABASE'],
        'user' => $_ENV['MYSQL_USER'],
        'password' => $_ENV['MYSQL_PASSWORD'],
        'host' => $_ENV['MYSQL_HOST'],
        'driver' => 'pdo_mysql',
    ]
);

return DependencyFactory::fromConnection($config, new ExistingConnection($conn));
