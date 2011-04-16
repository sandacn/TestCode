<?php
## 测试 if else 和switch 哪个更快 
## 测试结果是 if else 更快

// prepare test data
$MAX = 1000000;
$data = array();
$actions = array("add", "remove", "edit");
$rates = array(1, 1, 1);
$limits = array();
$sum = 0;
foreach ($rates as $i => $v) {
    $sum += $v;
    $limits[$i] = $sum;
}
$limits[] = $sum + $sum;
for ($i = 0; $i < $MAX; $i++) {
    $rand = mt_rand(0, $sum);
    $val = 'default';
    for ($k = 0, $limit_max = count($limits)-1; $k <= $limit_max; $k++) {
        if ($rand >= $limits[$k] && $rand < $limits[$k+1]) {
            $val = $actions[$k];
        }
    }

    $data[$i] = $val;
}


$start_ts = microtime(true);
foreach ($data as $action) {
    if($action == 'add') {
        $a = 1;
    } elseif ($action == 'delete') {
        $a = 2;
    } elseif ($action == 'edit') {
        $a = 3;
    } else {
        $a = 4;
    }
}
$end_ts = microtime(true);
var_dump($end_ts - $start_ts);


$start_ts = microtime(true);
foreach ($data as $action) {
    switch($action) {
    case 'add':
        $a = 1;
        break;
    case 'delete':
        $a = 2;
        break;
    case 'edit':
        $a = 3;
        break;
    default:
        $a = 4;
        break;
    }
}
$end_ts = microtime(true);
var_dump($end_ts - $start_ts);


?>
