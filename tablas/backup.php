<?php
	require '../server/serverConexion.php';
	$db=$mysqli;
	$tables = '*';
	$return="";
	//get all of the tables
    if($tables == '*'){
        $tables = array();
        $result = $db->query("SHOW TABLES");
        while($row = $result->fetch_row()){
            $tables[] = $row[0];
        }
    }else{
        $tables = is_array($tables)?$tables:explode(',',$tables);
    }
    //loop through the tables
    foreach($tables as $table){
        $result = $db->query("SELECT * FROM $table");
        $numColumns = $result->field_count;

        $return .= "DROP TABLE $table;";

        $result2 = $db->query("SHOW CREATE TABLE $table");
        $row2 = $result2->fetch_row();

        $return .= "nn".$row2[1].";nn";

        for($i = 0; $i < $numColumns; $i++){
            while($row = $result->fetch_row()){
                $return .= "INSERT INTO $table VALUES(";
                for($j=0; $j < $numColumns; $j++){
                    $row[$j] = addslashes($row[$j]);
                    $row[$j] = mb_ereg_replace("n","n",$row[$j]);
                    if (isset($row[$j])) { $return .= '"'.$row[$j].'"' ; } else { $return .= '""'; }
                    if ($j < ($numColumns-1)) { $return.= ','; }
                }
                $return .= ");n";
            }
        }

        $return .= "nnn";
    }
    //echo "algo";
    //save file
    date_default_timezone_set("America/Bogota");
    $handle = fopen('db-backup-'.date('Y-m-d').'.sql','w+');
    fwrite($handle,$return);
    fclose($handle);
    
?>
<html>
    <body>
        <button onclick="descargarArchivo()">Descargar archivo</button>
        <script>
            function descargarArchivo() {
                const fechaActual = new Date();
                const year = fechaActual.getFullYear();
                const month = ('0' + (fechaActual.getMonth() + 1)).slice(-2);
                const day = ('0' + fechaActual.getDate()).slice(-2);
                const fechaEnFormatoYYYYMMDD = year + '-' + month + '-' + day;
                const url= 'db-backup-' + fechaEnFormatoYYYYMMDD + '.sql';
                
  window.location = url;
  setTimeout(function() {
    window.history.back();
  // La función que se ejecuta después de la pausa
}, 1000);
  
   
}
        </script>
    </body>
</html>
