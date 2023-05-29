<?php

/**
 * Configuration for database connection
 *
 */

$host       = "172.16.144.131";
$username   = "root";
$password   = "raph";
$dbname     = "SAE203";
$dsn        = "mysql:host=$host;dbname=$dbname";
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              );
