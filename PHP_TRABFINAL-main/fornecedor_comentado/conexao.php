<?php
class Conexao {
    // Definição das propriedades da classe Conexao
    private $host = "localhost"; // Endereço do servidor MySQL
    private $usuario = "root"; // Nome de usuário do MySQL
    private $senha = ""; // Senha do usuário do MySQL
    private $banco = "meu_banco"; // Nome do banco de dados
    private $porta = "7306"; // Porta opcional para conexão

    // Propriedade pública para armazenar a conexão PDO
    public $conexao;

    // Método para conectar ao banco de dados
    public function conectar() {
        $this->conexao = null; // Inicializa a conexão como nula
        try {
            // Verifica se a porta está definida e monta a DSN (Data Source Name) adequadamente
            if (!empty($this->porta)) {
                $dsn = "mysql:host={$this->host};port={$this->porta};dbname={$this->banco}";
            } else {
                // Se a porta não estiver definida, usa uma DSN sem especificar a porta
                $dsn = "mysql:host={$this->host};dbname={$this->banco}";
            }
            // Inicializa uma nova instância de PDO para se conectar ao banco de dados
            $this->conexao = new PDO($dsn, $this->usuario, $this->senha);
            // Define o modo de erro para lançar exceções em caso de erros de PDO
            $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $excecao) {
            // Captura qualquer exceção PDO que possa ocorrer durante a conexão e exibe uma mensagem de erro
            echo "Erro de conexão: " . $excecao->getMessage();
        }
        // Retorna o objeto de conexão PDO, que pode ser usado posteriormente para realizar operações no banco de dados
        return $this->conexao;
    }
}
?>


