<html>
    <body>
<?php
    //Done
    try
    {
    	$host = "db.ist.utl.pt";
        $user ="ist181719";
        $password = "grupo45";
        $dbname = $user;
        
        $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        printOfertas($db);
        $db = null;
	}

     catch (PDOException $e)
     {
	echo("<p>ERROR: {$e->getMessage()}</p>");
        }

    function printOfertas($db) {

        $sql = "SELECT morada, codigo, data_inicio, data_fim, tarifa FROM oferta;";
        
        $result = $db->query($sql);
    
        echo("<table border=\"1\">\n");
        echo("<tr><td>Lista de Ofertas</td></tr>\n");
        echo("<tr><td>Morada</td><td>Código</td><td>Data de Inicio</td><td>Data de Fim</td><td>Tarifa</td></tr>\n");
        foreach($result as $row)
        {
            echo("<tr><td>");
            echo($row['morada']);
            echo("</td><td>");
            echo($row['codigo']);
            echo("</td><td>");
            echo($row['data_inicio']);
            echo("</td><td>");
            echo($row['data_fim']);
            echo("</td><td>");
            echo($row['tarifa']);
            echo("</td><td>");
            $string = "<a href=\"php/removeOferta.php?morada=".$row['morada']."&codigo=".$row['codigo']."&dataInicio=".$row['data_inicio']."&dataFim=".$row['data_fim']."&tarifa=".$row['tarifa']."\">Remover</a>";
            echo ($string);
            echo("</td></tr>\n");
        }
        echo("</table>\n");
    
    }

?>
    </body>
</html>
