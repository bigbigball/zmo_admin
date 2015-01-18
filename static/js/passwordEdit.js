// JavaScript Document
$(function(){
	$(".select").click(function(){
		
		var childUl = $(this).children("ul");
		if( childUl.is(":visible") ){
			childUl.slideUp();	
		}else{
			childUl.slideDown();
		}
	})
	
	$(".select li").click(function(){
		$(this).parent("ul").siblings("span").text( $(this).text() );
		if($(this).text() == '手机验证'){
			get_phone_number();                                                                                                    
		}else if($(this).text() == '邮箱验证'){
			get_mail();
		}
	})
	
})