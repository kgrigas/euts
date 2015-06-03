/**
 * Created by Karolis on 21/08/14.
 */

$(function(){

    $('a[href^=#section]').click(function(e){
        e.preventDefault();
        var body = $("html, body");
        var target = $($(this).attr('href'));
        body.animate({scrollTop: target.offset().top});
    });

});
