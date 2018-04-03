/*
    pass selected request info from front-end 
*/

$(document).ready(function () 
{
    $(".acceptButton").click(function () 
    { 
        var $tr = $(this).closest('tr');
        var $id = $tr.find("RequestID").val();    //value of "RequestId" for selected request
    });
    
    $.ajax
    (
        {
            type: 'POST',
            data: {id: id},
            url : "accept.php",
            success: function(result)
            {  
                alert(result);
            }

        }
    );


});