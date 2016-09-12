<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>电影票订购系统</title>
    <link rel="stylesheet" href="css/cssrest.css">
    <link rel="stylesheet" href="css/movie.css">
    <script src="js/jquery-1.4.2.js"></script>
    <script src="js/movie.js"></script>
    <style type="text/css">
        .seat-item-h2 {
            text-align: center;
            padding-top: 40px;
            background: url("img/9.png") no-repeat center -52px;
        }

        .seat-item .num {
            position: absolute;
            left: 0;
            width: 1em;
            text-align: right;
            white-space: normal;
            line-height: 22px;
            color: #999999;
        }

        .seat-info {
            position: relative;
            margin: 20px 0;
            padding-left: 18px;
            font-size: 14px;
            width: 60%;
            display: inline-block;
        }

        .seat-info p {
            text-align: center;
            height: 28px;
        }



        .seat-content {
            padding-top: 25px;
        }

        .sidebar {
            float: right;
        }

        .sidebar .t {
            margin-right: 20px;
            color: #000;
            font-size: 18px;
        }

        .sidebar .choose-seat ul {
            position: relative;
            float: right;
            margin: 30px -10px 10px 0;
            width: 196px;

        }

        .selected {
            width: 77px;
            height: 26px;
            line-height: 26px;
            border: none;
            color: #333333;
            background-color: #FAFAFA;
            margin: 2px 2px 0 0;
        }
        .choose-seat .val{
            margin-left: 10px;
            font-size: 24px;
            line-height: 30px;
            vertical-align: -3px;
            font-family: Arial;
            color: #F80;
        }
        .choose-seat .btn:hover{
            background-color: #c76120;
        }
        .choose-seat .center{
            margin-top: 15px;
            text-align: center;
            margin-bottom: 4px;
        }
        .choose-seat .btn{
            margin-bottom: 20px;
            font-size: 19px;
            width: 230px;
            cursor: pointer;
        }
        .seat{
            display: inline-block;
            margin: 0 2px;
            width: 20px;
            height: 17px;
            vertical-align: middle;
            outline: 0;
            background-color: #9bb8aa;
        }
        .seated{
            display: inline-block;
            margin: 0 2px;
            width: 20px;
            height: 17px;
            vertical-align: middle;
            outline: 0;
            background-color: #ff1a29;
        }
        .seatedbay{
            display: inline-block;
            margin: 0 2px;
            width: 20px;
            height: 17px;
            vertical-align: middle;
            outline: 0;
            background-color: #352eff;
        }
    </style>
</head>
<body>
<header>
    <div class="nav">
        <nav>
            <ul class="nav-bar cf">
                <li class="navber-item">
                    <a class="navbar_item" href="/redis/movie">首页</a>
                </li>
                <li class="navber-item">
                    <a class="navbar_item" href="">今日新单</a>
                </li>
                <li class="navber-item">
                    <a class="navbar_item" href="">团购</a>
                </li>
                <li class="navber-item">
                    <a class="navbar_item" href="">电影</a>
                </li>
                <li class="navber-item">
                    <a class="navbar_item" href="">身边外卖</a>
                </li>
                <li class="navber-item">
                    <a class="navbar_item" href="">今日折扣</a>
                </li>
            </ul>
        </nav>
    </div>
</header>
<div id="bd" class="cf">
    <div class="movie">
        <ul class="movie-tab cf">
            <li class="movie-tab_item">
                <a class="movie-tab_item-link" href="">电影首页</a>
            </li>
            <li class="movie-tab_item">
                <a class="movie-tab_item-link" href="">电影院</a>
            </li>
            <li class="movie-tab_item">
                <a class="movie-tab_item-link" href="">电影票团购</a>
            </li>
            <li class="movie-tab_item">
                <a class="movie-tab_item-link" href="">在线选座</a>
            </li>
            <li class="movie-tab_item">
                <a class="movie-tab_item-link" href="">最新电影</a>
            </li>
        </ul>
    </div>

    <div class="content">
        <div class="biz-box movie-box">
            <h2>在线选座</h2>
            <div class="seat-info">
                <div class="seat-item">
                    <h3 class="seat-item-h2">
                        <span>银幕</span>
                    </h3>
                    <div class="seat-content">
                        <?php
                        $redis = new Redis();
                        $redis->connect('127.0.0.1',6379);
                        for($a = 1;$a <=10;$a++){
                            echo '<p><span class="num">'.$a.'</span>';
                            for($i= 1; $i<16;$i++){
                                if($i<10){
                                    if($redis->getbit($_GET['movie'], $a*1000+$i) == 1){
                                        echo '<a href="javascript:;" hidefocus="true" class="seatedbay" title="'.$a.'排0'.$i.'座" status="1"></a>';
                                    }else{
                                        echo '<a href="javascript:;" hidefocus="true" class="seat" title="'.$a.'排0'.$i.'座" status="0"></a>';
                                    }
                                }else{
                                    if($redis->getbit($_GET['movie'], $a*1000+$i) == 1){
                                        echo '<a href="javascript:;" hidefocus="true" class="seatedbay" title="'.$a.'排0'.$i.'座" status="1"></a>';
                                    }else{
                                        echo '<a href="javascript:;" hidefocus="true" class="seat" title="'.$a.'排'.$i.'座" status="0"></a>';
                                    }
                                }
                            }
                            echo '</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="sidebar">
                <div class="choose-seat">
                    <from method="post" action="">
                        <p><span class="t">座位:</span></p>
                        <div class="cf">
                            <ul style="display: block;" id="J_SeatShow" data-price="59" data-fee="4">
                                <li class="selected">--</li>
                                <li class="selected">--</li>
                                <li class="selected">--</li>
                                <li class="selected">--</li>
                            </ul>
                        </div>
                        <p>
                            <span class="t">总价:</span>
                            <span class="val">0.0</span>
                            <span class="val">￥</span>
                        </p>
                        <p class="center">
                            <input id="tijiao" class="btn btn-small" value="提交订单" type="submit">
                        </p>
                    </from>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
