<?php

class Minicurso {


	public static function consultaVagasRestantes($minicurso_id) {
		$db = new db();

		//N de vagas ofertadas pelo minicurso
		$n_vagas = $db->conexao->query("SELECT qtd_vagas 
										FROM minicurso
										WHERE minicurso_id = '$minicurso_id' ");
		$n_vagas = mysqli_fetch_assoc($n_vagas);
		$n_vagas = $n_vagas['qtd_vagas'];

		//N de vagas preenchidas
		$n_ocupado = $db->conexao->query("SELECT count(*)
										  FROM inscricao
										  WHERE minicurso_id = '$minicurso_id' ");
		$n_ocupado = mysqli_fetch_assoc($n_ocupado);
		$n_ocupado = $n_ocupado['count(*)'];

		//Retorna as vagas retantes
		return  ($n_vagas - $n_ocupado); 
	}


	/*
	 * Verifica se existem conflitos de horários nos minicursos que
	 * o usuário já está inscrito com o minicurso que ele deseja
	 * se inscrever.
	 */
	public static function horarioConflitante($participante_doc, $minicurso_id) {
		$db = new db();
		
		//Consulta a data de inicio do minicurso procurado
		$data_inicio = mysqli_fetch_assoc($db->conexao->query("SELECT dt_inicio
											FROM minicurso
											WHERE minicurso_id = '$minicurso_id'"));

		$data_inicio = $data_inicio['dt_inicio'];

		//Consulta os minicursos em que o participante já está inscrito
		$sql = "SELECT inscricao.minicurso_id, minicurso.dt_fim
				FROM inscricao INNER JOIN minicurso 
				ON minicurso.minicurso_id = inscricao.minicurso_id
				WHERE inscricao.participante_doc = '$participante_doc'";
		
		//Se houverem registros 
		if(mysqli_num_rows($db->conexao->query($sql)) > 0 ) {
			/* Percorre todos os minicursos em que o usuário está inscrito */
			while ($inscricoes = mysqli_fetch_assoc($db->conexao->query($sql))) {
				return ($data_inicio >= $inscricoes['dt_fim']) ? 0 : 1;
			}
		} else { //Usuário não está inscrito em nenhum minicurso
			return (0);
		}


	}
}

?>