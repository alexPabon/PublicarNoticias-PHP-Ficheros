$(document).ready(function(){

	$("form").on("submit", function(e){

		e.preventDefault();
		var flag = true;

		$("form input").each(function(index){

			if($(this).val()==""){
				$(this).addClass("error");
				flag = false;
			}else{
				$(this).removeClass("error");
			}
		});

		if($("#pass").val()!=$("#pass2").val()){
			$("#pass2").addClass("error");
			flag = false;
		}

		if(flag)
			document.getElementById("registro").submit();
		
	});

});