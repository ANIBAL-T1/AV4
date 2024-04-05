<?php
// Inclui os arquivos de conexão e classe Fornecedor
include_once 'conexao.php';
include_once 'usuario.php';

// Cria uma instância da classe de conexão
$conexao_banco = new Conexao();
// Conecta ao banco de dados
$banco = $conexao_banco->conectar();

// Cria uma instância da classe Usuarios, passando a conexão como parâmetro
$usuario = new Usuario($banco);

// Verifica se o método de requisição é POST (se o formulário foi submetido)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se os campos 'usuarios' e 'celular' foram preenchidos
    if (!empty($_POST['nome']) && !empty($_POST['telefone'])) {
        // Atribui os valores dos campos do formulário aos atributos da instância de Fornecedor
        $usuario->nome = $_POST['nome'];
        $usuario->telefone = $_POST['telefone'];

        // Tenta criar um novo usuarios no banco de dados
        if ($usuario->criar()) {
            // Redireciona de volta para a página index.php após a inserção bem-sucedida
            header("Location: index.php");
            exit();
        } else {
            // Exibe uma mensagem de erro caso a criação do usuarios falhe
            echo "<p>Não foi possível criar o usuario.</p>";
        }
    } else {
        // Exibe uma mensagem solicitando que todos os campos sejam preenchidos
        echo "<p>Por favor, preencha todos os campos.</p>";
    }
}

// Lê todos os usuarios cadastrados no banco de dados
$stmt = $usuario->ler();
// Obtém o número de registros retornados pela consulta
$num = $stmt->rowCount();

// Verifica se existem Usuarios cadastrados
if ($num > 0) {
    echo "<h2>Usuarios Cadastrados</h2>";
    echo "<div class='lista-Usuarios'>";
    echo "<ul>";
    // Itera sobre os registros retornados, extraindo os valores e exibindo-os na página
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        echo "<li>ID: {$id}, Nome: {$nome}, telefone: {$telefone}</li>";
    }
    echo "</ul>";
    echo "</div>";
} else {
    // Exibe uma mensagem caso não haja usuarios cadastrados
    echo "<p>Nenhum Usuario cadastrado.</p>";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Usuario</title>
    <link rel="stylesheet" href="estilo.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
</head>
<body>
    <div class="container">
        <h2>Adicionar Novo Usuario</h2>
        <!-- Formulário para adicionar novos usuario -->
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="telefone">Telefone:</label>
            <input type="text" id="teleofne" name="telefone" required>

            <input type="submit" value="Adicionar Usuario">
        </form>
    </div>
    <!-- Script para aplicar máscara de telefone ao campo 'celular' -->
    <script>
        $(document).ready(function(){
            $('#telefone').mask('(00)0 0000-0000');
        });
    </script>
</body>
</html>
