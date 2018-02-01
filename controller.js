/*
    we are using javascript to "ajaxify" the html content from (request.html)... 
    this means to load the html content (i.e. the requester's info) to the database w/out the need to reload the html page...
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

