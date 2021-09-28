<?php


require_once 'Info.php';
require_once 'Installer.php';
?>

<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="#" method="get">
    <select name="city">
        <option value="Riga">Riga</option>
        <option value="Miami">Miami</option>
        <option value="Vancuver">Vancuver</option>
        <option value="Moscow">Moscow</option>
        <option value="Helsinki">Helsinki</option>
    </select>
    <input type="submit">
</form>

<?php

$city = $_GET['city'];

$url = "http://api.weatherapi.com/v1/forecast.json?key=6ef26322222d411ea7f85230212809&q={$city}&days=3&aqi=no&alerts=no";

$weatherData = json_decode(file_get_contents($url));
$hours = 8;
$count = 0;
$installer = new Installer($weatherData->forecast->forecastday);
$time = (int) explode(":",explode(" ",$weatherData->location->localtime)[1])[0];
//echo '<pre>';
//var_dump($time);


?>


    <div class="container">
        <h2>Weather:</h2>

        <?php foreach ($installer->getDays() as $day):?>

        <div class="box">
            <?='Date: ' . $day->getDate()?><br>
            <?='Max Temp: ' . $day->getMaxTemp(). '℃'?><br>
            <?='Average Temp: '.$day->getAvgTemp(). '℃'?><br>
            <?='Condition: '.$day->getCondition()?>

        </div>
        <?php endforeach;?>
    </div>
<div class="container hour">
    <h2>Hours:</h2>

    <?php foreach ($installer->getDays()[0]->getHours() as $day):?>
    <?php if(($time <= (int) explode(":",explode(" ",$day->time)[1])[0]) && $count < $hours ):?>

        <div class="box">
            <?='Temperature: '. $day->temp_c . '℃'?><br>
            <?='Condition: '.$day->condition->text?><br>
            <?='Time:'.$day->time?><br>
            <?php $count++?>

        </div>
    <?php endif;?>

    <?php endforeach;?>
    <?php $count=0?>

</div>
</body>
</html>
