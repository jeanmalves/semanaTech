<?php
require_once("classes/loader.php");

if(!empty($_POST)) {
$db = new db();

$nome	   = mysqli_real_escape_string($db->conexao, $_POST['nome']);
$email 	   = mysqli_real_escape_string($db->conexao, $_POST['email']);
$doc 	   = mysqli_real_escape_string($db->conexao, $_POST['documento']);
$aluno     = mysqli_real_escape_string($db->conexao, $_POST['is_aluno']);
$fone 	   = mysqli_real_escape_string($db->conexao, $_POST['fone']);
$minicurso = mysqli_real_escape_string($db->conexao, $_POST['minicurso']);

$aluno 	   = ($aluno == 'on')? 1 : 0;	

$doc = Participante::registraParticipante($nome, $email, $aluno, $doc, $fone);
if($doc != 0 ) { 
	try {
		Participante::inscreveParticipante($doc, $minicurso);
		echo "1";
	} catch(Exception $e) {
		echo $e;
		exit(1);
	}

} else {
	echo "0"; exit(1);
}
}
?>