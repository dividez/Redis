/**
 * Created by 张鹏翼 on 2016/8/12.
 */
$(function () {

    //座位对象
    var aTagName = $(".seat");
    //支付金额对象
    var payVal = $(".val");
    //展示的座位详情对象
    var seatShow = $("#J_SeatShow>li");
    //已经选择多少个座位
    var num = 0;
    //支付金额
    var pay = 0;
    //座位
    var seatArray = "";
    //点击事件
    aTagName.click(function () {

        var str = $(this).attr('class');
        var selected = $(this).attr('status');
        var title = $(this).attr('title');
        if (selected == 0) {
            //如果大于0  说明已经选中了
            if (str.indexOf('seated') >= 0) {
                $(this).attr('class', 'seat');
                pay -= 40;
                num--;
                lessShowSeat(num);
            } else if (num < 4) {//当没选中的时候  而且选择的还不够四张票的时候
                $(this).attr('class', 'seated');
                pay += 40;
                addShowSeat(num, title);
                num++;
            } else {
                alert('最多单词购买四张票');
            }
        } else {
            alert("这个座位已经卖出去了");
        }
    });
    //展示
    function addShowSeat(n, seat) {
        seatShow.eq(n).text(seat);
        payVal.eq(0).text(pay);
    }

    //移除
    function lessShowSeat(n) {
        seatShow.eq(n).text('--');
        payVal.eq(0).text(pay);
    }

    $("#tijiao").click(function () {
        var tt = "";
        var set = ['one', 'two', 'three', 'four'];
        for (var i = 0; i < num; i++) {
            tt += set[i] + '=' + seatShow.eq(i).text().replace("排", '-').replace("座", '&');
        }
        var str = tt.substring(0, tt.length - 1);
        console.log(str);
        if (str == "") {
            alert("请选择座位后再提交！");
            location = "bay.php";
        } else {
            $.ajax({
                type: "post",
                url: 'server.php',
                dataType: "html",
                data: str,
                success: function (msg) {
                    alert(msg);
                    location = "bay.php";
                }
            });
        }
    });
});


