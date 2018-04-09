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

        //Puts Phone in correct format ERROR HERE
        //Phone = Phone.replace(/ /g,"");
        //Phone = Phone.replace(/-/g,"");
        //Phone = "1401" + Phone;
        //alert(Phone);

        var MissingData = "";

        //alert(AreaSize);

        if (FName == "") {MissingData = MissingData + "First Name\n";}
        if (LName == "") {MissingData = MissingData + "Last Name\n";}
        if (Phone == "1401") {MissingData = MissingData + "Phone\n";}
        if (AreaSize == "choice") {MissingData = MissingData + "Area Size\n";}
        if (Street == " ") {MissingData = MissingData + "Street\n";}
        if (City == "") {MissingData = MissingData + "City\n";}
        if (Zip == "") {MissingData = MissingData + "Zip\n";}

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

