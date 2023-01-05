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

    //recorre las tuplas y las mete en un array (todo lo que no sea id)
    $conection = new mysqli("db", "root", "root", "osiris");
    $conection-> set_charset("utf8");

       
    
   // habrá que coger el id (siendo la primera columna) y meterla en una variable

    $spelling = 1972; //esto representa la columna/spelling

    // id	vol	page	section	pyr_page	pyr_sect	is_locution	type	spell	location	document	


    //SACADOR DE COINCIDENCIAS / INFORMACIÓN DE LOS SPELLINGS
    function sacarCoincidence($conection, $spelling, $documento, $volumen, $code, $volNum,$spellyngType){
        $add = $conection -> prepare("INSERT INTO spelling (id, vol, page, section, is_locution, type, spell, position, document) VALUES (?,?,?,?,?,?,?,?,?)");
        
        echo "<br> DOCUMENTO: ", $documento;
        echo "<br> VOLUMEN: ", $volNum;
        $pagina = ltrim($code,  $volumen); //devuelve lo restante del codigo
        $numbers = preg_replace('/[^0-9]/', '', $pagina);
        echo "<br> PÁGINA: ", $numbers;
        $letters = preg_replace('/[^a-zA-Z]/', '', $pagina);
        echo "<br> SECCION: ", $letters;
        // sacarSpell();
        // sacarLocalizacion();
        echo "<br>-----------<br>"; 
        
        $id=$spelling;
        $vol= $volNum;
        $page= $pagina;
        $section=$letters;
        $is_locution=1;
        $type=$spellyngType;
        $type=  str_replace(" ", "",$type);
        $spell=1;
        $location="None";
        $document=  str_replace(" ", "",$documento);
        $add->bind_param('iiisisiss',$id,$vol,$page,$section,$is_locution,$type,$spell,$location,$document);
        $add -> execute();
    
       
 
        $add-> close();
    }

    //SACADOR DE COINCIDENCIAS VOL 8
    function sacarCoincidenceVol8($conection, $spelling, $documento, $volumen, $code, $volNum,$spellyngType){
        $add = $conection -> prepare("INSERT INTO spelling (id, vol, page, pyr_page, pyr_sect, is_locution, type, spell, position, document) VALUES (?,?,?,?,?,?,?,?,?,?)");

        echo "<br> DOCUMENTO: ", $documento;
        echo "<br> VOLUMEN: ", $volNum, "<br>";
        $array = explode ("(", $code); //primero, separamos el codigo en dos arrays
        print_r($array);
        echo "<br> ";
        $numbers = preg_replace('/[^0-9]/', '', $array[0]);
        echo "<br> PÁGINA: ", $numbers;
        $pyr = ltrim($array[1],  "Pyr. ");
        $pyrNum = preg_replace('/[^0-9]/', '', $pyr);
        echo "<br> PYR NUM: ", $pyrNum; 
        $pyrLet = preg_replace('/[^a-zA-Z]/', '', $pyr);
        echo "<br> PYR LET: ", $pyrLet; 
        // sacarSpell();
        // sacarLocalizacion();

        // getSpellPT($documento, $pyrNum);


        echo "<br>-----------<br>";
        $id=$spelling;
        $vol=$volNum;
        $page=$numbers;
        $pyr_page= $pyrNum;
        $pyr_sect=$pyrLet;
        $is_locution=1;
        $type=$spellyngType;
        $type=  str_replace(" ", "",$type);
        $spell=1;
        $location="None";
        $document=  str_replace(" ", "",$documento);
        $add->bind_param('iiiisisiss',$id,$vol,$page,$pyr_page,$pyr_sect,$is_locution,$type,$spell,$location,$document);
        $add -> execute();
        
        $add-> close();
    }


    
        foreach ($locution as $key => $value) {
            $documento= $value[0];
            $a_cadenas = $value;
            $a = array_shift($a_cadenas);
            $spellyngType = 0;
            foreach ($a_cadenas as $cadena) { //recorremos el array
            //PRINCIPIO DE FOR
            $spellyngType++;

        if($cadena == ""){ //si no hay nada, no se inserta nada
            echo "<br>"."(no se ha encontrado)"."<br>";
        } else { //si se encuentra algo se entra
            echo "<br>";
            echo "(encontrado)";
            $linea = explode (";", $cadena); //se separan las lineas (separadas por ";") y se meten en un array
            echo "<br> LINEA DE CODIGOS BAJO ESTE SPELLING= ";
            print_r($linea);
            echo "<br>";
           array_pop($linea); //se elimina el ultimo elemento para que no quede un hueco vacío en el array 
            foreach ($linea as $code) { //recorremos la lineas y separamos las coincidencias
                echo "<br> SPELLING No = ", $spelling;
                $spelling++;
                echo "<br> CÓDIGO: ",$code;

                $volumen = 0;
                $volumen1 = "CT I ";
                $volumen2 = "CT II ";
                $volumen3 = "CT III ";
                $volumen4 = "CT IV ";
                $volumen5 = "CT V ";
                $volumen6 = "CT VI ";
                $volumen7 = "CT VII ";
                $volumen8 = "CT VIII ";
                if(strpos($code, $volumen1) !== false){ //sacamos el valor del volumen y lo metemos en una variable
                    $volNum = 1;
                    sacarCoincidence($conection, $spelling, $documento, $volumen1, $code, $volNum, $spelling_type_code[$spellyngType]);
                } else if(strpos($code, $volumen2) !== false){
                    $volNum = 2;
                    sacarCoincidence($conection, $spelling,$documento, $volumen2, $code, $volNum,$spelling_type_code[$spellyngType]);
                } else if(strpos($code, $volumen3) !== false){
                    $volNum = 3;
                    sacarCoincidence($conection, $spelling,$documento, $volumen3, $code, $volNum,$spelling_type_code[$spellyngType]);
                } else if(strpos($code, $volumen4) !== false){
                    $volNum = 4;
                    sacarCoincidence($conection, $spelling,$documento, $volumen4, $code, $volNum,$spelling_type_code[$spellyngType]);
                } else if(strpos($code, $volumen5) !== false){
                    $volNum = 5;
                    sacarCoincidence($conection, $spelling,$documento, $volumen5, $code, $volNum,$spelling_type_code[$spellyngType]);
                } else if(strpos($code, $volumen6) !== false){
                    $volNum = 6;
                    sacarCoincidence($conection, $spelling,$documento, $volumen6, $code, $volNum,$spelling_type_code[$spellyngType]);
                } else if(strpos($code, $volumen7) !== false){
                    $volNum = 7;
                    sacarCoincidence($conection, $spelling,$documento, $volumen7, $code, $volNum,$spelling_type_code[$spellyngType]);
                } else if(strpos($code, $volumen8) !== false){
                    $volNum = 8;
                    sacarCoincidenceVol8($conection, $spelling,$documento, $volumen8, $code, $volNum,$spelling_type_code[$spellyngType]);
                } else {
                    echo "ERROR";
                    echo "<br>";
                }
                }

        }
    }
    //fin de FOR
}

$conection->close();

?>
</body>
</html> 

