<?php

function calendario($campo, $defecto)
{

	$campocalendario =	"<html lang='es'>  ";
	$campocalendario .=	"<head>";
	$campocalendario .=	"<title></title>  ";
    $campocalendario .=	"<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js'></script>";
    $campocalendario .=	"<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>  ";
    $campocalendario .=	"<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js'></script>";
    $campocalendario .=	"<link href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css' rel='stylesheet'>";
    $campocalendario .=	"<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js'></script>      ";
	$campocalendario .=	"</head>";
	$campocalendario .=	"<body>";
	$campocalendario .=	"<div class='container'>";
	    $campocalendario .=	"<div class='content'>";
	        $campocalendario .=	"<div class='form-group'>";
	                $campocalendario .=	"<div class='col-md-4'>";
	                    $campocalendario .=	"<div class='form-group'>";
	                        $campocalendario .=	"<label for='date'>Vencimiento</label>";
	                        $campocalendario .=	"<input class='form-control' type='text' id='time' name='vencimiento' value='{{ old('vencimiento') }}'/>";
	                    $campocalendario .=	"</div>";
	                $campocalendario .=	"</div>";
	        $campocalendario .=	"</div>";
	    $campocalendario .=	"</div>";
	$campocalendario .=	"</div>";
	$campocalendario .=	"<script>";
	    $campocalendario .=	"$('#time').datetimepicker({";
	        $campocalendario .=	"format: 'YYYY-MM-DD HH:mm:ss'";
	    $campocalendario .=	"});";
	$campocalendario .=	"</script>";

	$campocalendario .=	"</body>";
	$campocalendario .=	"</html>";

	
	return $campocalendario;

}