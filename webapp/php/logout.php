<html>

    <body>
<?php
    try
    {   
        $url = "../index.php";
        session_destroy(); 
        header( "Location: $url" ); 

   
	}

     catch (PDOException $e)
     {
	echo("<p>ERROR: {$e->getMessage()}</p>");
        }



?>
    </body>
</html>
