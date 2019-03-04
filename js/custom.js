// JavaScript Document
window.fbAsyncInit = function() {
    FB.init({
      appId            : 'your-app-id',
      autoLogAppEvents : true,
      xfbml            : true,
      version          : 'v3.2'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/vi_VN/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));

//ajax tìm kiếm


    $(window).on("load resize",function(e){
//       $(document).ready(function(){
           var menu = $('#menu').height();
           var header = $('#header').height();
           var node = $('#node').height();
           var row = $('#row-cus').height();
           var menu_tabs = $('#menu-tabs').height();
    //       var join = $('#join').height();
           var footer = $('#footer').height();
           var height = $(window).height();
           var main_height = height - (menu + header + node +footer + footer + 74);
           $('#main').css('min-height', main_height);
           $(window).bind('scroll', function() {
           var navHeight = menu + header + node + row + menu_tabs + 20;
                 if ($(window).scrollTop() > navHeight) {
                     $('#menu-tabs').addClass('navbar-fixed-top navbar-box');
                 }
                 else {
                     $('#menu-tabs').removeClass('navbar-fixed-top navbar-box');
                 }
            });
//        });
    });

