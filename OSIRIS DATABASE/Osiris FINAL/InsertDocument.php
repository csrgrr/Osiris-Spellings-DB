<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    include "data.php";

    $conection = new mysqli("db", "root", "root", "osiris");
    $conection-> set_charset("utf8");

    function establishDocument($conection, $code, $time, $location, $type){
        $add = $conection -> prepare("INSERT INTO document (code, time, location, type) VALUES (?,?,?,?)");

        //type will be updated later, but by the time it will be a coffin, since most of them are this kind of document
        $add->bind_param('ssss',$code, $time, $location, $type);
        $add -> execute();
    
        $add-> close();
        }

    foreach ($document as $key => $value) {
        $noSpaceCode = str_replace(" ", "", $value[0]);
        establishDocument($conection, $noSpaceCode,$value[1],$value[2],"coffin");  //it will be updated later, but by the time it will be a sarcophagus, since most of them are this kind of document
    }




    $conection->close();



?>
</body>
</html> 

