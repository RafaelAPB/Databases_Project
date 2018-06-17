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
        printOfertas($db); 
        printReservas($db);
        $db = null;
	}

     catch (PDOException $e)
     {
	echo("<p>ERROR: {$e->getMessage()}</p>");
        }

    function printReservas($db) {

        $sql = "SELECT a.morada, a.codigo, a.data_inicio, a.nif, a.numero FROM aluga a ORDER BY a.numero;";
        
        $result = $db->query($sql);
    
        echo("<table border=\"1\">\n");
        echo("<tr><td>Lista de Ofertas com Reserva não aceite</td></tr>\n");
        echo("<td>Numero</td>\n");
        echo("<td>NIF</td>\n");
        echo("<td>Morada</td>\n");
        echo("<td>Código</td>\n");
        echo("<td>Data de início</td></tr>\n");
        foreach($result as $row)
        {
            echo("<tr><td>");
            echo($row['numero']);
            echo("</td><td>");
            echo($row['nif']);
            echo("</td><td>");
            echo($row['morada']);
            echo("</td><td>");
            echo($row['codigo']);
            echo("</td><td>");
            echo($row['data_inicio']);
            echo("</td></tr>\n");
        }
        echo("</table>\n");
    
    }

    function printOfertas($db) {

        $sql = "SELECT o.morada, o.codigo, o.data_inicio, o.data_fim, o.tarifa 
                FROM oferta o
                WHERE NOT EXISTS(
                    SELECT o2.morada, o2.codigo, o2.data_inicio, o2.data_fim, o2.tarifa 
                    FROM oferta o2 NATURAL JOIN aluga a 
                        NATURAL JOIN estado e 
                    WHERE o2.morada = o.morada 
                        AND o2.codigo = o.codigo 
                        AND o2.data_inicio = o.data_inicio
                        AND e.estado = 'Aceite');";
        
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
            $string = "<a href=\"php/inserirReserva.php?morada=".$row['morada']."&codigo=".$row['codigo']."&dataInicio=".$row['data_inicio']."\">Reservar</a>";
            echo($string);
            echo("</td></tr>\n");
        }
        echo("</table>\n");
    
    }

?>
    </body>
</html>
