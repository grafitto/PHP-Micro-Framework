
<script src="<?=loadStatic("js/jquery-1.11.2.min.js")?>"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
<script src="<?=loadStatic("js/bootstrap.min.js")?>"></script>
<script src="<?=loadStatic("js/npm.js")?>"></script>
<script src="<?=loadStatic('js/bootstrap-confirmation.js')?>"></script>
<script type="text/javascript">

$("#add-new-house").click(function(e) {
	console.log("Testing...");
    e.preventDefault();
    $("#new-house-popup").modal();
});
$("#add-new-floor").click(function(e) {
	console.log("Testing...");
    e.preventDefault();
    $("#new-floor-popup").modal();
});
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
$(document).ready(function(){

    $('#floor-form').validate(
    {
     rules: {
       name: {
         minlength: 2,
         required: true
       },
       rooms: {
         required: true,
       },
       roomtype: {
         required: true
       }
     },
     highlight: function(element) {
       $(element).closest('.control-group').removeClass('success').addClass('error');
     },
     success: function(element) {
       element
       .closest('.control-group').removeClass('error').addClass('success');
     }
    });
   }); // end document.ready
</script>
</body>
</html>