/*
    we are using javascript to "ajaxify" the html content from (request.html)... 
    this means to load the html content (i.e. the requester's info) to the database w/out the need to reload the html page...
*/

/* version 1

$("#submitButton").click( function() {                                      //when user clicks "Submit" button...
    var data = $("#SubmitRequestForm : input").serializeArray() ;           //serialize the data from form to array "data"

    $.post( $("#SubmitRequestForm").attr("action"), data, function(info) {  //do post and "ajaxify"...
        $("#result").html(info);                                            //display output message from "submitquery.php" (i.e. echo "Request was submitted sucessfully" or echo "Failed to querying into database!")

    } );
});

$("#SubmitRequestForm").submit( function() {                                //prevents from redirecting after submiting query...
    return false;
});

*/ 


// VERSION 2

$(document).ready( function(e)
{
    $('#submitButton').click( function() 
    {  
        var FName = $('#FName').val();
        var LName = $('#LName').val();
        var Phone = $('#ContactPhone').val();
        var AreaSize = $('#AreaSize').val();
        var Street = $('#street').val();
        var City = $('#city').val();
        var Zip = $('#zip').val();
    });

    $.ajax
    (
        {
            type: 'POST',
            data: {FName: FName, LName: LName, Phone: Phone, AreaSize: AreaSize, Street: Street, City: City, Zip: Zip},
            url : "submitquery.php",
            success: function(result)
            {
                alert(result);
            }

        }
    );


});

