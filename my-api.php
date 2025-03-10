<?php

$mysqli = new mysqli('localhost', '2217962','R34NissanGTR0_01!','db2217962');

if($mysqli -> connect_errno){
    echo 'Failed to connect to MySQL:'. $mysqli -> connect_error;
    exit();
}

$sql = "SELECT *
        FROM weather
        WHERE city = '{$_GET['city']}'
        AND weather_when >= DATE_SUB(NOW(), INTERVAL 10 SECOND)
        ORDER BY weather_when DESC limit 1";

$result = $mysqli -> query($sql);

if($result == false){
    echo("<h4>SQL error description:" . $mysqli -> error . '</h4>');

}

if ($result -> num_rows == 0){
    include('data.php');
    $result = $mysqli -> query($sql);
}


$row = $result -> fetch_assoc();
print json_encode($row);

$result -> free_result();
$mysqli -> close();

?>
        