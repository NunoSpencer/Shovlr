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
        var AreaSize = $('#AreaSizeList').val();
        var PlowTruck = $('input[type="radio"]').val();
        var StreetNumber = $('#street_number').val();
        var StreetRoute = $('#route').val();
        var Street = StreetNumber.concat(' ', StreetRoute);
        var City = $('#locality').val();
        var Zip = $('#postal_code').val();

        var MissingData = "";

        //alert(AreaSize);

        if (FName == "") {MissingData = MissingData.concat("First Name\n");}
        if (LName == "") {MissingData = MissingData.concat("Last Name\n");}
        if (Phone == "") {MissingData = MissingData.concat("Phone\n");}
        if (AreaSize == "choice") {MissingData = MissingData.concat("Area Size\n");}
        if (Street == " ") {MissingData = MissingData.concat("Street\n");}
        if (City == "") {MissingData = MissingData.concat("City\n");}
        if (Zip == "") {MissingData = MissingData.concat("Zip\n");}

        if(MissingData != ""){
            alert("Please fill in the following to contiune: \n\n" + MissingData);
            return false;
        }  
    });

    $.ajax
    (
        {
            type: 'POST',
            data: {LName: LName, FName: FName, Phone: Phone, AreaSize: AreaSize, PlowTruck: PlowTruck, Street: Street, City: locality, Zip: postal_code},
            url : "submitquery.php",
            success: function(result)
            {
                //$("#result").html(info);  
                alert(result);
            }

        }
    );


});

