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

        $nif = $_REQUEST["nif"];
  

        $url = "../app.php";
         $url2 = "../index.php"; 

        if (isset($nif))    {

            $result = checkNIF($db,$nif);

            if ($result) {
                session_start();
                $_SESSION["nif"] = $nif;
 
                header( "Location: $url" );
            }
        }
        if (!($result))  {
          header( "Location: $url2" );   
        }
         

        $db = null;
	}

     catch (PDOException $e)
     {
	echo("<p>ERROR: {$e->getMessage()}</p>");
        }


 function checkNIF($db, $nif)   {

    try{

      $values = array($nif);
      $sql = "SELECT nif FROM user u WHERE u.nif = ?";

      $stmt = $db->prepare($sql); 
      $affected_rows = $stmt->execute($values);
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

      if (empty($result)) {
        return false;
      }
             
      return true;
    }               


    catch (Exception $e)  {
      echo("<p>Nao e possivel inserir o Edificio.</p>"); 
    }


}




?>
    </body>
</html>
