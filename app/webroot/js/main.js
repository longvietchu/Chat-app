$(document).ready(function(){
	$("#btn-save").hide();
	if($('#edit-status').val() !== ""){
		$("#btn-send").hide();
		$("#btn-save").show();
	}
});