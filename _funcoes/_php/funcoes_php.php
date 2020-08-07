<?php
	/*======================================================
	Blindar contra SQL Injection.
            
	validar_entrada($data)
		está na nossa ../../_funcoes/_php/funcoes_php.php.
	======================================================*/

	function validar_nome($nome) {
		$nome = validar_entrada($nome);
		if (!preg_match("/^[a-zA-Z ]*$/", $nome)) {
			return false;
		} else {
			return true;
		}
	}

	function validar_website($website) {
		$website = validar_entrada($website);
		if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",		$website)) {
			return false;
		} else {
			return true;
		}
	}

	// Blindar contra SQL Injection.
	function validar_entrada($data) {
		$data = htmlspecialchars(strip_tags(stripslashes(trim($data))));
		return $data;
	}
	
	function gerar_senha_aleatoria() {
		//					   1		 2		   3		 4		   5
		// 	  		  ----5----0----5----0----5----0----5----0----5----0----5-
		$palavra   = "AaBbCcDdEeFfGgHhiJjKkLMmNnPpQqRrSsTtUuVvYyXxWwZz23456789";
		$novaSenha = "";
		for($i = 1; $i <= 8; $i++){ 
			$novaSenha .= substr($palavra, mt_rand(1, 56) - 1, 1);
		}
		return $novaSenha;
	}
	
	function encrypt_senha($senha) {
		return password_hash($senha, PASSWORD_DEFAULT);
	}
?>
