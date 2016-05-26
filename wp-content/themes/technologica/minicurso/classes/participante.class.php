<?php 

class Participante {


public static function registraParticipante($nome, $email, $aluno = 0, $doc, $fone) {
	
	if(empty($nome)) {
		print('Nome não especificado');
		return (0);
	}

	if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		print('E-mail inválido');
		return (0);
	}

	if(empty($doc)) {
		print('Documento não especificado');
		return (0);
	}

	if(empty($fone)) {
		print('Telefone não especificado');
		return (0);
	}


	if(!self::participanteJaRegistrado($doc)) {
		//Registra o participante 
		$db = new db();
		$insert = $db->conexao->query("INSERT INTO participante
				  VALUES ('$doc', '$nome', '$email', '$aluno', '$fone')");

		return ($insert) ? $doc : 0; 
	}
	return $doc;
}

/*
 * Checa se o participante já está registrado
 */
private static function participanteJaRegistrado($participante_doc) {
	$db = new db();
	$select = $db->conexao->query("SELECT * FROM participante 
								   WHERE participante_doc = '$participante_doc'");
	return (mysqli_num_rows($select) > 0) ? 1 : 0;
}

/*
 * Verifica a disponibilidade de registro do
 * participante em determinado minicurso.
 */
private static function verificaDisponibilidade($participante_doc, $minicurso_id) {
	
	if(Minicurso::consultaVagasRestantes($minicurso_id) == 0) {
		echo "Esse minicurso não possui mais vagas disponíveis";
		return (0);
	}

	if(Minicurso::horarioConflitante($participante_doc, $minicurso_id)) {
		echo "Você já está inscrito em um minicurso nesse mesmo horário";
		return (0);
	}

	return (1); 
}

public static function inscreveParticipante($participante_doc, $minicurso_id) {
	if (self::verificaDisponibilidade($participante_doc, $minicurso_id)) {
		$db = new db();
		$insert = $db->conexao->query("INSERT INTO inscricao 
							 VALUES ('$minicurso_id', '$participante_doc')");

		return ($insert) ? 1 : 0; 
	} else {
		return 0; //Não foi possível registrar
	}
}


}

?>