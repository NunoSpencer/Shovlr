$(document).ready(function () {
    $(".cancelBTN").click(function () {
    
    var $id = $('#id').val();
    
    });
    
    $.ajax
    (
        {
            type: 'POST',
            data: {id: id},
            url : "cancel.php",
            success: function(result)
            {  
                alert(result);
            }

        }
    );


});