!function(e){"use strict";var t=e(window);t.on("load",function(){var a=e(document),n=e("html, body"),o=e("body"),s=e(".loader-container"),i=e(".main-nav"),l=e(".drop-menu"),r=e(".counter");s.delay("500").fadeOut(2e3),a.on("click",".hamburger",function(){e(this).toggleClass("is-active"),i.slideToggle()}),l.parent("li").children("a").append(function(){return'<span class="drop-menu-toggle"><i class="far fa-angle-down"></i></span>'}),a.on("click",".drop-menu-toggle",function(){var t=e(this);return t.toggleClass("active"),t.parent().parent().siblings().children("a").find(".drop-menu-toggle").removeClass("active"),t.parent().parent().children(".drop-menu").slideToggle(),t.parent().parent().siblings().children(".drop-menu").slideUp(),!1}),t.on("resize",function(){t.width()>991?(i.show(),l.show()):(i.hide(),l.hide())}),t.on("scroll",function(){var a=e(".main-menu-header"),n=e(".header-outer");t.scrollTop()>100?(a.addClass("fixed-top"),o.css("padding-top",n.outerHeight()+"px")):(a.removeClass("fixed-top"),o.css("padding-top","0"));var s=e("#scroll-to-top");t.scrollTop()>300?s.addClass("is-active"):s.removeClass("is-active")}),a.on("click","#scroll-to-top",function(){return n.animate({scrollTop:0},800),!1});var c=e('[data-fancybox="preview-video"]'),d=e('[data-fancybox="about-video"]');c.length&&c.fancybox(),d.length&&d.fancybox(),r.length&&r.counterUp({delay:20,time:2e3});var p=e(".client-logo-carousel");p.length&&p.owlCarousel({loop:!0,items:5,nav:!1,dots:!1,smartSpeed:500,autoplay:!0,responsive:{0:{items:1},480:{items:2},991:{items:3},1280:{items:5}}});var u=e(".client-logo-carousel-2");u.length&&u.owlCarousel({loop:!0,items:4,nav:!1,dots:!1,smartSpeed:500,autoplay:!0,responsive:{320:{items:2},481:{items:3},768:{items:4}}});var m=e(".client-testimonial");m.length&&m.owlCarousel({loop:!0,items:1,nav:!1,dots:!0,smartSpeed:500,autoplay:!1});var g=e(".service-carousel");g.length&&g.owlCarousel({loop:!0,items:3,nav:!1,dots:!0,smartSpeed:700,autoplay:!1,margin:0,responsive:{0:{items:1},600:{items:2},992:{items:3}}});var v=e('[data-toggle="tooltip"]');v.length&&v.tooltip();var f=e(".select-picker");f.length&&f.selectpicker(),a.on("click",".qtyDec, .qtyInc",function(){var t=e(this),a=t.parent().find(".qtyInput").val();if(t.hasClass("qtyInc"))var n=parseFloat(a)+1;else n=a>0?parseFloat(a)-1:0;t.parent().find(".qtyInput").val(n)});var h=e(".lazy");h.length&&h.lazy();var y,C=document.querySelector("#send-message-btn"),w=e(".contact-form"),b=e(".alert-message");function x(e){C.innerHTML="Send Message",b.fadeIn().removeClass("alert-danger").addClass("alert-success"),b.text(e),setTimeout(function(){b.fadeOut()},3e3),w.find('input:not([type="submit"]), textarea').val("")}function T(e){C.innerHTML="Send Message",b.fadeIn().removeClass("alert-success").addClass("alert-danger"),b.text(e.responseText),setTimeout(function(){b.fadeOut()},3e3)}w.submit(function(t){t.preventDefault(),y=e(this).serialize(),C.innerHTML="Sending...",setTimeout(function(){e.ajax({type:"POST",url:w.attr("action"),data:y}).done(x).fail(T)},2e3)}),e(".toggle-password").on("click",function(){e(this).toggleClass("active");var t=e(".password-field");"password"===t.attr("type")?t.attr("type","text"):t.attr("type","password")})})}(jQuery);




$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})


$(document).ready(function(){

    //COUNTDOWN TIMER
    //edit ".25" below to change time in terms of day
/*
    var deadline = new Date(Date.now() + 9132*24*3600*1000);

    var x = setInterval(function() {
    
    var now = Date.now();
    var t = deadline - now;
    var days = Math.floor(t / (1000 * 60 * 60 * 24));
    var hours = Math.floor((t%(1000 * 60 * 60 * 24))/(1000 * 60 * 60));
    var minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((t % (1000 * 60)) / 1000);
      document.getElementById("day").innerHTML =days ;
      document.getElementById("hour").innerHTML =hours;
      document.getElementById("minute").innerHTML = minutes;
      document.getElementById("second").innerHTML =seconds;
      if (t < 0) {
              clearInterval(x);
              document.getElementById("day").innerHTML ='0';
              document.getElementById("hour").innerHTML ='0';
              document.getElementById("minute").innerHTML ='0' ;
              document.getElementById("second").innerHTML = '0'; }
    }, 1000);
      */
    //COUNTDOWN BAR
    
    function progress(timeleft, timetotal, $element) {
        var progressBarWidth = timeleft * $element.width() / timetotal;
        $element.find('div').animate({ width: progressBarWidth }, timeleft == timetotal ? 0 : 1000, 'linear');
        if(timeleft > 0) {
            setTimeout(function() {
                progress(timeleft - 1, timetotal, $element);
            }, 1000);
        }
    };
    //adjust these numbers to match time set
    //must be in seconds
    progress(1740, 1740, $('#progressBar'));
    
    });
    



    $('#find-data').click(function(){
        $('#no-data').fadeOut('slow');
        $('#data').fadeIn(2000);
    });