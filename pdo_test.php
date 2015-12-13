#!/usr/bin/php

<?php
include 'PDO_pgsql_fetch.inc.php';

$db = 'postgres';
$user = 'postgres';
$password = 'postgres';

$pdo = new PDO("pgsql:dbname=$db", $user, $password);

print("\n*** json ***\n");

$pdoStatement = $pdo->query("SELECT 'foo' as foo, row_to_json(pg_user)::jsonb as json FROM pg_user WHERE usename = current_user");

#while ($row = $pdoStatement->fetch()) {
while ($row = PDO_pgsql_fetch($pdoStatement)) {
  $f = $row['foo'];
  var_dump($f);

  $j = $row['json'];
  var_dump($j);
}

print("\n*** array ***\n");

$pdoStatement = $pdo->query("SELECT array_agg(usename) as foo FROM pg_user");

#while ($row = $pdoStatement->fetch()) {
while ($row = PDO_pgsql_fetch($pdoStatement)) {
  $f = $row['foo'];
  var_dump($f);
}

?>
