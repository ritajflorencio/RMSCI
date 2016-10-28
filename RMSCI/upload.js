$(document).ready(function (e) {
$("#uploadsql").on('submit',(function(e) {
e.preventDefault();
$("#message").empty();
$('#loading').show();
$('#spinner').show();
$.ajax({
url: "upload.php", // Url to which the request is send
type: "POST",             // Type of request to be send, called as method
cache: false,
contentType: false, 
data: new FormData(this),
processData: false,            // To unable request pages to be cached
success: function(data)   // A function to be called if request succeeds
{
$('#loading').hide();
$('#spinner').hide();
$("#message").html(data);
}
});
}));


});