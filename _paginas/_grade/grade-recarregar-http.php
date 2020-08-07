<?php
session_start();

require_once "grade-carregar-da-tabela.php";

echo $_SESSION["gradeQtdeVideos"]  . ";" .
	 $_SESSION["gradeDataCriacao"] . ";" .
	 $_SESSION["gradeHoraFinal"]   . ";" .
	 $_SESSION["gradeImplodeSohVideos"];
?>
