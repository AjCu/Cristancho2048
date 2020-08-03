<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>2048 Cris</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/sketchy/bootstrap.min.css">
  </head>
  <body background="assets/shovelcorto.jpg">  
    <form name="Form1" action="" method="post">
      <fieldset>
        <legend>Inicio de sesion</legend>
        <label>Ingrese su nombre: </label> <input type="text" name="user" value=""
        required="required">
        <input type="submit" name="Boton" value="Ingresar">
      </fieldset>
      <?php
      if(isset($_POST["Boton"]))
      {
        $_SESSION["user"]=$_POST["user"];
        $_SESSION["tmat"]=4;
        $_SESSION["puntaje"]=0;//PUEDE CAMBIAR EL PUNTAJE A 2000 AQUI Y HACER DOS 2-2 PARA COMPROBAR QUE GANA SI 2048, DE LO CONTRARIO SEGUIRA HASTA QUE SE LLENE LA MATRIZ
        header("location:juego.php");
      }
      if(!isset($_SESSION["vectorpuntaje"]))
      {
        if(!isset($_session["Njugadores"]))
        {
          $_SESSION["Njugadores"]=1;
        }
       
        for ($i=0; $i <10 ; $i++) { 
         $vaux[$i]="Vacio 000";
        }
        $_SESSION["vectorpuntaje"]=$vaux;
      }


       ?>
    </form>
  </body>
</html>
