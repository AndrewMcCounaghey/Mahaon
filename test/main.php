<?php

function config($optionName, $defaultValue=null){
    $config = require ('settings.php');
    error_reporting(E_ERROR | E_PARSE);
    $arr = array();

    $optionName = explode(".", $optionName);
    $count = count($optionName);
    $config = array($config);

    foreach ($config as $item){
        if($count ==1){
            $arr[] = $item[$optionName[0]];
        }
        elseif($count == 2){
            $arr[] = $item[$optionName[0]][$optionName[1]];
        }
        elseif($count == 3){
            $arr[] = $item[$optionName[0]][$optionName[1]][$optionName[2]];

        }
        elseif($count >3){
            $arr[] = $item[$optionName[0]][$optionName[1]][$optionName[2]][$optionName[3]];

        }

    }
    $val = implode(" ", $arr);
    if($defaultValue== null and isset($arr[0])==true){
        echo $val,"\n";
        if (empty($val)){
            throw new Exception('Исключение!');
        }
    }
    elseif($defaultValue!= null and isset($arr[0])!=true){
        $optionName = implode(".", $optionName);
        echo 'Существующая опция со значением по-умолчанию: ', $optionName,'=>', $defaultValue, "\n";
    }
    else{
        throw new Exception('Исключение!');
    }

}
echo config("site_name"); // http://mysite.ru
echo config("db.name"); // admin
echo config("app.services.resizer.prefer_format"); // jpeg

echo config("db.localhost", "localhost"); //localhost

echo config("asd.123"); // Исключение