$(document).ready(
	$('#county-select').change(function(){
		id=$(this).val();
		console.log(id);
		window.location.href = 'dashboard/index/'+id;
	})
);