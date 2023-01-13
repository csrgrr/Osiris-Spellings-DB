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
    //Head = H
    //Foot = F
    //Back = B
    //Top = L
    //Front = Fr
    //Bottom = Bo

$conection = new mysqli("db", "root", "root", "osiris");
$conection-> set_charset("utf8");


//seleccionar id 

function establishPositionPT($conection, $position, $id){
$update = $conection -> prepare("UPDATE spelling SET position=? WHERE id LIKE ?");
$update->bind_param('si',$position, $id);
$update -> execute();
$update-> close();
}


$prepare = $conection -> prepare("SELECT * FROM spelling WHERE vol =8");
$prepare -> execute();
$resultado = $prepare -> get_result();

echo"
<table>
<tbody>";
while($fila = $resultado -> fetch_array()){

$id = $fila['id'];
$pyrPage = $fila['pyr_page'];
$pyrSect = $fila['pyr_sect'];
$position= $fila['position'];
$document = $fila['document'];

foreach ($positionPT as $value) {
        // document, location, pyrNum inicio, pyrLet inicio, pyrNum final, pyrLet final
    //     array("B14C", "L", 638, "a", 638, "b"),
               // 0       1     2    3    4   5
    
    if($document == $value[0]){
    if(($pyrPage>=$value[2]) && ($pyrPage<=$value[4])){
        if($pyrSect == ""){
            if($position == "unknown"){
            establishPositionPT($conection,$value[1], $id);
            $newPos = $value[1];
            echo "<br> established ${newPos} on ${id}";
            } else {
                if(str_contains($position, $value[1]) == false){
                    $newPos = $position. " & ". $value[1];
                    establishPositionPT($conection,$newPos, $id);
                    echo "<br> established ${newPos} on ${id}";
                }
            }
        } else {
            if((($pyrSect>=$value[3]) && ($pyrSect<=$value[5]))||(($value[3]=="")|| ($value[5]==""))){
                if($position == "unknown"){
                    establishPositionPT($conection,$value[1], $id);
                    $newPos = $value[1];
                    echo "<br> established ${newPos} on ${id}";
                    } else {
                            if(str_contains($position, $value[1]) == false){
                            $newPos = $position. " & ". $value[1];
                            establishPositionPT($conection,$newPos, $id);
                            echo "<br> established ${newPos} on ${id}";
                        }
                    }
            }
        }
    } 
}
}


}

echo"
</tbody>
</table>
";


$prepare -> close();
    

    



$conection->close();






// $positionPT
// $positionPT(
    //en el libro, pt es equivalente a pyr
    // document, location, pyrNum inicio, pyrLet inicio, pyrNum final, pyrLet final



    //Tiene que ser Vol 8
    //si se repite el codigo hay que especificarlo como F & H (si  no son el mismo)
    //comprobar que el final es mayor o igual para evitar errores
    
    // array("Ab1Le", "Fr", 173, "", 175, "b"),



    ?>
</body>
</html>
