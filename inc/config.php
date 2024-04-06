<?php
while (list($key, $value) = each($global_vars)) {
  define($key, $value);
}
 include('fdb.dll');
?>