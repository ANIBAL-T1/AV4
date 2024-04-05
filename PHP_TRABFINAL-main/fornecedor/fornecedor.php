<?php
class Fornecedor {
    private $conexao;
    private $tabela_nome = "fornecedores";

    public $id;
    public $fornecedor;
    public $celular;

    public function __construct($db) {
        $this->conexao = $db;
    }

    function ler() {
        $query = "SELECT id, fornecedor, celular FROM " . $this->tabela_nome;
        $comando = $this->conexao->prepare($query);
        $comando->execute();
        return $comando;
    }

    function criar() {
        $query = "INSERT INTO " . $this->tabela_nome . " SET fornecedor=:fornecedor, celular=:celular";
        $comando = $this->conexao->prepare($query);
        $this->fornecedor = htmlspecialchars(strip_tags($this->fornecedor));
        $this->celular = htmlspecialchars(strip_tags($this->celular));
        $comando->bindParam(":fornecedor", $this->fornecedor);
        $comando->bindParam(":celular", $this->celular);
        if ($comando->execute()) {
            return true;
        }
        return false;
    }
}
?>
