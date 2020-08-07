<?php
session_start();

$target_dir = "../../__cliente/_videos/";

//-----------------------------------
//$d = dir(getcwd());

//echo "Handle: " . $d->handle . "<br>";
//echo "Path: " . $d->path . "<br>";

//while (($file = $d->read()) !== false){
//  echo "filename: " . $file . "<br>";
//}

//$d->close();
//echo "*************<br>";
//-----------------------------------

$target_file = $target_dir . basename($_FILES["ArqUpload"]["name"]);

$uploadOk = 1;

$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {

	$check = getimagesize($_FILES["ArqUpload"]["tmp_name"]);

    if($check !== false) {
        $uploadOk = 1;
    } else {
		$mensagem = "Arquivo não é uma imagem.   ";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
	$mensagem = "Arquivo já existe !!!   ";
    $uploadOk = 0;
}

/* Check file size
if ($_FILES["ArqUpload"]["size"] > 500000) {
    echo "Arquivo é muito grande !!!";
    $uploadOk = 0;
}
-----------------------------*/

/* Allow certain file formats
if ($imageFileType != "jpg"  &&
		$imageFileType != "png"  && 
		$imageFileType != "jpeg" && 
		$imageFileType != "gif"  &&
		$imageFileType != "pdf" ) {
	echo "Somente arquivos JPG, JPEG, PNG, GIF e PDF !!!";
	$uploadOk = 0;
}
------------------------------*/

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
	$mensagem .= "Arquivo não carregado !!!";
} else {
    if (move_uploaded_file($_FILES["ArqUpload"]["tmp_name"], $target_file)) {
        $mensagem = basename( $_FILES["ArqUpload"]["name"]). " carregado !!!";
    } else {
		$mensagem .= "Problema na carga do arquivo !!!";
    }
}

$_SESSION['mensagem'] = $mensagem;
header("location:upload.php");

?>
