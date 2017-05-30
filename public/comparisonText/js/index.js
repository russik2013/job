/**
 * Created by User on 30.05.2017.
 */
function sendText() {
    console.log('send text');
    $( "#input" ).show();
    $( "#upload" ).hide();
    $( "#urls" ).hide();
}

function uploadFile() {
    console.log('uploadFile');
    $( "#input" ).hide();
    $( "#upload" ).show();
    $( "#urls" ).hide();
}

function getURLs() {
    console.log('send text');
    $( "#input" ).hide();
    $( "#upload" ).hide();
    $( "#urls" ).show();
}
function doMagic() {
    if ($( "#input" ).is(':visible')) {
        $.ajax({
            type: 'POST',
            url: '/chekText',
            data: {'ru' : 'rus'},
            success: function(data) {
                console.log(data);
            },
            error:  function(xhr, str){
                console.log('Не успех');
                //  alert('Возникла ошибка: ' + xhr.responseCode);
            }
        });
        console.log('input viden');
    }
    if ($( "#upload" ).is(':visible')) {
        console.log('upload viden');
    }
    if ($( "#urls" ).is(':visible')) {
        console.log('urls viden');
    }

}
$(document).ready(function() {

    $( "#input" ).show();
    $( "#upload" ).hide();
    $( "#urls" ).hide();
});