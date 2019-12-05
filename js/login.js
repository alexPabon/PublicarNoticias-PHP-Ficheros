$(document).ready(function(){

	$("form").on("submit", function(e){

		e.preventDefault();
		var flag = true;

		if($("#user").val()==""){
			$("#user").addClass("error");
			flag = false;
		}else{
			$("#user").removeClass("error");
		}

		if($("#pass").val()==""){
			$("#pass").addClass("error");
			flag = false;
		}else{
			$("#pass").removeClass("error");
		}

		if(flag)
			document.getElementById("login").submit();
		

	});

});