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

        session_start();
        $nif = $_SESSION["nif"]; 

        insertReserva($db,$_REQUEST["morada"],$_REQUEST["codigo"],$_REQUEST["dataInicio"],$nif);

        $db = null;

        header( "Location: $url" );   
	}

    catch (PDOException $e){
	   echo("<p>ERROR: {$e->getMessage()}</p>");
    }

function insertReserva ($db,$morada,$codigo,$dataInicio,$nif)  {

    try{
        $currentYear = date(Y);
        $numFormat = $currentYear."-%";

        $sql = "SELECT r.numero 
                FROM reserva r
                WHERE r.numero LIKE '".$numFormat."'";
        $rows  = $db->query($sql);
        $maximo = 0;
        
        foreach ($rows as $valor) {
            
            $aux = str_split($valor['numero'],5);

            $aux2 = $aux[1];
  
            if ($aux2 >= $maximo) {
                $maximo = $aux2;
            }
        }
        $maximo = $maximo+1;
        $numero = $currentYear."-".$maximo;
 
        $valoresReserva= array($numero);

        $db->beginTransaction();        

        $sql = "INSERT INTO reserva(numero) values(?)"; 
        $stmt = $db->prepare($sql); 
        $affected_rows  = $stmt->execute($valoresReserva);

        $valoresAluga= array($morada,$codigo,$dataInicio,$nif, $numero);
        $sql = "INSERT INTO aluga(morada, codigo, data_inicio, nif, numero) values(?,?,?,?,?)";
        $stmt = $db->prepare($sql); 
        $affected_rows  = $stmt->execute($valoresAluga);

        $time_stamp = date("Y-m-d H:i:s");
        $valores = array($numero,$time_stamp,'Pendente');
        $sql = "INSERT INTO estado(numero, time_stamp, estado) values(?,?,?)";
        $stmt = $db->prepare($sql); 
        $affected_rows  = $stmt->execute($valores);

        $db->commit();

    }

    catch (PDOException $e)  {
      $db->rollBack();
      echo("<p>Nao e possivel criar reserva: {$e->getMessage()}</p>");
    }
}
?>
    </body>
</html>
