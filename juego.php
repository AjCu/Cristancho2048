<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>2048</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/sketchy/bootstrap.min.css">
  </head>
  <body background="assets/shovelcorto.jpg">
  <form name="Form1" action="" method="POST">
    <fieldset>
        <legend>Juego</legend>
        <div> <label>Jugador: </label>  <?php echo " ".$_SESSION["user"]; ?>
        </div>
        <div> <label>Botones: </label>
        <input type="submit" name="up" value="arriba">
        <input type="submit" name="down" value="abajo">
        <input type="submit" name="right" value="derecha">
        <input type="submit" name="left" value="izquierda">
        </div>
        <div><label>Tambien puede usar las teclas direccionales...(recomendado)</label></div>
      <div><label>Puntacion: </label>  <?php echo " ".$_SESSION["puntaje"]; ?></div>
    </fieldset>
    </form>
    <?php
    if (!isset($_SESSION["Mat"])) { //Llenar matriz de ceros inicialmente, ademas de los valores iniciales
      for ($i=0; $i < $_SESSION["tmat"] ; $i++)
        for ($j=0; $j < $_SESSION["tmat"] ; $j++) {
            $mat[$i][$j]=0;
            $cont[$i][$j]=0;
        }

          for ($i=0; $i <2 ; $i++) { //Se llenan con valores entre 2 y 4 en posiciones aleatorias
                srand((double) microtime()*1000000);
                $irand=rand(0, $_SESSION["tmat"]-1);
                $jrand=rand(0, $_SESSION["tmat"]-1);
                $seleccion24=rand(0,5);
                if($mat[$irand][$jrand]==0)
                {
                  if($seleccion24>=2)
                  {
                    $mat[$irand][$jrand]=2;
                    $cont[$irand][$jrand]=2;
                  }
                  else{
                    $mat[$irand][$jrand]=4;
                    $cont[$irand][$jrand]=4;
                  }
                
                }
                else {
                  $i--;
                }
              }
        $_SESSION["Mat"]=$mat;
        $_SESSION["Cont"]=$cont;
      }
      else {
        $mat=$_SESSION["Mat"];
        $cont=$_SESSION["Cont"];
      }

     ?>
      <?php

      if(isset($_POST["up"]) || isset($_POST["down"]) || isset($_POST["left"]) || isset($_POST["right"]) || isset($_GET["dir"]) )
      {
      function isllena()
      {
        $band=0;
        for ($i=0; $i <$_SESSION["tmat"] ; $i++) {
          for ($j=0; $j <$_SESSION["tmat"] ; $j++) {
            if($_SESSION["Cont"][$i][$j]==0)
            {
              $band=1;
            }
          }
        }
        return $band;
      }
      function generarrand() //genera aleatorio entre 2 y 4 por cada movimiento
      {
        $band=0;
        while($band==0)
        {
          srand((double) microtime()*1000000);
          $irand=rand(0, $_SESSION["tmat"]-1);
          $jrand=rand(0, $_SESSION["tmat"]-1);
          $seleccion24=rand(0,5);
          if($_SESSION["Cont"][$irand][$jrand]==0)
          {
            if($seleccion24>=2)
                  {
                    $_SESSION["Mat"][$irand][$jrand]=2;
                    $_SESSION["Cont"][$irand][$jrand]=2;
                  }
                  else{
                    $_SESSION["Mat"][$irand][$jrand]=4;
                    $_SESSION["Cont"][$irand][$jrand]=4;
                  }
            echo"Insertó nuevo en F: ".$irand." y C: ".$jrand."
            <br>";
            $band=1;
          }
          $comprobante=isllena();
          if($comprobante==0 || $_SESSION["puntaje"]==2048)
          {
            $band=1;
            header("location:findejuego.php");
          }
        }
      }
      }
     

      if(isset($_POST["up"]) ||((isset($_GET["dir"])&&$_GET["dir"]==38))) //Funcionamiento hacia arriba
      {
        function sumarup(){//Funcion que suma adyacentes hacia arriba
          for ($i=0; $i <$_SESSION["tmat"] ; $i++) {
            for ($j=0; $j <$_SESSION["tmat"] ; $j++) {
             if((isset($_SESSION["Cont"][$i-1][$j]))&&($_SESSION["Cont"][$i-1][$j]==$_SESSION["Cont"][$i][$j]))
             {
                $_SESSION["puntaje"]=$_SESSION["Cont"][$i][$j]+$_SESSION["Cont"][$i][$j]+$_SESSION["puntaje"];
                $_SESSION["Cont"][$i-1][$j]=$_SESSION["Cont"][$i][$j]+$_SESSION["Cont"][$i][$j];
                $_SESSION["Cont"][$i][$j]=0;
                $_SESSION["Mat"][$i-1][$j]=$_SESSION["Mat"][$i][$j]+$_SESSION["Mat"][$i][$j];
                $_SESSION["Mat"][$i][$j]=0;
             }
            }
          }
        }

        function subir($fila,$columna){//Movimiento hacia arriba
          for ($i=$fila; $i <$_SESSION["tmat"] ; $i++) {
                  for ($j=$columna; $j <$_SESSION["tmat"] ; $j++) {
                    $x=$fila;
                   while(($x>0) && (isset($_SESSION["Cont"][$x-1][$j]))&&($_SESSION["Cont"][$x-1][$j]==0))
                   {
                    
                      $_SESSION["Cont"][$x-1][$j]=$_SESSION["Cont"][$x][$j];
                      $_SESSION["Cont"][$x][$j]=0;
                      $_SESSION["Mat"][$x-1][$j]=$_SESSION["Mat"][$x][$j];
                      $_SESSION["Mat"][$x][$j]=0;
                      $x=$x-1;
                   }
                  }
                }
                sumarup();       
        }
        for ($i=0; $i <$_SESSION["tmat"] ; $i++) {
            for ($j=0; $j <$_SESSION["tmat"] ; $j++) {
            if($_SESSION["Cont"][$i][$j]!=0)
            {
              subir($i,$j); 
            }
          }
        }
        generarrand();
      }
     
      if(isset($_POST["down"]) ||((isset($_GET["dir"])&&$_GET["dir"]==40))) //Funcionamiento hacia arriba
      {
        function sumardown(){//Funcion que suma adyacentes hacia abajo
          for ($i=0; $i <$_SESSION["tmat"] ; $i++) {
            for ($j=0; $j <$_SESSION["tmat"] ; $j++) {
             if((isset($_SESSION["Cont"][$i+1][$j]))&&($_SESSION["Cont"][$i+1][$j]==$_SESSION["Cont"][$i][$j]))
             {
                $_SESSION["puntaje"]= $_SESSION["puntaje"]+$_SESSION["Cont"][$i][$j]+$_SESSION["Cont"][$i][$j];
                $_SESSION["Cont"][$i+1][$j]=$_SESSION["Cont"][$i][$j]+$_SESSION["Cont"][$i][$j];
                $_SESSION["Cont"][$i][$j]=0;
                $_SESSION["Mat"][$i+1][$j]=$_SESSION["Mat"][$i][$j]+$_SESSION["Mat"][$i][$j];
                $_SESSION["Mat"][$i][$j]=0;
             }
            }
          }
        }

        function bajar($fila,$columna){//Movimiento hacia abajo
          for ($i=$fila; $i <$_SESSION["tmat"] ; $i++) {
                  for ($j=$columna; $j <$_SESSION["tmat"] ; $j++) {
                   $x=$fila;
                   while((isset($_SESSION["Cont"][$x+1][$j]))&&($_SESSION["Cont"][$x+1][$j]==0))
                   {
                      $_SESSION["Cont"][$x+1][$j]=$_SESSION["Cont"][$x][$j];
                      $_SESSION["Cont"][$x][$j]=0;
                      $_SESSION["Mat"][$x+1][$j]=$_SESSION["Mat"][$x][$j];
                      $_SESSION["Mat"][$x][$j]=0;
                       $x=$x+1;
                    
                   }
                  }
                }
                sumardown();
        }
        for ($i=0; $i <$_SESSION["tmat"] ; $i++) {
            for ($j=0; $j <$_SESSION["tmat"] ; $j++) {
            if($_SESSION["Cont"][$i][$j]!=0)
            {
              bajar($i,$j);  
            }
          }
        }
        generarrand();
      }
      if(isset($_POST["right"])||((isset($_GET["dir"])&&$_GET["dir"]==39))) //Funcionamiento hacia derecha
      {
        function sumaright(){//Funcion que suma adyacentes hacia derecha
          for ($i=0; $i <$_SESSION["tmat"] ; $i++) {
            for ($j=0; $j <$_SESSION["tmat"] ; $j++) {
             if((isset($_SESSION["Cont"][$i][$j+1]))&&($_SESSION["Cont"][$i][$j+1]==$_SESSION["Cont"][$i][$j]))
             {
                $_SESSION["puntaje"]=$_SESSION["Cont"][$i][$j]+$_SESSION["Cont"][$i][$j]+$_SESSION["puntaje"];
                $_SESSION["Cont"][$i][$j+1]=$_SESSION["Cont"][$i][$j]+$_SESSION["Cont"][$i][$j];
                $_SESSION["Cont"][$i][$j]=0;
                $_SESSION["Mat"][$i][$j+1]=$_SESSION["Mat"][$i][$j]+$_SESSION["Mat"][$i][$j];
                $_SESSION["Mat"][$i][$j]=0;
             }
            }
          }
        }

        function derecha($fila,$columna){//Movimiento hacia derecha
          for ($i=$fila; $i <$_SESSION["tmat"] ; $i++) {
                  for ($j=$columna; $j <$_SESSION["tmat"] ; $j++) {
                    $x=$columna;
                   while(($x<4) && (isset($_SESSION["Cont"][$i][$x+1]))&&($_SESSION["Cont"][$i][$x+1]==0))
                   {
                    
                      $_SESSION["Cont"][$i][$x+1]=$_SESSION["Cont"][$i][$x];
                      $_SESSION["Cont"][$i][$x]=0;
                      $_SESSION["Mat"][$i][$x+1]=$_SESSION["Mat"][$i][$x];
                      $_SESSION["Mat"][$i][$x]=0;
                      $x=$x+1;
                   }
                  }
                }
                sumaright();
        }
        for ($i=0; $i <$_SESSION["tmat"] ; $i++) {
            for ($j=0; $j <$_SESSION["tmat"] ; $j++) {
            if($_SESSION["Cont"][$i][$j]!=0)
            {
              derecha($i,$j); 
            }
          }
        }
        generarrand();
      }
      if(isset($_POST["left"]) ||((isset($_GET["dir"])&&$_GET["dir"]==37))) //Funcionamiento hacia izquierda
      {
        function sumaleft(){//Funcion que suma adyacentes hacia izquierda
          for ($i=0; $i <$_SESSION["tmat"] ; $i++) {
            for ($j=0; $j <$_SESSION["tmat"] ; $j++) {
             if((isset($_SESSION["Cont"][$i][$j-1]))&&($_SESSION["Cont"][$i][$j-1]==$_SESSION["Cont"][$i][$j]))
             {
                $_SESSION["puntaje"]=$_SESSION["Cont"][$i][$j]+$_SESSION["Cont"][$i][$j]+$_SESSION["puntaje"];
                $_SESSION["Cont"][$i][$j-1]=$_SESSION["Cont"][$i][$j]+$_SESSION["Cont"][$i][$j];
                $_SESSION["Cont"][$i][$j]=0;
                $_SESSION["Mat"][$i][$j-1]=$_SESSION["Mat"][$i][$j]+$_SESSION["Mat"][$i][$j];
                $_SESSION["Mat"][$i][$j]=0;
             }
            }
          }
        }

        function izquierda($fila,$columna){//Movimiento hacia izquierda
          for ($i=$fila; $i <$_SESSION["tmat"] ; $i++) {
                  for ($j=$columna; $j <$_SESSION["tmat"] ; $j++) {
                    $x=$columna;
                   while(($x>0) && (isset($_SESSION["Cont"][$i][$x-1]))&&($_SESSION["Cont"][$i][$x-1]==0))
                   {
                    
                      $_SESSION["Cont"][$i][$x-1]=$_SESSION["Cont"][$i][$x];
                      $_SESSION["Cont"][$i][$x]=0;
                      $_SESSION["Mat"][$i][$x-1]=$_SESSION["Mat"][$i][$x];
                      $_SESSION["Mat"][$i][$x]=0;
                      $x=$x-1;
                   }
                  }
                }
                sumaleft();
        }
        for ($i=0; $i <$_SESSION["tmat"] ; $i++) {
            for ($j=0; $j <$_SESSION["tmat"] ; $j++) {
            if($_SESSION["Cont"][$i][$j]!=0)
            {
              izquierda($i,$j); 
            }
          }
        }
        generarrand();
      }
      ?>
     
      <table  align="center">
        <?php
        for ($i=0; $i <$_SESSION["tmat"] ; $i++) {
          echo "<tr>";
          for ($j=0; $j <$_SESSION["tmat"] ; $j++) {
            echo "<td><a><img src='assets/",$_SESSION["Cont"][$i][$j],".jpg'/>"."</a></td>";
            }
          echo "</tr>";
        }
         ?>
      </table>
      <p align="center"><a href="cerrar.php"><strong>Salir</strong></p>
  </body>

  <script type="text/javascript"> 
  window.onload = function()
  {
    document.onkeyup = usarteclado;
    document.table.submit();
  }
  function usarteclado(e)
  {
    var key = e.keyCode;
    if(key==37)
    {
      document.location="juego.php?dir="+37;
    }
    else if(key==38)
    {
      document.location="juego.php?dir="+38;
    }
    else  if(key==39)
    {
      document.location="juego.php?dir="+39;
    }
    else  if(key==40)
    {
      document.location="juego.php?dir="+40;
    }
    else{
      alert('Esa tecla no genera un movimieto');
    }
  }
  </script>
</html>
