<?php session_start();

  unset($_SESSION["user"]);
  unset($_SESSION["puntaje"]);
  unset($_SESSION["tmat"]);
  unset($_SESSION["Mat"]);
  unset($_SESSION["Cont"]);
  unset($_SESSION["vectorpuntaje"]);
  unset($_SESSION["Njugadores"]);

header("location:iniciojuego.php");
die();
?>
