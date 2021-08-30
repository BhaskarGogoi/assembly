//Disable right click
//$(document).bind('copy', function(e) { alert('Copy is not allowed !!!'); e.preventDefault(); }); $(document).bind('paste', function() { alert('Paste is not allowed !!!'); e.preventDefault(); }); $(document).bind('cut', function() { alert('Cut is not allowed !!!'); e.preventDefault(); }); $(document).bind('contextmenu', function(e) { alert('Right Click is not allowed !!!'); e.preventDefault(); })
//End disable right click


let viewPassword = false;
function changePwdView() {
	let getPwdView =  document.getElementById("passwordView");

	if (viewPassword === false) {
		getPwdView.setAttribute("type", "text");
		viewPassword = true;
	} 
	else if (viewPassword === true) {
		getPwdView.setAttribute("type", "password");
		viewPassword = false;
	} 
}

//scrollToTop
jQuery("#backtotop").click(function () {
    jQuery("body,html").animate({
        scrollTop: 0
    }, 600);
});
jQuery(window).scroll(function () {
    if (jQuery(window).scrollTop() > 100) {
        jQuery("#backtotop").addClass("visible");
    } else {
        jQuery("#backtotop").removeClass("visible");
    }
});


//auto active navbar
$(function() {
	$("#active-dashboard a:contains('Dashboard')").parent().addClass('active');
	$("#active-assembly-members a:contains('Assembly Members')").parent().addClass('active');
	$("#active-admin-login a:contains('Admin Login')").parent().addClass('active');
	$("#active-dept-login a:contains('Department Login')").parent().addClass('active');
	$("#active-account a:contains('Account')").parent().addClass('active');
	$("#active-register a:contains('Register')").parent().addClass('active');
});

