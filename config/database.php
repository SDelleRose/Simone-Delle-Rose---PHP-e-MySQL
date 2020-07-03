<?php

// to read .env file
require_once ('vendor/autoload.php');
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv -> load();


 $config= [
   'db_engine' => 'mysql',
   'db_host' => $_ENV['DB_HOST'],
   'db_name' => $_ENV['DB_DATABASE'],
   'db_user' => $_ENV['DB_USERNAME'],
   'db_password' => $_ENV['DB_PASSWORD'],
 ];
 $db_config= $config['db_engine'].":host=".$config['db_host'].";dbname=".$config['db_name'];

 try {
 $pdo= new PDO ($db_config,$config['db_user'],$config['db_password']/*[PDO::MISQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"]*/);
   $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
   $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

 } catch (PDOException $e) {
   exit("impossibile connettersi al database: ". $e->getMessage());

 }

 ?>
