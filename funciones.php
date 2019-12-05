<?php
	//Esta funcion se realiza para convertir el numero que se encuentra en la posicion $value[1] que corresponde
	// a la fecha y mostrarlo como una fecha legible
	function format_data($time)
	{
		$mescat=array(" ","Gen","Feb","Mar","Abr","Mai","Jun","Jul","Ago","de Sep","de Oct","de Nov","Dec");
		$dia=date("d",$time);
		$mes=$mescat[date ("n",$time)];
		$any=date ("Y",$time);
		$data=$dia.'/'.$mes.'/'.$any;
		return $data;
	}