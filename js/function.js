function mycarousel_initCallback(carousel) {
    $('.slider-nav a').bind('click', function() {
        carousel.scroll(jQuery.jcarousel.intval(jQuery(this).index()+1));
        return false;
    });	    
};
	
function mycarousel_itemFirstInCallback(carousel, item, idx, state) {
	$('.slider-nav a').removeClass('active');
	$('.slider-nav a').eq(idx-1).addClass('active');
};

function search_url(o) {
	o.action = o.action + '/' + o.elements[1].value;
	
	return true;
}

$(function(){
	$('.games-list li').hover(function(){
		$(this).addClass('hover');
	}, function(){
		$(this).removeClass('hover');
	});
	
	$('.entry-list ul li').hover(function(){
		$(this).addClass('hover');
	},function(){
		$(this).removeClass('hover');
	});
	
	$('.entry-list ul li').click(function(){
		window.location.href = $(this).find('a:eq(1)').attr('href');
		return false;
	});
	
	$(".tab").hide(); 
	$("ul.tabs-nav li:eq(1)").addClass("active").show(); 
	$(".tab:eq(1)").show(); 
	
	$("ul.tabs-nav  li a").click(function() {
		$("ul.tabs-nav li").removeClass("active");
		$(this).parents('li').addClass("active");
		$(".tab").hide();
		var activeTab = $(this).attr("href");
		$(activeTab).fadeIn();
		return false;
	});
	
	$(".slider-cnt").jcarousel({
		auto: 5,
		scroll: 1,
		wrap: 'both',
		vertical: true,
		itemFirstInCallback: mycarousel_itemFirstInCallback,
		initCallback: mycarousel_initCallback,
		itemVisibleOutCallback: {
            onBeforeAnimation: function(idx){
            	$('.slider-cnt ul li .slide-cnt').fadeOut('fast');
            },
            onAfterAnimation: function(){
            	$('.slider-cnt ul li .slide-cnt').fadeIn('fast');
            }
        },
		buttonNextHTML: null,
		buttonPrevHTML: null
	}); 
	
	$('.field').focus(function () {
		if ($(this).val() == $(this).attr('title')) {
			$(this).val('');
		}
	});
	
	$('.field').blur(function () {
		if ($(this).val() == '') {
			$(this).val($(this).attr('title'));
		}
	});
	
	$('.login-form input.fake-pass').focus(function(){
		$(this).hide();
		$('.login-form input.true-pass').show().focus();
	});
	$('.login-form input.true-pass').blur(function(){
		if($(this).val()==""){
			$(this).hide();
			$('.login-form input.fake-pass').show();
		}
	});
	
	$('.search-form input.field').focus(function(){
		$('.search-form').addClass('active-form');
	});
	$('.search-form input.field').blur(function(){
		$('.search-form').removeClass('active-form');
	});
	
	$("a.iframe").fancybox({
		"width": 620,
		"height": 480
	});
});