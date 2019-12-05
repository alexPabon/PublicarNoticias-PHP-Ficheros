$(document).ready(function(){

	$("form").on("submit", function(e){
		e.preventDefault();
		var flag = true;

		if($("#titulo").val()==""){
			$("#titulo").addClass("error");
			flag = false;
		}else{
			$("#titulo").removeClass("error");
		}

		if($("#contenido").val()==""){
			$("#contenido").addClass("error");
			flag = false;
		}else{
			$("#contenido").removeClass("error");
		}

		if(flag)
			document.getElementById("insertar").submit();
		
	});

});