// JavaScript Document

$(function(){
	$(".teacherList li").hover(
		function(){
			$(this).find("p").show().end().find(".shadowAll").show().end().find(".detail").animate({'bottom':'10px'},300,'linear');
		},
		function(){
			$(this).find("p").hide().end().find(".shadowAll").hide().end().find(".detail").animate({'bottom':'25px'},300,'linear');
		}
	)
})