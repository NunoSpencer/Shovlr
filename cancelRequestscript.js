$(document).ready( function(e)
{
    $('#cancelRequestButton').click( function() 
    {  

        var user = $('#userType').val();
        var id = $('#requestID').val();
        var MissingData = "";

        if (user == "choice") {MissingData = MissingData + "What type of user are you?\n";}
        if (id == "") {MissingData = MissingData + "Request ID\n";}
        

        if(MissingData != ""){
            alert("Please fill in the following to contiune: \n\n" + MissingData);
            return false;
        }  
    });

    $.ajax
    (
        {
            type: 'POST',
            data: {user: userType, id: requestID},
            url : "cancelquery.php",
            success: function(result)
            {  
                alert(result);
            }

        }
    );


});