(function($) {
	"use strict";

	/*-----------------------------------------------------------------------------------*/
	/*	Site Navigation
	/*-----------------------------------------------------------------------------------*/
	$('#navbar .navbar-menu').mobileMenu({className: 'form-control'})
	$('#navbar .navbar-menu li').each(function(){
		$(this).filter('.active').parents('li').addClass('active');
		if ( $('ul', this).length > 0 )
			$(this).children('a').append(' <i class="sub-indicator fa fa-angle-down fa-fw text-muted"></i>')
	})
	$('#navbar .navbar-menu, #navbar .navbar-user').superfish({
		animation: {opacity:'show', height:'show'},
		delay: 100,
		speed: "fast"
	})
	$('#navbar .navbar-user > li > a').on('click', function() {
		$(this).parent().toggleClass('opened')
	})

	$('#order_callback').on('click', function(event) {
		event.preventDefault();
		$('.fog2').show().stop().animate({opacity:1}, 300);
	});
	 
	
	/*-----------------------------------------------------------------------------------*/
	/*	Main Search
	/*-----------------------------------------------------------------------------------*/
	 
	$('#header-search .search-field').on('focus', function() {
		$('#header-search .search-advance-button').fadeIn()
		$('#header-search .search-advance').slideDown()
	})
	$('#header-search .search-advance-button').on('click', function(e) {
		e.preventDefault()
		$(this).fadeOut(100)
		$('#header-search .search-advance').slideUp(100)
	})

	/*-----------------------------------------------------------------------------------*/
	/*	Tooltip
	/*-----------------------------------------------------------------------------------*/
	$('[data-toggle="tooltip"]').tooltip()

	/*-----------------------------------------------------------------------------------*/
	/*	Accordion
	/*-----------------------------------------------------------------------------------*/
	$('.accordion .accordion-toggle').prepend('<i class="fa fa-caret-down fa-fw pull-left text-danger"></i>')

	/*-----------------------------------------------------------------------------------*/
	/*	Section
	/*-----------------------------------------------------------------------------------*/
	$('.section-title').prepend('<i class="line"></i>')

	/*-----------------------------------------------------------------------------------*/
	/*	Tweets List
	/*-----------------------------------------------------------------------------------*/
	$('#tweets-list').carousel()
	
})(jQuery);