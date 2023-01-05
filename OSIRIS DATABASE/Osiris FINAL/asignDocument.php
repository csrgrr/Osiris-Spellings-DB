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


    for ($i=0; $i < count($document); $i++) { 
        $codeDocument = str_replace(" ", "", $document[$i][0]);
        $index = $i+1;
        echo $index, " - ", $codeDocument, '<br>';
        establishDocument($conection,$codeDocument, $index);
    }

function establishDocument($conection, $document, $docNum){
        $update = $conection -> prepare("UPDATE spelling SET document=? WHERE document = ?");
        $update->bind_param('ss', $document, $docNum);
        $update -> execute();
        $update-> close();
        }

      $conection->close();

    ?>
</body>
</html>