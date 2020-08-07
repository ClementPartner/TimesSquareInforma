<?php

/*================================================
	Não esquecer que a 1ª tem que ser "active" !!!
--------------------------------------------------
	<div class="item active">
		<video class="video-fluid" autoplay loop muted style="width: 100%; height: auto;">
			<source src="../../__cliente/_videos/frans.mp4" type="video/mp4" />
		</video>
	</div>
------------------------------------------------*/

$myfile = fopen("grade-mostrar-carrossel.php", "w") or die("Impossível criar arquivo !!!");

for ($i = 0; $i < $_SESSION["gradeQtdeVideos"]; $i++) {

	$idVid = $i + 1;

	if ($i == 0) {
		$linha = "<div id='idVideo$idVid' class='item active'>";
	} else {
		$linha = "<div id='idVideo$idVid' class='item'>";
	}
	fwrite($myfile, $linha . "\n");

	$linha = "<video id='idV$idVid' class='video-fluid' loop style='width: 100%; height: auto;'>";
	fwrite($myfile, $linha . "\n");

	$vi = $_SESSION["gradeArrayDirVideos"][$i];

	$linha = "<source src='$vi' type='video/mp4' />";
	fwrite($myfile, $linha . "\n");

	$linha = "</video>";
	fwrite($myfile, $linha . "\n");

	$linha = "</div>";
	fwrite($myfile, $linha . "\n\n");
}

fclose($myfile);

?>
