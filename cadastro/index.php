<?php
session_start(); // Inicia a sessão
include 'conexaoBD.php';

// Função para setar mensagens na sessão
function setMensagem($mensagem) {
    $_SESSION['mensagem'] = $mensagem;
}

// Recuperar mensagem e removê-la da sessão
function getMensagem() {
    if (isset($_SESSION['mensagem'])) {
        $mensagem = $_SESSION['mensagem'];
        unset($_SESSION['mensagem']);
        return $mensagem;
    }
    return '';
}

// Adicionar novo usuário
if (isset($_POST['adicionar'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    // Armazena o nome e email em cookies para preencher automaticamente no futuro
    setcookie('ultimo_nome', $nome, time() + (86400 * 30), "/"); // Validade: 30 dias
    setcookie('ultimo_email', $email, time() + (86400 * 30), "/");

    try {
        $sql = "INSERT INTO usuarios (nome, email) VALUES (:nome, :email)";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['nome' => $nome, 'email' => $email]);

        setMensagem("Usuário adicionado com sucesso!");
    } catch (PDOException $e) {
        setMensagem("Erro ao adicionar usuário: " . $e->getMessage());
    }

    header("Location: index.php");
    exit;
}

// Editar usuário
if (isset($_POST['editar'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    try {
        $sql = "UPDATE usuarios SET nome = :nome, email = :email WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id, 'nome' => $nome, 'email' => $email]);

        setMensagem("Usuário atualizado com sucesso!");
    } catch (PDOException $e) {
        setMensagem("Erro ao atualizar usuário: " . $e->getMessage());
    }

    header("Location: index.php");
    exit;
}

// Excluir usuário
if (isset($_GET['excluir'])) {
    $id = $_GET['excluir'];

    try {
        $sql = "DELETE FROM usuarios WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id]);

        setMensagem("Usuário excluído com sucesso!");
    } catch (PDOException $e) {
        setMensagem("Erro ao excluir usuário: " . $e->getMessage());
    }

    header("Location: index.php");
    exit;
}

// Obter todos os usuários
$sql = "SELECT * FROM usuarios";
$stmt = $conn->query($sql);
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD em PHP</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        .mensagem {
            padding: 10px;
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            margin-bottom: 15px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h1>CRUD em PHP</h1>

    <!-- Exibe mensagem de feedback -->
    <?php if ($mensagem = getMensagem()): ?>
        <div class="mensagem"><?= htmlspecialchars($mensagem) ?></div>
    <?php endif; ?>

    <!-- Formulário para adicionar usuário -->
    <form method="POST" action="">
        <input type="text" name="nome" placeholder="Nome" value="<?= isset($_COOKIE['ultimo_nome']) ? htmlspecialchars($_COOKIE['ultimo_nome']) : '' ?>" required>
        <input type="email" name="email" placeholder="Email" value="<?= isset($_COOKIE['ultimo_email']) ? htmlspecialchars($_COOKIE['ultimo_email']) : '' ?>" required>
        <button type="submit" name="adicionar">Adicionar</button>
    </form>

    <h2>Lista de Usuários</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Criado em</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($usuarios as $usuario): ?>
        <tr>
            <td><?= $usuario['id'] ?></td>
            <td><?= htmlspecialchars($usuario['nome']) ?></td>
            <td><?= htmlspecialchars($usuario['email']) ?></td>
            <td><?= $usuario['criado_em'] ?></td>
            <td>
                <!-- Formulário para editar -->
                <form method="POST" action="" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $usuario['id'] ?>">
                    <input type="text" name="nome" value="<?= htmlspecialchars($usuario['nome']) ?>" required>
                    <input type="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required>
                    <button type="submit" name="editar">Editar</button>
                </form>
                <!-- Link para excluir -->
                <a href="?excluir=<?= $usuario['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
