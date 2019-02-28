<?php

try
{
    $host = "weldcomepaadmin.mysql.db";
    $user = "weldcomepaadmin";
    $password ="Welding2019";
    $dbName = "weldcomepaadmin";
    $db = new PDO('mysql:dbname=weldcomepaadmin;host=weldcomepaadmin.mysql.db;charset=UTF8',
                        $user,
                        "Welding2019");
}
catch (PDOException $e)
{
  exit( 'Connexion échouée : ' . $e->getMessage());
}
