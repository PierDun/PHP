<?php
session_start();
$start = microtime(true);
$x = str_replace(",", ".", $_GET['X']);
$y = str_replace(",", ".", $_GET['Y']);
$r = str_replace(",", ".", $_GET['R']);
$check = "НЕТ!";
$currentTime = date("H:i:s", strtotime('-1 hour'));

echo "<!DOCTYPE html> 
       <html> 
       <head> 
       <meta charset='UTF-8'> <title>Points</title>
            <link rel='stylesheet' type='text/css' href='main.css'>
       </head> 
       <body style='background-image: none'> <div style=\"text-align: center;\">
       <div class='container' style='padding:20px 0;'> <br> <table class='points'>";

if (is_numeric($x) && is_numeric($y) && is_numeric($r) && $y <= 5 && $y >= -3 && $r >= 1 && $r <= 4) {
    if (
        ($x <= 0 && $y >= 0 && (pow($x, 2) + pow($y, 2)) <= pow($r, 2)) ||
        ($x <= 0 && $y <= 0 && $x >= -$r && $y >= -($r / 2)) ||
        ($x >= 0 && $y >= 0 && ($y + $x) <= $r)
    ) $check = "ДА!";

    $time = number_format(microtime(true) - $start, 6) . " мсек";

    $array[0] = $x;
    $array[1] = $y;
    $array[2] = $r;
    $array[3] = $check;
    $array[4] = $currentTime;
    $array[5] = $time;

    if (!isset($_SESSION['array'])) {
        $_SESSION['array'] = array();
    }

    array_push($_SESSION['array'], $array);

    echo "<tr>  <td>X</td> <td>Y</td> <td>R</td> <td>Попадает</td> <td>Время</td> <td>Время выполнения</td>  </tr>";

    foreach ($_SESSION['array'] as $item) {
        foreach ($item as $value) {
            echo "<td>$value</td>";
        }
        echo "</tr>";
    }

    echo "</table> <br> </center> </body> </html>";
}