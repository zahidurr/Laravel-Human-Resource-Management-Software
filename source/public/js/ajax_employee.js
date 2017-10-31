jQuery(document).ready(function($){

    //load function to display unread notice notification
    getUnreadNoticeNumber();

    //load function to set Punch Button view
    setAttendancePunchButton();
});

/**
* Ajax call to server to show unread notification number
*/
function getUnreadNoticeNumber () {
    $.ajax({
        type: "GET",
        url : baseUrl() + "/ajax/notice-notifications",
        processData: false,
        contentType: false,
        cache: false,
        success : function(data){
            $("#notice-notification").html(data);
        }
    },"json");

    setTimeout(function(){getUnreadNoticeNumber();},5000);
}

/**
* Ajax call to server to show available notices
*/
function getNoticesList () {
    $.ajax({
        type: "GET",
        url : baseUrl() + "/ajax/show-notices",
        processData: false,
        contentType: false,
        cache: false,
        success : function(data){
            $("#total-notice-list").html(data);
        }
    },"json");
}

/**
* Set attendance Punch In via ajax to database
*/
function attendancePunchIn () {
    $.ajax({
        type: "GET",
        url : baseUrl() + "/ajax/punch-in",
        dataType: 'json',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        success : function(data){
            //display when upload successful
            if(data.success) {
                $("#attendance-punch-in").css("display", "none");
                $("#attendance-punch-out").css("display", "block");
                $("#punch-in-error").html('');
            } else {
                $("#punch-in-error").html(data.message);
            }
        }

    });
}

/**
* Set attendance Punch out via ajax to database
*/
function attendancePunchOut () {
    $.ajax({
        type: "GET",
        url : baseUrl() + "/ajax/punch-out",
        processData: false,
        contentType: false,
        cache: false,
        success : function(data){
            $("#attendance-punch-out").css("display", "none");
            $("#attendance-punch-in").css("display", "block");
        }
    },"json");
}

/**
* Set last Punched Button
*/
function setAttendancePunchButton () {
	var href = window.location.href.split('/');

    $.ajax({
        type: "GET",
        url : baseUrl() + "/ajax/set-punch-button",
        processData: false,
        contentType: false,
        cache: false,
        success : function(data){
            if(data == 'I') {
                $("#attendance-punch-in").css("display", "none");
                $("#attendance-punch-out").css("display", "block");
            } else {
                $("#attendance-punch-out").css("display", "none");
                $("#attendance-punch-in").css("display", "block");
            }
        }

    },"json");
}

/**
* get base URL
*/
function baseUrl() {
	var href = window.location.href.split('/');

	var uri = '';
	for (var i = 3; i < href.length; i++)
	{
		uri += '/' + href[i];
		if(href[i] == 'employee-panel') break;
	}

	return uri;
}
