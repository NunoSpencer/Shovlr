/*
    JS script to submit requests to the database...
    ...uses javascript to "ajaxify" the html content on request.html (i.e to pass input data from the form to the database)
*/

$(document).ready(function () {
    $(".acceptButton").click(function () {
     
    var $tr = $(this).closest('tr');
    var $id = $tr.find("RequestID").val();
    
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