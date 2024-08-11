<?php
// Import plugins

// precode functions
include ('../libs/plugins/function.precode.php');

// Función para redirigir a una página diferente
function redirectTo($url) {
    header("Location: " . $url);
    exit();
}
// Función para mostrar el tamano de la carga

function convert($size){
  $unit=array('b','kb','mb','gb','tb','pb');
  return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
}

// Starts the timer and returns the start time.
function start_timer() {
    return microtime(true);
}

// Ends the timer and calculates the elapsed time.
function end_timer($start_time) {
    return microtime(true) - $start_time;
}
