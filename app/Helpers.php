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

function formatDateBR($date)
{ 
    $year  = substr($date, 0, 4);
    $month = substr($date, 5, 2); 
    $day   = substr($date, 8, 2);

    return $day.'/'.$month.'/'.$year;
}

function formatDateTimeBR($date)
{ 
    $year  = substr($date, 0, 4);
    $month = substr($date, 5, 2); 
    $day   = substr($date, 8, 2);

    return $day.'/'.$month.'/'.$year.' '.substr($date, 10, 9);
}

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'ano',
        'm' => 'mes',
        'w' => 'semana',
        'd' => 'dia',
        'h' => 'hora',
        'i' => 'minuto',
        's' => 'segundo',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {

        	if($v=='mes'){
        		$plural = 'es';
        	}else{
        		$plural = 's';
        	}
            
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? $plural : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' atrás' : 'agora mesmo';
}