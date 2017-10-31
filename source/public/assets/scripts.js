$(function() {

    //set menu status if hide or not
    if(localStorage.hide_left_menu && localStorage.hide_left_menu == "true") {
        $('#sidebar').hide('fast', function() {
              $('#content').removeClass('span9');
              $('#content').addClass('span12');
              $('.hide-sidebar').hide();
              $('.show-sidebar').show();
        });
    }

    // Side Bar Toggle
    $('.hide-sidebar').click(function() {
	    $('#sidebar').hide('fast', function() {
            $('#content').removeClass('span9');
            $('#content').addClass('span12');
            $('.hide-sidebar').hide();
            $('.show-sidebar').show();
        });

        //set and remember to hide menu
        localStorage.hide_left_menu = "true";
	});

	$('.show-sidebar').click(function() {
        $('#content').removeClass('span12');
        $('#content').addClass('span9');
        $('.show-sidebar').hide();
        $('.hide-sidebar').show();
        $('#sidebar').show('fast');

        //set and remember to show menu
        localStorage.hide_left_menu = "false";
	});
});


//this function used to go back to last visited page
function redirectBack () {
    history.back();

    return false;
}
