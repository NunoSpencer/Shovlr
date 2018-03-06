/*
    JS script to submit requests to the database...
    ...uses javascript to "ajaxify" the html content on request.html (i.e to pass input data from the form to the database)
*/

$(document).ready( function(e)
{
    $('#submitButton').click( function() 
    {  
        var LName = $('#LName').val();
        var FName = $('#FName').val();
        var Phone = $('#Phone').val();
        var AreaSize = $('#AreaSize').val();
        var Street = $('#Street').val();
        var City = $('#City').val();
        var Zip = $('#Zip').val();
    });

    $.ajax
    (
        {
            type: 'POST',
            data: {LName: LName, FName: FName, Phone: Phone, AreaSize: AreaSize, Street: Street, City: City, Zip: Zip},
            url : "submitquery.php",
            success: function(result)
            {
                //$("#result").html(info);  
                alert(result);
            }

        }
    );


});

