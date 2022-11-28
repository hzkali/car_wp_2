jQuery(document).ready(function($) {
  $('#default').on('click', function(e) {
    var linkcss = 'http://wp1.themexlab.com/wp/carshire/wp-content/themes/carshire/';
    $('link[rel*=jquery]').remove();
    $('head').append('<link rel="stylesheet jquery" href="'+linkcss+'css/color.php?main_color=fb4848" type="text/css" />');
    return false;
  });

  $('#green').on('click', function(e) {
    var linkcss = 'http://wp1.themexlab.com/wp/carshire/wp-content/themes/carshire/';
	$('link[rel*=jquery]').remove();
    $('head').append('<link rel="stylesheet jquery" href="'+linkcss+'css/color.php?main_color=76c381" type="text/css" />');
	return false;
  });

  $('#orange').on('click', function(e) {
    var linkcss = 'http://wp1.themexlab.com/wp/carshire/wp-content/themes/carshire/';
    $('link[rel*=jquery]').remove();
    $('head').append('<link rel="stylesheet jquery" href="'+linkcss+'css/color.php?main_color=d37b46" type="text/css" />');
	return false;
  });
  
  $('#purple').on('click', function(e) {
    var linkcss = 'http://wp1.themexlab.com/wp/carshire/wp-content/themes/carshire/';
    $('link[rel*=jquery]').remove();
    $('head').append('<link rel="stylesheet jquery" href="'+linkcss+'css/color.php?main_color=e281ef" type="text/css" />');
	return false;
  });
  
  $('#yellow').on('click', function(e) {
    var linkcss = 'http://wp1.themexlab.com/wp/carshire/wp-content/themes/carshire/';
    $('link[rel*=jquery]').remove();
    $('head').append('<link rel="stylesheet jquery" href="'+linkcss+'css/color.php?main_color=f8ca00" type="text/css" />');
	return false;
  });
  
  $('#teal').on('click', function(e) {
    var linkcss = 'http://wp1.themexlab.com/wp/carshire/wp-content/themes/carshire/';
    $('link[rel*=jquery]').remove();
    $('head').append('<link rel="stylesheet jquery" href="'+linkcss+'css/color.php?main_color=008080" type="text/css" />');
	return false;
  });



  if ($.cookie('boxed') == "yes") {
            $("body").addClass("boxed");
        }

  if ($.cookie('boxed') == "no") {
    $("body").removeClass("boxed");
  }
});

jQuery(document).ready(function($) {
	$("#boxed").on('click', function(e) { 
	e.preventDefault();
	$('body').addClass("boxed");
    $.cookie('boxed','yes', {expires: 7, path: '/'});
	return false;
	});
	$("#full").on('click', function(e) { 
	e.preventDefault();
	$('body').removeClass("boxed");
    $.cookie('boxed','no', {expires: 7, path: '/'});
	return false;
	});
});


jQuery(document).ready(function($) {
	$(".switcher .fa-cog").on('click', function(e) {
	e.preventDefault();
	$(".switcher").toggleClass("active");
	});
});