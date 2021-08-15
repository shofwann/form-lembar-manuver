// $(document).ready(function () {
// 	var i=0;
//     $('#add').click(function(){
//         i++;
//         $('#dynamic_field').append('<tr><td><input type="text" style="border:1px solid #fff;"></td><td><input type="text"></td><td><input type="text"></td></tr>');
//     });
// });

var keyword = document.getElementById('keyword');
var tombolCari = document.getElementById('cari');
var bungkus = document.getElementById('bungkus');

keyword.addEventListener('keyup', function()  {
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
        if( xhr.readyState == 4 && xhr.status == 200 ) {
            bungkus.innerHTML = xhr.responseText;
        }
    }


xhr.open('GET','ajax/data_table.php?keyword=' + keyword.value , true);

xhr.send();


});

function pilihan() {
    var x = document.getElementById('detail_lokasi').value;

    $.ajax({
        url:'ajax/fetchtable1.php',
        method:'POST',
        data: {
            idx : x
        },
        success:function(data){
            $('#table').html(data);
        }
    })



}