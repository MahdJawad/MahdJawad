<?php 

function dateToEn($dateFr)
{
	return date("Y/m/d",strtotime($dateFr));
}

function datetimeToFr($datetime)
{
	return date('d/m/Y \&\a\g\r\a\v\e\; H:i:s',strtotime($datetime));
}


function dateToFr($dateEn)
{ if(($dateEn=='0000-00-00')or($dateEn==''))
	{return 'Non d&eacute;finie';}
	else{
	return date("d/m/Y",strtotime($dateEn));}
}