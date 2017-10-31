/**
 * modal view for Delete confirmation
 */
function confirmAction(name, url, action_name)
{
    //default action name
    if(!action_name) action_name = 'delete';

    $('#confirmActionModal').modal('show');
    $(".modal-body").html("<p>Do you want to " + action_name + " " + name + "?</p>");

    $("#confirmActionButton").click(function(){
        // Create a form element
        var $form = $('<form/>', {action: url, method: 'post'});
        // Add the DELETE hidden input method
        var $inputMethod = $('<input/>', {type: 'hidden', name: '_method', value: 'delete'});
        // Add the token hidden input
        var $inputToken = $('<input/>', {type: 'hidden', name: '_token', value: ''});
        // Append the inputs to the form, hide the form, append the form to the <body>, SUBMIT !
        $form.append($inputMethod, $inputToken).hide().appendTo('body').submit();

    });
}

/**
 * modal for Disable Delete Info
 */
function disabledAction(info)
{
    $('#disabledActionModal').modal('show');
    $(".modal-body").html("<p>" + info + "</p>");
}
