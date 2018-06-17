
<!DOCTYPE html>
<html lang="en">
  <head>

      <title>Bases de Dados - Grupo 45</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- CSS
          ================================================== --> 
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <link href="css/custom.min.css" rel="stylesheet">
 
        

        <script src="js/exterior/jquery.js"></script>

        <script src="js/exterior/bootstrap.min.js"></script>

	<script src="js/ancoras.js"></script> 




  </head>



  <body>


    <div class="navbar navbar-default navbar-fixed-top" >
          <div class="container">
        <div class="navbar-header">
              <!-- FIXME 
      ================================================== -->



          <a href="index.php" class="navbar-left"><img id = "logoIST" src="images/ist.png"></a>
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>

        <div class="navbar-collapse collapse" id="navbar-main">
          <ul class="nav navbar-nav">

            <li>
              <h2 class = "noHeader">Inês Sequeira, Pedro Gomes, Rafael Belchior</h2>
            </li>




          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li> <h2 class = "noHeader">Prof. Gabriel Pestana</h2></li>
            <li>        
                <form action = "php/logout.php" method = "post">
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

    

<div id = wrapper></div>
      <!-- Funcionalidades
      ================================================== -->
<div id = "app">
   
    <div class="container">

       
            <div class="page-header">

              
              <div class="page-header"></div>   

              <h2 class = "subTitulo">Funcionalidades</h2>

                    <ul>
                      <li id = "a"> <a> Inserir e Remover Edifícios, Espaços e Postos de trabalho </a></li>
                      <li id = "b"> <a> Criar e Remover Ofertas </a></li>
                      <li id = "c"> <a> Criar reservas sobre Ofertas</a> </li>
                      <li id = "d"> <a> Pagar reservas</a> </li>
                      <li id = "e"> <a> Para um dado edifício mostrar o total realizado para cada espaço</a></li> 
                  </ul>
               
           


        
      </div>
    </div>

<div id = wrapper></div>
<div class="container" id = "espacoTrabalhoA">

  <a>Inserir Edificio</a>
  <form class="form-inline" action="php/insereEdfEspPosto.php" method="post">
    <div class="form-group">

      <div class="input-group">
        <div class="input-group-addon">Inserir morada</div>
        <input id = "inserirMoradaEdificio" type="text" class="form-control"  name = "moradaEdf" placeholder="Insira morada do espaço">
     
      </div>
    </div>
    <button id="inserirMoradaEdificioBotao" type="submit" class="btn btn-primary">Inserir</button>
  </form>
   


<a>Inserir Espaço</a>
  <form class="form-inline" action="php/insereEdfEspPosto.php" method="post">
    <div class="form-group">
   
      <div class="input-group">
        <div class="input-group-addon" placeholder="Insira morada do espaço">Inserir Espaço</div>
        <input type="text" class="form-control" id="inserirMoradaEspaco" name = "moradaEsp" placeholder="Insira morada do espaço">
        <div class="input-group-addon">Código</div>
        <input type="text" class="form-control" id="inserirCodigoEspaco" name = "codigoEsp" placeholder="Insira código do espaço">
      </div>
    </div>
    <button id = "inserirMoradaEspacoBotao" class="btn btn-primary">Inserir</button>
  </form>


<a>Inserir Posto de trabalho</a>

  <form class="form-inline" action="php/insereEdfEspPosto.php" method="post">
    <div class="form-group">
   
      <div class="input-group">
        <div class="input-group-addon" placeholder="Insira morada do posto">Inserir Posto de trabalho</div>
        <input type="text" class="form-control" id="exampleInputAmount" name = "moradaPosto" placeholder="Insira morada do espaço">
        <div class="input-group-addon">Código do posto</div>
        <input type="text" class="form-control" id="exampleInputAmount" name = "codigoPosto" placeholder="Insira código do posto">
        <div class="input-group-addon">Código do Espaço</div>
        <input type="text" class="form-control" id="exampleInputAmount" name = "codigoEspPosto" placeholder="Insira código do espaço">
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Inserir</button>
  </form>





<div class="col-xs-12" style="height:50px;"></div>

<div class="container" id = "espacoTrabalhoA2"></div> <!--Imprmir tabela Edificios-->
<div class="container" id = "espacoTrabalhoA3"></div> <!--Imprmir tabela Espaços-->
<div class="page-header"></div>  

</div>

<div class="container" id = "espacoTrabalhoB">


        <a>Inserir Oferta</a>
    <form class="form-inline" action="php/insereOferta.php" method="post">
      <div class="form-group">

        <div class="input-group">
          <div class="input-group-addon" placeholder="Insira morada do posto">Morada</div>
          <input type="text" class="form-control" id="exampleInputAmount" name = "moradaEspOferta" placeholder="Insira morada do espaço">
          <div class="input-group-addon">Código</div>
          <input type="text" class="form-control" id="exampleInputAmount" name = "codigoEspOferta" placeholder="Insira código do espaço">
          <div class="input-group-addon">Tarifa</div>
          <input type="text" class="form-control" id="exampleInputAmount" name = "tarifaOferta" placeholder="Insira tarifa da oferta">
        </div>
        <div class="input-group">
          
          <div class="input-group-addon" placeholder="Insira morada do posto">Data de início</div>
          <input type="text" class="form-control" id="exampleInputAmount" name = "inicioOferta" placeholder="Insira data de início da oferta">
          <div class="input-group-addon" placeholder="Insira morada do posto">Data de Fim</div>
          <input type="text" class="form-control" id="exampleInputAmount" name = "fimOferta" placeholder="Insira data de fim da oferta">        
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Inserir</button>
    </form>


  <div class="col-xs-12" style="height:50px;"></div>

  <div class="container" id = "espacoTrabalhoB2"></div>
  <div class="page-header"></div>  
</div>

<div class="container" id = "espacoTrabalhoC">

        <a>Criar reserva sobre Oferta</a>

  <div class="col-xs-12" style="height:50px;"></div>

  <div class="container" id = "espacoTrabalhoC2"></div> 
  <div class="page-header"></div>  

</div>

<div class="container" id = "espacoTrabalhoD">

        <a>Pagar Reserva</a>


  <div class="col-xs-12" style="height:50px;"></div>

  <div class="container" id = "espacoTrabalhoD2"></div> 
  <div class="page-header"></div>  

</div>


  <div class="container" id = "espacoTrabalhoE">


        <a>Total realizado por edifício</a>
  




        <div class="col-xs-12" style="height:50px;"></div>

        <div class="container" id = "espacoTrabalhoE2"></div> 

        <div class="page-header"></div>  
  </div>

  </div>

</div>
</body>
</html>
