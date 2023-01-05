<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
        <style>

     

/*TABLA */
table{
margin-top: 0;
padding-top: 0;
width: 80%;
text-align: center;
}

   table,
   th,
   tr,
   td {
       border: solid black 1px;
       border-collapse: collapse;
   }

   th {
       color: greenyellow;
       background-color: black;
   }

   tbody tr :first-child {
       font-style: italic;
       font-weight: 800;
   }


</style>
</head>
<body>

<?php
include "dataSpell.php";
// array('CT1', 'I 004 e 1 - 005 e 1'),

$arrayLimpio; // spell, volumen, pagina inicio, seccion inicio, pagina final, seccionfinal
             //    0      1           2                3             4              5
$contador = 0;

foreach ($arraySucio as $columna) {
    //SPELL
    $spell = $columna[0];
    $spell = preg_replace('/[^0-9]/', '', $spell);

    
$arrayLimpio[$contador][0] = $spell;

    //COLUMNA 2 separada
    $columna2 = $columna[1];
    $columna2 =  explode (" ", $columna2);

    //VOL
    $code = $columna2[0];
    $volumen = 0;
    if($code == "I"){
        $volumen = 1;
    } else if($code == "II"){
        $volumen = 2;
    } else if($code == "III"){
        $volumen = 3;
    } else if($code == "IV"){
        $volumen = 4;
    } else if($code == "V"){
        $volumen = 5;
    } else if($code == "VI"){
        $volumen = 6;
    } else if($code == "VII"){
        $volumen = 7;
    } else if($code == "VIII"){
        $volumen = 8;
    } else {
        $volumen = "error";
    }


$arrayLimpio[$contador][1] = $volumen;

    //COLUMNA 2 separada por - 
    $columnaGuion = $columna[1];
    $columnaGuion = explode ("-", $columnaGuion);

//CON VARIOS 37  b 2 - 023 f 1 
    if(count($columnaGuion) > 1){
    //IZQUIERDA
         //PAGINA
         $elemento = $columnaGuion[0];
         $elemento = explode (" ", $elemento);
         $pagina = preg_replace('/[^0-9]/', '', $elemento[1]);
         $pagina = (int)$pagina;
         $arrayLimpio[$contador][2] = $pagina;
         //SECCION
         $seccion = preg_replace('/[^a-zA-Z]/', '', $elemento[2]);
         $arrayLimpio[$contador][3] = $seccion;   

    //DERECHA
    //CON NUMEROS
    if(strlen($columnaGuion[count($columnaGuion)-1]) > 4){
        //PAGINA
        $elemento = $columnaGuion[count($columnaGuion)-1];
        $elemento = explode (" ", $elemento);
        $pagina1 = preg_replace('/[^0-9]/', '', $elemento[1]);
        $pagina1 = (int)$pagina1;
        $arrayLimpio[$contador][4] = $pagina1;
        //SECCION
        $seccion2 = preg_replace('/[^a-zA-Z]/', '', $elemento[2]);
        $arrayLimpio[$contador][5] = $seccion2;

    //SOLO LETRAS
    } else {
        $seccion2 = $columnaGuion[count($columnaGuion)-1];
        $seccion2 = preg_replace('/[^a-zA-Z]/', '', $seccion2);
        $arrayLimpio[$contador][4] = "";
        $arrayLimpio[$contador][5] = $seccion2;

    }

//UNICO
    } else{

    //PAGINA
    $elemento = $columnaGuion[0];
    $elemento = explode (" ", $elemento);
    $pagina = preg_replace('/[^0-9]/', '', $elemento[1]);
    $pagina = (int)$pagina;
$arrayLimpio[$contador][2] = $pagina;
    //SECCION
    $seccion = preg_replace('/[^a-zA-Z]/', '', $elemento[2]);

$arrayLimpio[$contador][3] = $seccion;
$arrayLimpio[$contador][4] = "";
$arrayLimpio[$contador][5] = "";
    }
// spell, volumen, pagina inicio, seccion inicio, pagina final, seccionfinal

    $contador++;
}   
//  echo "<table>
//         <thead>
//         <tr>
//         <th>INIDICE +1</th>
//         <th>SPELL</th>
//         <th>VOLUMEN</th>
//         <th>PAGINA INICIO </th>
//         <th>SECCION INICIO</th>
//         <th>PAGINA FINAL</th>
//         <th>SECCION FINAL</th>
//         </tr>
//         </thead>
//         <tbody>";
//         $contador1 = 1;
// foreach ($arrayLimpio as $key => $value) {

      
//             echo "<tr>
//             <td>", $contador1, "</td>
//             <td>", $value[0], "</td>
//             <td>", $value[1], "</td>
//             <td>", $value[2], "</td>
//             <td>", $value[3], "</td>
//             <td>", $value[4], "</td>
//             <td>", $value[5], "</td>
//             </tr>";  
//             $contador1++;
        
// }
// echo "</tbody>
// </table>";
// 1185	7	521	b	521	f
//REFACTOR TABLE
$arraySpells;
 // spell, volumen, pagina inicio, seccion inicio, pagina final, seccionfinal
//    0      1           2                3             4              5
$contador = 0;
$primero = true;
for ($i=0; $i < count($arrayLimpio); $i++) {
    //la siguiente columna tiene el mismo spell??
    if($arrayLimpio[$i+1][0] == $arrayLimpio[$i][0]){
        //es el primero
        if($primero == true){
            $arraySpells[$contador][0]= $arrayLimpio[$i][0];
            $arraySpells[$contador][1]= $arrayLimpio[$i][1];
            $arraySpells[$contador][2]= $arrayLimpio[$i][2];
            $arraySpells[$contador][3]= $arrayLimpio[$i][3];

            if(!is_numeric($arraySpells[$contador][2])) {
                $arraySpells[$contador][2] ="NaN";
            }

            $primero = false;
        }

    }
    if($primero == false){
    //la siguiente columna es diferente
    if($arrayLimpio[$i+1][0] != $arrayLimpio [$i][0]) {
        //entonces introduce en la que estás
        //SI hay algo en "seccion o pagina final" introduce el final
        if(($arrayLimpio[$i][4] != "") || ($arrayLimpio[$i][5] != "")) {
             $arraySpells[$contador][4]= $arrayLimpio[$i][4];
             $arraySpells[$contador][5]= $arrayLimpio[$i][5];
        //SINO introduce IZQUIERDA
        } else {
            $arraySpells[$contador][4]= $arrayLimpio[$i][2];
            $arraySpells[$contador][5]= $arrayLimpio[$i][3];
        }
        if(!is_numeric($arraySpells[$contador][4])) {
            $arraySpells[$contador][4] ="NaN";
        }
        //sumamos al contador
        $contador++;
        $primero = true;

    }
    
    }
}

// echo "<table>
// <thead>
// <tr>
// <th>SPELL</th>
// <th>VOLUMEN</th>
// <th>PAGINA INICIO </th>
// <th>SECCION INICIO</th>
// <th>PAGINA FINAL</th>
// <th>SECCION FINAL</th>
// </tr>
// </thead>
// <tbody>";
foreach ($arraySpells as $key => $value) {

    // array(1, 1, "", 7, "d"),

// SPELL	VOLUMEN	PAGINA INICIO	SECCION INICIO	PAGINA FINAL	SECCION FINAL
// 1        	1	      1		                               7	    d
    echo "array(", $value[0], ", ", $value[1], ", ", $value[2], ", '",$value[3], "', ", $value[4],", '", $value[5],"'),<br>";
}




?>
    
</body>
</html>