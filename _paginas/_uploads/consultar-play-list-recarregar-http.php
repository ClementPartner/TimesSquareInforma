<?php
session_start();

$_SESSION["horaConsultar"] = $_REQUEST["hora"];

echo $_SESSION["horaConsultar"];
?>
