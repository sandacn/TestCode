<?php
## 测试一个特殊case下的性能优化
# 测试的结果表明，使用第一种方法是最快的，另外注意在for之前计算好最大值
$server_string = '192.168.1.52:11211,192.168.1.53:11211,192.168.1.54:11211,192.168.1.50:11211,192.168.1.51:11211';
$server_string = '192.168.1.52:11211:1,192.168.1.53:11211:2,192.168.1.54:11211:3,192.168.1.50:11211:4,192.168.1.51:11211:5';
$server_setting = explode(',',$server_string);

$MAX = 1000;

$start = microtime(true);
for ($k = 0; $k < $MAX; $k++) {
    $servers = null;
    for ($i = 0, $max = count($server_setting); $i < $max; $i++) {
        $setting = explode(':', $server_setting[$i]);
        $servers[$i] = array($setting[0], $setting[1]);
    }
}
$end = microtime(true);
echo "array element:\t".($end - $start) . "\n"; 

$start = microtime(true);
for ($k = 0; $k < $MAX; $k++) {
    $servers = null;
    for ($i = 0, $max = count($server_setting); $i < $max; ++$i) {
        $setting = explode(':', $server_setting[$i]);
        $servers[$i] = array($setting[0], $setting[1]);
    }
}
$end = microtime(true);
echo "array element ++i:\t".($end - $start) . "\n"; 



$start = microtime(true);
for ($k = 0; $k < $MAX; $k++) {
    $servers = null;
    for ($i = 0, $max = count($server_setting); $i < $max; $i++) {
        $s1 = explode(':', $server_setting[$i]);
        $servers[$i] = array_slice($s1, 0, 2);
    }
}
$end = microtime(true);
echo "array_slice:\t".($end - $start) . "\n";

$start = microtime(true);
for ($k = 0; $k < $MAX; $k++) {
    $servers = null;
    for ($i = 0, $max = count($server_setting); $i < $max; $i++) {
        list($s1, $s2, ) = explode(":", $server_setting[$i]);
        $servers[$i] = array($s1, $s2);
    }
}
$end = microtime(true);
echo "list array:\t".($end - $start) . "\n"; 


$start = microtime(true);
for ($k = 0; $k < $MAX; $k++) {
    $servers = null;
    for ($i = 0; $i < count($server_setting); $i++) {
        $setting = explode(':', $server_setting[$i]);
        $servers[$i] = array($setting[0], $setting[1]);
    }

}
$end = microtime(true);
echo "count() in for loop:\t".($end - $start) . "\n"; 

?>
