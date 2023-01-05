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


function insert($conection, $formula, $id){
    $update = $conection -> prepare("UPDATE spelling SET spell=? WHERE id=?");
    $update->bind_param('ii',$formula, $id);
    $update -> execute();
    $update-> close();
    }


    $read = $conection -> prepare("SELECT * FROM spelling");
    $read ->execute();
    
	$result=$read->get_result();
   
      
        while($fila=$result->fetch_array(MYSQLI_BOTH)){
          //reading
          $id = $fila['id'];
            //volume 8 (PT)
          if($fila['vol'] == 8){
            //read array
            foreach ($pt as $key => $value) {
                $ptFormula = $value[0];
                $pyrNumStart = $value[1];
                $pyrLetStart =$value[2];
                $pyrNumEnd = $value[3];
                $pyrLetEnd = $value[4];
                $spell = $ptFormula;
    
                //if it's between these numbers
                if(($pyrNumStart <= $fila['pyr_page']) && ($pyrNumEnd >= $fila['pyr_page'])){
                  //if any of them is empty
                    if(($pyrLetStart == "") || ($pyrLetEnd == "")){
                        insert($conection, $spell, $id);
                  //if it's not in the last page
                    } else if ($pyrNumEnd > $fila['pyr_page']){
                        insert($conection, $spell, $id);
                    //if IT IS in the last page
                    } else if($pyrNumEnd == $fila['pyr_page']){
                    //if it is smaller than the letter
                    if($ctLetEnd >= $fila['section']){
                        insert($conection, $spell, $id);
                    }
                    //error tester
                    } else {
                        echo 'Check id -> '. $id.'<br>';
                    }
                }
            }

          } else {
            //ct Formula, Volume, pagina inicio, seccion inicio, pagina final, seccion final.
            // array(1, 1, 1, '', 7, 'd'),
            foreach ($ct as $key => $value) {
                $ctFormula = $value[0];
                $ctVolume = $value[1];
                $ctNumStart = $value[2];
                $ctLetStart =$value[3];
                $ctNumEnd = $value[4];
                $ctLetEnd = $value[5];
                $spell = $ctFormula+714;
                if($ctNumEnd == "NaN"){
                $ctNumEnd = $ctNumStart;
            }
                //if it's the same volume 
            if($ctVolume == $fila['vol']){
                //if it's between these numbers
                if(($ctNumStart <= $fila['page']) && ($ctNumEnd >= $fila['page'])){
                    //if any of them is empty
                    if(($ctLetStart == "") || ($ctLetEnd == "")){
                        insert($conection, $spell, $id);
                    //if it's not in the last page
                    } else if ($ctNumEnd > $fila['page']){
                        insert($conection, $spell, $id);
                    //if IT IS in the last page
                    } else if($ctNumEnd == $fila['page']){
                    //if it is smaller than the letter
                    if($ctLetEnd >= $fila['section']){
                        insert($conection, $spell, $id);
                    }
                    //error tester
                    } else {
                        echo 'Check id -> '. $id.'<br>';
                    }
                }
            }
            }
          }
          
          //stopped

        }
    $read -> execute();
    $read-> close();
        
    $conection-> close();

    ?>
    
</body>
</html>