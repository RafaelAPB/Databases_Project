<html>

    <body>
<?php
    try
    {
    	$host = "db.ist.utl.pt";
        $user ="ist181719";
        $password = "grupo45";
        $dbname = $user;
        
        $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $url = "../app.php";  


        if(isset($_REQUEST["moradaEspOferta"]) && isset($_REQUEST["codigoEspOferta"]) && isset($_REQUEST["tarifaOferta"]) && isset($_REQUEST["inicioOferta"]) && isset($_REQUEST["fimOferta"])) {
            $moradaOferta = $_REQUEST["moradaEspOferta"];
            $codigoOferta = $_REQUEST["codigoEspOferta"];
            $tarifaOferta = $_REQUEST["tarifaOferta"];
            $inicioOferta = $_REQUEST["inicioOferta"];
            $fimOferta = $_REQUEST["fimOferta"];
          
            insertOferta($db,$moradaOferta ,$codigoOferta,$inicioOferta,$fimOferta,$tarifaOferta);
        }

        
        $db = null;
  



        header( "Location: $url" );   
	}

    catch (PDOException $e){
	   echo("<p>ERROR: {$e->getMessage()}</p>");
    }

function insertOferta ($db,$morada,$codigo,$dataInicio,$dataFim,$tarifa)  {

    try{
        
        $valores= array($morada,$codigo,$dataInicio,$dataFim,$tarifa);

        $sql = "INSERT INTO oferta(morada, codigo, data_inicio, data_fim, tarifa) VALUES(?,?,?,?,?)" ;
        $stmt = $db->prepare($sql); 
        $affected_rows  = $stmt->execute($valores);

    }

    catch (Exception $e)  {
      echo("<p>Nao e possivel inserir a oferta.</p>"); 
    }
}

?>
    </body>
</html>
