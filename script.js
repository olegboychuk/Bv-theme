!function($){"use strict";$(window).on("load",(function(){})),$(document).ready((function(){var w=$(window).width(),headerHeight=($(window).height(),$(".header").outerHeight());AOS.init(),$(".mobile-menu-trigger").on("click",(function(){$(this).toggleClass("open"),$(".mobheader-row").toggleClass("open");var menu=$(".the-mobile-menu");menu.hasClass("active")?(menu.removeClass("view"),setTimeout((()=>{menu.removeClass("active")}),500)):(menu.addClass("active"),setTimeout((()=>{menu.addClass("view")}),500))})),w<767&&$("main").css("margin-top",headerHeight),$(".the-mobile-menu .main-menu li a").on("click",(function(){$(".mobile-menu-trigger").trigger("click")}))}))}(jQuery);