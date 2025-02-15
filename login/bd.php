<?php
session_start();

$host = "localhost:3306";
$user = "root";
$password = "root";
$dbname = "login";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Consulta segura para verificar se o email existe
    $sql = "SELECT * FROM usuarios WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['email' => $email]);

    if ($stmt->rowCount() > 0) {
        // Email encontrado, verificar a senha
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica a senha usando password_verify
        if (password_verify($senha, $row['senha'])) {
            $_SESSION['usuario_id'] = $row['id'];
            $_SESSION['usuario_nome'] = $row['nome'];

            if (isset($_POST["lembrar"])) {
                setcookie('email', $email, time() + 3600, "/"); // 1 hora
            }

            header("Location: bemvindas.php");
            exit;
        } else {
            // Senha incorreta
            $mensagem = "Senha incorreta!";
        }
    } else {
        // Email não encontrado
        $mensagem = "Email não encontrado!";
    }
}
?>
