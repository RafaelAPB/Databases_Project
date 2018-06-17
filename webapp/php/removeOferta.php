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

        
        removeOferta($db,$_REQUEST["morada"],$_REQUEST["codigo"],$_REQUEST["dataInicio"],$_REQUEST["dataFim"],$_REQUEST["tarifa"]);


        $db = null;
        $url = "../app.php";
        header( "Location: $url" );   
	}

    catch (PDOException $e){
	   echo("<p>ERROR: {$e->getMessage()}</p>");
    }


function removeOferta ($db,$morada,$codigo,$dataInicio,$dataFim,$tarifa)  {
    
    try{
        
      $valores= array($morada,$codigo,$dataInicio,$dataFim,$tarifa);
      $sql = "DELETE FROM  oferta WHERE morada = ? AND codigo = ? AND data_inicio = ? AND data_fim = ? AND tarifa = ?";
      $stmt = $db->prepare($sql);
      $affected_rows  = $stmt->execute($valores);

    }

    catch (Exception $e)  {
      echo("<p>Nao e possivel remover o Oferta.</p>"); 
    }
}
?>
    </body>
</html>
