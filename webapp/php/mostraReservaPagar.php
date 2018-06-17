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
        printReservas($db);
        $db = null;
	}

     catch (PDOException $e)
     {
	echo("<p>ERROR: {$e->getMessage()}</p>");
        }

    function printReservas($db) {

        $sql = "SELECT r1.numero 
                FROM reserva r1 NATURAL JOIN estado e1
                WHERE e1.estado = 'Aceite'
                    AND NOT EXISTS(
                        SELECT *
                        FROM reserva r2 NATURAL JOIN estado e2
                        WHERE r2.numero = r1.numero
                            AND e2.estado = 'Paga');";
        
        $result = $db->query($sql);
    
        echo("<table border=\"1\">\n");
        echo("<tr><td>Lista de Reservas aceites e não pagas</td></tr>\n");
        echo("<tr><td>Numero</td></tr>\n");
        foreach($result as $row)
        {
            echo("<tr><td>");
            echo($row['numero']);
            echo("</td><td>");
            echo("<td><td>");
            $string = "<a href=\"php/Pagar.php?&numero=".$row['numero']."\">Pagar</a>";
            echo($string);
            echo("</td></tr>\n");
        }
        echo("</table>\n");
    
    }

?>
    </body>
</html>
