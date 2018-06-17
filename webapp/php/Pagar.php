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
        $metodo = "transacao";
        $data = date("Y-m-d H:i:s");
        Pagar($db,$metodo,$data,$_REQUEST["numero"]);
        $db = null;
        $url = "../app.php";
        header( "Location: $url" );   
	}

    catch (PDOException $e){
	   echo("<p>ERROR: {$e->getMessage()}</p>");
    }

function Pagar ($db,$metodo, $data, $numero)  {

        /*try catch com mensagem de erro*/
    try{ 
        $db->beginTransaction();

        $valores= array($numero,$data,$metodo);
        $sql = "INSERT INTO paga(numero, data, metodo) values(?,?,?)";
        $stmt = $db->prepare($sql); 
        $affected_rows  = $stmt->execute($valores);

        $valores= array($numero,$data,"Paga");
        $sql = "INSERT INTO estado(numero, time_stamp, estado) values(?,?,?)";
        $stmt = $db->prepare($sql); 
        $affected_rows  = $stmt->execute($valores);

        $db->commit();

    }

    catch (PDOException $e)  {
        $db->rollBack();
        echo("<p>Nao e possivel inserir o pagamento: {$e->getMessage()}</p>");
    }
}
?>
    </body>
</html>