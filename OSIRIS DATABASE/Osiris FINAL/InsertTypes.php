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
    foreach ($spelling_types as $key => $value) {
        $noSpaceCode = str_replace(" ", "", $value[1]);
        echo $noSpaceCode. " - ",$value[2]. " - ",$value[3]. " - ",$value[4]. " - ", "<br>";
        add($conection,$noSpaceCode,$value[2],$value[3],$value[4]);
    }

    function add($conection, $code, $spelling_group, $disposition, $length){
        $add = $conection -> prepare("INSERT INTO spelling_type(code, spelling_group, disposition, length) VALUES (?,?,?,?)");
        $add->bind_param('sssi', $code, $spelling_group, $disposition, $length);
        $add -> execute();
        $add-> close();
        }



    $conection->close();


echo "HECHO";
?>
</body>
</html> 

