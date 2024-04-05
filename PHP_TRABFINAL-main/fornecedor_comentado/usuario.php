<?php
class usuario {
    private $conexao;
    private $tabela_nome = "usuarios";

    public $id;
    public $nome;
    public $telefone;

    public function __construct($db) {
        $this->conexao = $db;
    }

    function ler() {
        $query = "SELECT id, nome, telefone FROM " . $this->tabela_nome;
        $comando = $this->conexao->prepare($query);
        $comando->execute();
        return $comando;
    }

    function criar() {
        $query = "INSERT INTO " . $this->tabela_nome . " SET nome=:nome, telefone=:telefone";
        $comando = $this->conexao->prepare($query);
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->telefone = htmlspecialchars(strip_tags($this->telefone));
        $comando->bindParam(":nome", $this->nome);
        $comando->bindParam(":telefone", $this->telefone);
        if ($comando->execute()) {
            return true;
        }
        return false;
    }
}
?>