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
      $nif = $_SESSION["nif"] ;

      if(isset($_REQUEST["moradaEdf"])) {
        $moradaEdf = $_REQUEST["moradaEdf"];
        insereEdificio($db,$moradaEdf);
      }

      if((isset($_REQUEST["moradaEsp"])) && (isset($_REQUEST["codigoEsp"]))) {

        $moradaEsp = $_REQUEST["moradaEsp"];
        $codigoEsp = $_REQUEST["codigoEsp"];
        insereEspaco($db,$moradaEsp,$codigoEsp,$nif);
      }    

      if((isset($_REQUEST["moradaPosto"])) && (isset($_REQUEST["codigoPosto"])) && (isset($_REQUEST["codigoEspPosto"]))) {

        $moradaPosto = $_REQUEST["moradaPosto"];
        $codigoPosto = $_REQUEST["codigoPosto"];
        $codigoEspPosto = $_REQUEST["codigoEspPosto"];
        inserePosto($db,$moradaPosto,$codigoPosto,$codigoEspPosto,$nif);
      } 

      $db = null;

      header( "Location: $url" );     

	}

      catch (PDOException $e)
      {
  echo("<p>Error: {e->getMessage()}</p>");
      }



  function insereEdificio ($db,$morada)  {

    try{

      $values = array($morada);
      $sql = "INSERT INTO edificio(morada) VALUES(?)";
      $stmt = $db->prepare($sql); 
      $affected_rows = $stmt->execute($values);

    }

    catch (Exception $e)  {
      echo("<p>Nao e possivel inserir o Edificio.</p>"); 
    }
  }


  function insereEspaco ($db,$morada,$codigo,$nif)  {

    try{

      $db->beginTransaction();
    
      $values = array($morada,$codigo, 'http://lorempixel.com/400/200/');
      $sql = "INSERT INTO alugavel(morada, codigo, foto) VALUES(?, ?, ?)";
      $stmt = $db->prepare($sql); 
      $affected_rows  = $stmt->execute($values);
    
      $values = array($morada,$codigo);
      $sql = "INSERT INTO espaco(morada, codigo) VALUES(?, ?)";
      $stmt = $db->prepare($sql); 
      $affected_rows  = $stmt->execute($values);

      $values = array($morada,$codigo,$nif);
      $sql = "INSERT INTO arrenda(morada,codigo,nif) VALUES (?, ?, ?)";
      $stmt = $db->prepare($sql); 
      $affected_rows  = $stmt->execute($values);


      $db->commit();
    }

    catch (PDOException $e)  {
      $db->rollBack();
      echo("<p>a inserir Espaco: {$e->getMessage()}</p>");
    }
        
  }

  function inserePosto($db,$morada,$codigo,$codigoEsp,$nif)  {

    try{
      $db->beginTransaction();

      $values = array($morada,$codigo, 'http://lorempixel.com/400/200/');
      $sql = "INSERT INTO alugavel(morada, codigo, foto) VALUES(?, ?, ?)";
      $stmt = $db->prepare($sql); 
      $affected_rows  = $stmt->execute($values);

      $values = array($morada,$codigo,$codigoEsp);
      $sql = "INSERT INTO posto(morada, codigo, codigo_espaco) VALUES(?, ?, ?)";
      $stmt = $db->prepare($sql); 
      $affected_rows  = $stmt->execute($values);

      $values = array($morada,$codigo,$nif);
      $sql = "INSERT INTO arrenda(morada, codigo,nif) VALUES (?, ?, ?)";
      $stmt = $db->prepare($sql); 
      $affected_rows  = $stmt->execute($values);


      $db->commit();
    }

    catch (PDOException $e)  {
      $db->rollBack();
      echo("<p>Erro a inserir posto: {$e->getMessage()}</p>");
    }
          
  }
?>
    </body>
</html>
