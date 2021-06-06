$(document).ready(function () {
	var i=0;
    $('#add').click(function(){
        i++;
        $('#dynamic_field').append('<tr><td><input type="text" style="border:1px solid #fff;"></td><td><input type="text"></td><td><input type="text"></td></tr>');
    });
});


