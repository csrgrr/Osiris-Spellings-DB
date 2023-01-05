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


//seleccionar id 

function establishDocument($conection, $position, $document, $spell){

//insertar en locattion donde el sarcofaho y el spell coincidadn

    $update = $conection -> prepare("UPDATE spelling SET position=? WHERE document LIKE ? AND spell=?");
    $update->bind_param('ssi',$position, $document, $spell);
    $update -> execute();
    $update-> close();
    }



    for ($i=0; $i < count($documentos_cod); $i++) { 
        $noSpaceCode = str_replace(" ", "",  $documentos_cod[$i]);
        // echo $i+1, ' -> ', $noSpaceCode; //remove espace
        
    
        for ($j=0; $j < count($posiciones); $j++) { 
            if($posiciones[$j][$i+1] == ""){
            echo ' ';   
            } else {
                $spell = $posiciones[$j][0];
                $position = $posiciones[$j][$i+1];
                
    $spell = $spell+714;

            echo '|| en el Sarcofago ',$noSpaceCode,' con el spell ',  $spell, ' se encuentra en -> ', $posiciones[$j][$i+1], '||<br>';
            establishDocument($conection, $position, $noSpaceCode, $spell); //insetar
            }
           
    
        }
    }
    

$conection->close();





?>
    
</body>
</html>