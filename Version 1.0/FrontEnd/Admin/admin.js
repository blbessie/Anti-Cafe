var rowNum = 1;
$(document).ready(function(){
    
        $("#display").click(function() {

            $.ajax({
                url: "/BackEnd/Admin/input.php", 
                type: "post",
                data: {'username': $('#username').val()},                   
                success: function(data){
                    if(data == false) {
                        alert ("Username does not exist.");
                    } else { 
                    $("table tbody").append(data);
                }
            },
            });

        });

        $("#add, #remove, #delete").click(function() {

            var id=this.id;
            
            $.ajax({
                url: "/BackEnd/Admin/admin.php", 
                type: "post",
                data: {'username': $('#username').val(),
                'amount': $('#amount').val(), 'button': id},      
                success: function(data){
                    if(data == false) {
                    alert("Error: not able to respond to the request.");
                    } else { 
                        $("table tbody").append(data);
                }
            },
        });

        });

});