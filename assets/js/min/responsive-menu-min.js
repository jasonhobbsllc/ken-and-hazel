jQuery(function($){$("header .genesis-nav-menu, .nav-primary .genesis-nav-menu").addClass("responsive-menu").before('<div class="responsive-menu-icon"></div>'),$(".responsive-menu-icon").click(function(){$(this).next("header .genesis-nav-menu, .nav-primary .genesis-nav-menu").slideToggle()}),$(window).resize(function(){window.innerWidth>1200&&($("header .genesis-nav-menu, .nav-primary .genesis-nav-menu, nav .sub-menu").removeClass("responsive-menu"),$(".responsive-menu > .menu-item").removeClass("menu-open"))}),$(".responsive-menu > .menu-item").click(function(e){e.target===this&&$(this).find(".sub-menu:first").slideToggle(function(){$(this).parent().toggleClass("menu-open")})})});