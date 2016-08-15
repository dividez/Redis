/**
 * Created by  on 2016/8/15.
 */
$(function () {
    var movieInfo = $(".movie-info");
    var movieList = $(".mt-slider-sheet");
    for (var i = 0 ; i < movieList.length;i++){
        movieList.eq(i).click(function (n) {
            return function () {
                show(n);
            }
        }(i));
    }
    function show(n) {
        for (var j=0 ; j< movieInfo.length;j++){
            if (j == n){
                movieInfo.eq(n).removeClass('movieChouse');
            }else {
                movieInfo.eq(j).addClass('movieChouse');
            }
        }
    }
});

