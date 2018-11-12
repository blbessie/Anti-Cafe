var rowNum = 1;
$(document).ready(function(){
        $("#create-user").click(function(){
            var first = $("#first").val();
            var last = $("#last").val();
            var amount = $("#amount").val();
            var markup = //"<tr><th scope="+"row>" + rowNum + "</th>" +
                            "<tr><td>" + rowNum + "</td>" +
                            "<td>" + first + "</td>" +
                            "<td>" + last + "</td>" +
                            "<td>$" + amount + "</td>" +
                            "<td><input type='checkbox'></td></tr>";
            $("table tbody").append(markup);
            rowNum++;
            //clear value after submit
            $("#first").val("");
            $("#last").val("");
            $("#amount").val("");
        });

        // Find and remove selected table rows
         $("#delete-user").click(function(){
            $("table tbody").find('input[type="checkbox"]').each(function(){
                if($(this).is(":checked")){
                    var curRow = $(this).closest('tr').children("td:first").html();
                    $(this).parents("tr").next().children("td:first").html(curRow);
                    $(this).closest('tr').remove();

                }
            });
            rowNum--;
        });
    });
