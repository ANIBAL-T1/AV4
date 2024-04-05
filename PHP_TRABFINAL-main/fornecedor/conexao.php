<?php
class Conexao {
    private $host = "localhost";
    private $usuario = "root";
    private $senha = "";
    private $banco = "meu_banco";
    private $porta = "7306"; // Porta opcional

    public $conexao;

    public function conectar() {
        $this->conexao = null;
        try {
            if (!empty($this->porta)) {
                $dsn = "mysql:host={$this->host};port={$this->porta};dbname={$this->banco}";
            } else {
                $dsn = "mysql:host={$this->host};dbname={$this->banco}";
            }
            $this->conexao = new PDO($dsn, $this->usuario, $this->senha);
            $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $excecao) {
            echo "Erro de conexão: " . $excecao->getMessage();
        }
        return $this->conexao;
    }
}
?>


