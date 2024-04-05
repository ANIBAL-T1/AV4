<?php
include_once 'conexao.php';
include_once 'fornecedor.php';

$conexao_banco = new Conexao();
$banco = $conexao_banco->conectar();

$fornecedor = new Fornecedor($banco);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['fornecedor']) && !empty($_POST['celular'])) {
        $fornecedor->fornecedor = $_POST['fornecedor'];
        $fornecedor->celular = $_POST['celular'];

        if ($fornecedor->criar()) {
            // Redireciona de volta para a página index.php após a inserção bem-sucedida
            header("Location: index.php");
            exit();
        } else {
            echo "<p>Não foi possível criar o fornecedor.</p>";
        }
    } else {
        echo "<p>Por favor, preencha todos os campos.</p>";
    }
}

$stmt = $fornecedor->ler();
$num = $stmt->rowCount();

if ($num > 0) {
    echo "<h2>Fornecedores Cadastrados</h2>";
    echo "<div class='lista-fornecedores'>";
    echo "<ul>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        echo "<li>ID: {$id}, Fornecedor: {$fornecedor}, Celular: {$celular}</li>";
    }
    echo "</ul>";
    echo "</div>";
} else {
    echo "<p>Nenhum fornecedor cadastrado.</p>";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Fornecedores</title>
    <link rel="stylesheet" href="estilo.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
</head>
<body>
    <div class="container">
        <h2>Adicionar Novo Fornecedor</h2>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="fornecedor">Fornecedor:</label>
            <input type="text" id="fornecedor" name="fornecedor" required>

            <label for="celular">Celular:</label>
            <input type="text" id="celular" name="celular" required>

            <input type="submit" value="Adicionar Fornecedor">
        </form>
    </div>
    <script>
        $(document).ready(function(){
            $('#celular').mask('(00)0 0000-0000');
        });
    </script>
</body>
</html>
