<?php
## 测试到底是i++ 快还是 ++i快


$MAX = 1000000;


$start_ts = microtime(true);
for ($i = 0; $i < $MAX; $i++) {
    $a = 1;
}
$end_ts = microtime(true);
var_dump($end_ts - $start_ts);



$start_ts = microtime(true);
for ($i = 0; $i < $MAX; ++$i) {
    $a = 1;
}
$end_ts = microtime(true);
var_dump($end_ts - $start_ts);


?>
