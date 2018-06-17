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
        printEdificios($db);
        $db = null;
	}

     catch (PDOException $e)
     {
	echo("<p>ERROR: {$e->getMessage()}</p>");
        }

    function printEdificios ($db)   {

        
    
        $sql = "SELECT morada FROM edificio;";
        
        $result = $db->query($sql);
    
        echo("<table border=\"1\">\n");
        echo("<tr><td>Lista de Edifícios</td></tr>\n");
        echo("<tr><td>Morada</td></tr>\n");
        foreach($result as $row)
        {
            echo("<tr><td>");
            echo($row['morada']);
            echo("<td><td>");
            $string = "<a href=\"php/TotalRealizado.php?morada=".$row['morada']."\">Total Realizado Por Espaço</a>";
            echo($string);
            echo("</td></tr>\n");

        }
        echo("</table>\n");
    
        
    }
 

?>
    </body>
</html>
