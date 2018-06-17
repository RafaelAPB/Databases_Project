
<!DOCTYPE html>
<html lang="en">
  <head>

      <title>Login - Grupo 45</title>

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
          </ul>
        </div>
    <!-- Fechou CONTAINER
      ================================================== -->  
      </div>
    <!-- Fechou nav bar(header)
      ================================================== -->  
    </div>


    <div class="login-page">
      <div class="form">
        <form  class="login-form" action = "php/login.php" method = "post">
  
          <input id = "valorNIF" type="text" name="nif" placeholder="NIF"/>

          <button id="loginButton" type="submit">Login</button>
        </form>
      </div>


    </div>
      

    



<div id = wrapper></div>
  </head>
 </html>
