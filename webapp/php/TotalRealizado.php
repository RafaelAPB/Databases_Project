<html>
<head>
        <link href="../css/bootstrap.min.css" rel="stylesheet">

        <link href="../css/custom.min.css" rel="stylesheet">
</head>
<body>
<div class="navbar navbar-default navbar-fixed-top" >
          <div class="container">
        <div class="navbar-header">
              <!-- FIXME 
      ================================================== -->



          <a href="../index.php" class="navbar-left"><img id = "logoIST" src="../images/ist.png"></a>
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>

        <div class="navbar-collapse collapse" id="navbar-main">
          <ul class="nav navbar-nav">

            <li>
              <h2 class = "noHeader">Ines Sequeira, Pedro Gomes, Rafael Belchior</h2>
            </li>




          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li> <h2 class = "noHeader">Prof. Gabriel Pestana</h2></li>
            <li>        
                <form action = "../php/logout.php" method = "post">
                  <button id="logoutButton" type="submit" class="btn btn-danger" >Logout</button> 

              </form>


            </li>
            <li>                <?php 
                  session_start();

                  $nifSessao = $_SESSION['nif'];


                  $divParte1 = "<div id =\"nifValor\" class=\"bg-primary\">Bem-Vindo ";
                  $divParte2 = ", ";
                  $divParte3 = "</div>";


                  $divNomeFinal = $divParte1.$nomeSessao.$divParte2.$nifSessao.$divParte3;
                  echo($divNomeFinal);
                ?>
                  
            </li>
          </ul>
        </div>
    <!-- Fechou CONTAINER
      ================================================== -->  
      </div>
    <!-- Fechou nav bar(header)
      ================================================== -->  
    </div>
    <div class="col-xs-12" style="height:50px;"></div><div class="col-xs-12" style="height:50px;"></div><div id ="wrapper"></div>
<?php
    try
    {
    	$host = "db.ist.utl.pt";
        $user ="ist181719";
        $password = "grupo45";
        $dbname = $user;
        
        $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        TotalRealizado($db,$_REQUEST["morada"]);

        $db = null;
  
	}

    catch (PDOException $e){
	   echo("<p>ERROR: {$e->getMessage()}</p>");
    }

function TotalRealizado ($db,$morada)  {

    try{
        $valores=array($morada);
        $sql = "SELECT res.morada, res.codigo, SUM(res.TotalEspaco) AS Total
                FROM
                    (SELECT e.morada, e.codigo, SUM(oe.tarifa * datediff(oe.data_fim, oe.data_inicio)) AS TotalEspaco
                    FROM espaco e NATURAL JOIN oferta oe
                        NATURAL JOIN aluga ae
                        NATURAL JOIN paga pge
                    GROUP BY  e.morada, e.codigo
                    UNION
                    SELECT p.morada, p.codigo_espaco, SUM(o.tarifa * datediff(o.data_fim, o.data_inicio)) AS TotalPosto
                    FROM posto p NATURAL JOIN oferta o
                        NATURAL JOIN aluga a
                        NATURAL JOIN paga pg
                    GROUP BY  p.morada, p.codigo_espaco
                    UNION
                    SELECT ez.morada, ez.codigo AS codigo_espaco, 0
                    FROM espaco ez
                    WHERE (ez.morada, ez.codigo) NOT IN(
                        SELECT az.morada, az.codigo
                        FROM aluga az NATURAL JOIN paga pgz)
                    ) res
                WHERE res.morada =?
                GROUP BY  res.morada, res.codigo";

        $stmt = $db->prepare($sql);
        $affected_rows  = $stmt->execute($valores);
        $result = $stmt -> fetchAll(PDO::FETCH_ASSOC);
        
        echo("<table border=\"1\">\n");
        echo("<tr><td>Lista de Total Realizado por Espaco</td></tr>\n");
        echo("<tr><td>Morada</td><td>Codigo do Espaco</td><td>Total Realizado</td></tr>\n");
        foreach($result as $row)
        {
            echo("<tr><td>");
            echo($row['morada']);
            echo("</td><td>");
            echo($row['codigo']);
            echo("</td><td>");
            echo($row['Total']);
            echo("</td></tr>\n");
        }
        echo("</table>\n");
        
    }

    catch (PDOException $e)  {
      echo("<p>Nao e possivel mostrar total realizado.</p>"); 
    }
}
?>
    

    <form action = "../app.php">
        <button id="logoutButton"  class="btn btn-sucess" >Voltar</button> 

    </form><div id ="wrapper"></div>
</body>
</html>