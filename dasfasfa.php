<?php
/**
 * Created by PhpStorm.
 * Date: 2016/8/13
 * Time: 14:36
 */
include "RedisPool.class.php";
$fas = array('HA' => array('127.0.0.1', '6379'));
RedisPool::add_servers($fas);
$redis = RedisPool::get("HA");
for($a = 1;$a <=10;$a++){
    echo '<p><span class="num">'.$a.'</span>';
    for($i= 1; $i<16;$i++){
        if($i<10){
            if($redis->getbit("movie", $i) == 1){
                echo '<a href="javascript:;" hidefocus="true" class="seated" title="'.$a.'排0'.$i.'座" status="1"></a>';
            }
            echo '<a href="javascript:;" hidefocus="true" class="seat" title="'.$a.'排0'.$i.'座" status="0"></a>';
        }else{
            if($redis->getbit("movie", $i) == 1){
                echo '<a href="javascript:;" hidefocus="true" class="seated" title="'.$a.'排0'.$i.'座" status="1"></a>';
            }

            echo '<a href="javascript:;" hidefocus="true" class="seat" title="'.$a.'排'.$i.'座" status="0"></a>';
        }

    }
    echo '</p>';
}