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


      $flag = $_REQUEST["flag"];
      $url = "../app.php";


      switch ($flag) {
        case "edificio":
          removeEdificio($db,$_REQUEST["morada"]);
          break;
        case "espaco":
          removeEspaco($db,$_REQUEST["morada"],$_REQUEST["codigoEsp"]);
          break;
        case "posto":
          removePosto($db,$_REQUEST["morada"],$_REQUEST["codigo"],$_REQUEST["codigoEsp"]);
      }

      $db = null;

      header( "Location: $url" );    

  }

      catch (PDOException $e)
      {
  echo("<p>Error: {e->getMessage()}</p>");
      }



  function removeEdificio ($db,$morada)  {

    try{

      $values = array($morada);
      $sql = "DELETE FROM edificio WHERE morada = ?";
      $stmt = $db->prepare($sql); 
      $affected_rows = $stmt->execute($values);

    }

    catch (Exception $e)  {
        echo("<p>Erro a remover edificio: {$e->getMessage()}</p>");
    }
  }


  function removeEspaco ($db,$morada,$codigo)  {

        /*try catch com mensagem de erro*/
    try{
      $db->beginTransaction();  
      $values = array($morada,$codigo);
      $sql = "DELETE FROM arrenda WHERE morada = ? AND codigo = ?";
      $stmt = $db->prepare($sql); 
      $affected_rows  = $stmt->execute($values);

      $values = array($morada,$codigo);
      $sql = "DELETE FROM espaco WHERE morada = ? AND codigo = ?";
      $stmt = $db->prepare($sql); 
      $affected_rows  = $stmt->execute($values);

      $valuesAlugavel = array($morada,$codigo);
      $sql = "DELETE FROM alugavel WHERE morada = ? AND codigo = ?";
      $stmt = $db->prepare($sql); 
      $affected_rows  = $stmt->execute($valuesAlugavel);
      $db->commit();

    }

    catch (Exception $e)  {
      $db->rollBack();
      echo("<p>Nao e possivel remover o Espaco.</p>");
    }
        
  }

  function removePosto($db,$morada,$codigo,$codigoEsp)  {

    try{ 
        $db->beginTransaction();  
        $values = array($morada,$codigo);
        $sql = "DELETE FROM arrenda WHERE morada = ? AND codigo = ?";
        $stmt = $db->prepare($sql); 
        $affected_rows  = $stmt->execute($values);

        $valuesPosto = array($morada,$codigo,$codigoEsp);
        $sql = "DELETE FROM posto WHERE morada = ? AND codigo = ? AND codigo_espaco = ?";
        $stmt = $db->prepare($sql); 
        $affected_rows  = $stmt->execute($valuesPosto);

        $valuesAlugavel = array($morada,$codigo);
        $sql = "DELETE FROM alugavel WHERE morada = ? AND codigo = ?";
        $stmt = $db->prepare($sql); 
        $affected_rows  = $stmt->execute($valuesAlugavel);
        $db->commit();

    }

    catch (PDOException $e)  {
      $db->rollBack();
      echo("<p>Erro a remover posto: {$e->getMessage()}</p>");
    }
    
        
  }
?>
    </body>
</html>
