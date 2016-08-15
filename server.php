<?php
/**
 * Created by PhpStorm.
 * User: 张鹏翼
 * Date: 2016/8/12
 * Time: 16:26
 */
include "RedisPool.class.php";
$fas = array('HA' => array('127.0.0.1', '6379'));
RedisPool::add_servers($fas);
$movie = array();
$movie[1] = str_replace('-', "0", isset($_POST['one']) ? $_POST['one'] : "9-9");
$movie[2] = str_replace('-', "0", isset($_POST['two']) ? $_POST['two'] : "9-9");
$movie[3] = str_replace('-', "0", isset($_POST['three']) ? $_POST['three'] : "9-9");
$movie[4] = str_replace('-', "0", isset($_POST['four']) ? $_POST['four'] : "9-9");

function _is($wh)
{
    if ($wh < 999) {
        return true;
    } else {
        $redis = RedisPool::get("HA");
        if ($redis->getbit("movie", $wh) == 0) {
            $redis->setbit("movie", $wh, 1);
            return true;
        } else {
            return false;
        }
    }
}

if (_is($movie[1]) && _is($movie[2]) && _is($movie[3]) && _is($movie[4])) {
    echo "订票成功！";
} else {
    echo "座位已经被订，请重新选座!";
}
