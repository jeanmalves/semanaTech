<?php
class db {
    public $conexao;
    public function __construct($server = 'localhost', $user = 'st2015adm' , $pass = 'st2015@utfpr' , $db = 'st2015' ) {
    $this->conexao = new mysqli($server, $user, $pass, $db);
        if (mysqli_connect_errno()) {
            echo "Não foi possível conectar com o banco de dados.";
            exit(1);
        }
    }
    public function __destruct() {
        mysqli_close($this->conexao);
    }
}
?>