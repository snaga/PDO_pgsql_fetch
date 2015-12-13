<?php
function PDO_pgsql_fetch($stmt)
{
  if (!($row = $stmt->fetch())) {
    return FALSE;
  }
  $row2 = $row;

  for ($i = 0; $i < $stmt->columnCount(); $i++) {
    $m = $stmt->getColumnMeta($i);
    $name = $m['name'];

    if ($m['native_type'] === 'json' or $m['native_type'] === 'jsonb') {
      $row2[$i] = json_decode($row[$i], true);
      $row2[$name] = json_decode($row[$i], true);
    }
    elseif (substr($m['native_type'], 0, 1) === '_' and substr($row[$i], 0, 1) === '{' and substr($row[$i], -1, 1) === '}')
    {
      $v = preg_split('/,/', substr($row[$i], 1, strlen($row[$i])-2));
      $row2[$i] = $v;
      $row2[$name] = $v;
    }
  }
  return $row2;
}
?>
