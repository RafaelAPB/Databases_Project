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
        printEspacos($db);
        printPostos($db);
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
            echo("</td><td>");
            $string = "<a href=\"php/removeEdfEspPosto.php?flag=edificio&morada=".$row['morada']."\">Remover</a>";
            echo($string);
            echo("</td></tr>\n");

        }
        echo("</table>\n");
    
        
}
 
function printEspacos($db)   {    

    
        $sql = "SELECT morada, codigo FROM espaco;";
    
        $result = $db->query($sql);
    
        echo("<table border=\"1\">\n");
        echo("<tr><td>Lista de Espaços</td><tr>");
        echo("<tr><td>Morada</td><td>Código</td></tr>\n");
        foreach($result as $row)
        {
            echo("<tr><td>");
            echo($row['morada']);
            echo("</td><td>");
            echo($row['codigo']);
            echo("<td><td>");
            $string = "<a href=\"php/removeEdfEspPosto.php?flag=espaco&morada=".$row['morada']."&codigoEsp=".$row['codigo']."\">Remover</a>";
            echo($string);
            echo("</td></tr>\n");
        }
        echo("</table>\n");
    
}
function printPostos($db) {

        $sql = "SELECT morada, codigo, codigo_espaco FROM posto;";
        
        $result = $db->query($sql);
    
        echo("<table border=\"1\">\n");
        echo("<tr><td>Lista de Postos</td></tr>\n");
        echo("<tr><td>Morada</td><td>Código</td><td>Código do Espaço</td></tr>\n");
        foreach($result as $row)
        {
            echo("<tr><td>");
            echo($row['morada']);
            echo("</td><td>");
            echo($row['codigo']);
            echo("</td><td>");
            echo($row['codigo_espaco']);
            echo("<td><td>");
            $string = "<a href=\"php/removeEdfEspPosto.php?flag=posto&morada=".$row['morada']."&codigo=".$row['codigo']."&codigoEsp=".$row['codigo_espaco']."\">Remover</a>";
            echo($string);
            echo("</td></tr>\n");
        }
        echo("</table>\n");
    
}

?>
    </body>
</html>
