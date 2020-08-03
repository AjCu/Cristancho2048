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
        <legend>FIN DE JUEGO</legend>
        <label>Jugador: </label> <input type="text" name="user" value="<?php echo"".$_SESSION["user"]; ?>"
        required="required">
        <p>Puntaje: <?php echo"".$_SESSION["puntaje"]; ?></p>
        <input type="submit"  name="Boton" value="Eliminar puntajes y volver al inicio">
        <input type="submit"  name="BotonReinicio" value="Guardar puntaje y volver a jugar con otro user">
      </fieldset>
      <table align="center"  class="table table-hover">
      <div><?php for ($i=0; $i < $_SESSION["Njugadores"] ; $i++) {  echo"  Jugador: ".$_SESSION["vectorpuntaje"][$i]."<br>";}  ?></div>
      </table>
      <?php
      if(isset($_POST["Boton"]))
      {
        header("location:cerrar.php");
      }
      if(isset($_POST["BotonReinicio"]))
      {
        header("location:iniciojuego.php");
        $_SESSION["vectorpuntaje"][ $_SESSION["Njugadores"]]=$_SESSION["user"]." puntaje: ".$_SESSION["puntaje"];
        $_SESSION["Njugadores"]=$_SESSION["Njugadores"]+1;
        unset($_SESSION["Mat"]);
        unset($_SESSION["Cont"]);
      }


       ?>
    </form>
  </body>
</html>
