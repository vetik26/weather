<?php


require_once 'Info.php';
require_once 'Installer.php';
//echo '<pre>';
//print_r($installer->getDays());
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
        <?php foreach ($installer->getDays() as $day):?>
        <div class="box">
            <?=$day->getMaxTemp()?><br>
            <?=$day->getAvgTemp()?><br>
            <?=$day->getCondition()?>

        </div>
        <?php endforeach;?>
    </div>
<div class="container hour">
    <?php foreach ($installer->getDays()[0]->getHours() as $day):?>
    <?php if(($time <= (int) explode(":",explode(" ",$day->time)[1])[0]) && $count < $hours ):?>

        <div class="box">
            <?=$day->temp_c?><br>
            <?=$day->condition->text?><br>
            <?=$day->time?><br>
            <?php $count++?>

        </div>
    <?php endif;?>
        <?php $count=0?>
    <?php endforeach;?>
</div>
</body>
</html>
