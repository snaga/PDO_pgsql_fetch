<?php
function PDO_pgsql_fetch($stmt)
{
  if (!($row = $stmt->fetch())) {
    return FALSE;
  }
  $row2 = $row;

  for ($i = 0; $i < $stmt->columnCount(); $i++) {
    $m = $stmt->getColumnMeta($i);
    if ($m['native_type'] === 'json' or $m['native_type'] === 'jsonb') {
      $m = $stmt->getColumnMeta($i);
      $name = $m['name'];
      $row2[$i] = json_decode($row[$i], true);
      $row2[$name] = json_decode($row[$i], true);
    }
  }
  return $row2;
}
?>
