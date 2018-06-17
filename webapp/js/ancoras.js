$(document).ready(function(){


  $("#a").click(function(){


    $("#espacoTrabalhoA").toggle();

    $("#espacoTrabalhoA2").load('php/mostraEdfEspPosto.php');


  });

  $("#b").click(function(){


    $("#espacoTrabalhoB").toggle();

    $("#espacoTrabalhoB2").load('php/mostraOferta.php');


  });


  $("#c").click(function(){


    $("#espacoTrabalhoC").toggle();

    $("#espacoTrabalhoC2").load('php/mostraReservaOferta.php');


  });

   $("#d").click(function(){


    $("#espacoTrabalhoD").toggle();

    $("#espacoTrabalhoD2").load('php/mostraReservaPagar.php');


  }); 

    $("#e").click(function(){


    $("#espacoTrabalhoE").toggle();
    $("#espacoTrabalhoE2").load('php/mostraEdificios.php');



  }); 

});