<?php

/**
* change date format
* 2017-09-25 09:00:59
* to
* 25 Setembro, 2017
* @param $number
*/

function formatDate($date)
{ 
	$year  = substr($date, 0, 4);
	$month = substr($date, 5, 2); 
	$day   = substr($date, 8, 2);

	switch ($month) {
	    case '01': $monthEx = 'Janeiro'; break;
	    case '02': $monthEx = 'Fevereiro'; break;
	    case '03': $monthEx = 'Março'; break;
	    case '04': $monthEx = 'Abril'; break;
	    case '05': $monthEx = 'Maio'; break;
	    case '06': $monthEx = 'Junho'; break;
	    case '07': $monthEx = 'Julho'; break;
	    case '08': $monthEx = 'Agosto'; break;
	    case '09': $monthEx = 'Setembro'; break;
	    case '10': $monthEx = 'Outubro'; break;
	    case '11': $monthEx = 'Novembro'; break;
	    case '12': $monthEx = 'Dezembro'; break;
	}

	return $day.' '.$monthEx.', '.$year;
}