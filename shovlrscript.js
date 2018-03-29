/*
    JS script to ACCEPT requests and submit shoveler acceptance information to the database...
    ...uses javascript to "ajaxify" the html content on AcceptRequest.html (i.e to pass input data from the form to the database)
*/

$(document).ready( function(e)
{
    $('#shovelBTN').click( function() 
    {  
        var id = $('#id').val();

        var shovelerFName = $('#shovelerFName').val();
        var shovelerLName = $('#shovelerLName').val();
        var shovelerPhone = $('#shovelerPhone').val();
        
        var MissingData = "";

        //alert(id);
        
        //input validation (all fields are required)
        if (shovelerFName == "") {MissingData = MissingData.concat("Your First Name\n");}
        if (shovelerLName == "") {MissingData = MissingData.concat("Your Last Name\n");}
        if (shovelerPhone == "") {MissingData = MissingData.concat("Your Phone\n");}
       
        if(MissingData != "")
        {
            alert("Please fill in the following to continue: \n\n" + MissingData);
            return false;
        }  
    });

    $.ajax
    (
        {
            type: 'POST',
            data: {id : id, shovelerFName: shovelerFName, shovelerLName: shovelerLName, shovelerPhone: shovelerPhone},
            //data: {id: id},
            url : "acceptshovelquery.php",
            success: function(result)
            {
                //$("#result").html(info);  
                alert(result);
            }

        }
    );


});

//notes display table under the the n requests
