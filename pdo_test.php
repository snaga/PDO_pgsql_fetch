#!/usr/bin/php

<?php
include 'PDO_pgsql_fetch.inc.php';

$db = 'postgres';
$user = 'postgres';
$password = 'postgres';

$pdo = new PDO("pgsql:dbname=$db", $user, $password);
$pdoStatement = $pdo->query("SELECT 'foo' as foo, row_to_json(pg_user)::jsonb as json FROM pg_user");

#while ($row = $pdoStatement->fetch()) {
while ($row = PDO_pgsql_fetch($pdoStatement)) {
  $f = $row['foo'];
  var_dump($f);

  $j = $row['json'];
  var_dump($j);

#  print("usename: " . $j['usename'] . "\n");
}

?>
