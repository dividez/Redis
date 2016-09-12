<?php
/**
 * Created by PhpStorm.
 * Date: 2016/9/12
 * Time: 16:26
 */

$movie = array();
$movie[1] = str_replace('-', "0", isset($_POST['one']) ? $_POST['one'] : "9-9");
$movie[2] = str_replace('-', "0", isset($_POST['two']) ? $_POST['two'] : "9-9");
$movie[3] = str_replace('-', "0", isset($_POST['three']) ? $_POST['three'] : "9-9");
$movie[4] = str_replace('-', "0", isset($_POST['four']) ? $_POST['four'] : "9-9");
$dbname = $_POST['movie'];
function _is($db,$wh)
{
    if ($wh < 999) {
        return true;
    } else {
        $redis = new Redis();
        $redis->connect('127.0.0.1',6379);
        if ($redis->getbit($db, $wh) == 0) {
            $redis->setbit($db, $wh, 1);
            return true;
        } else {
            return false;
        }
    }
}

if (_is($dbname,$movie[1]) && _is($dbname,$movie[2]) && _is($dbname,$movie[3]) && _is($dbname,$movie[4])) {
    echo "订票成功！";
} else {
    echo "座位已经被订，请重新选座!";
}
