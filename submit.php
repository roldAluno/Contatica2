<?php
// Dados do banco de dados do Heroku
$host = 'otmaa16c1i9nwrek.cbetxkdyhwsb.us-east-1.rds.amazonaws.com';
$db = 'qcrmrz5ihzz3rx4a';
$user = 'q9lysnceigpwjhlh';
$pass = 'z3t5kob2odqhmhd3';
$charset = 'utf8mb4';

// DSN (Data Source Name)
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    // Conexão com o banco de dados
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém o valor do campo de e-mail
    $email = $_POST['email'];

    // Prepara a instrução SQL para inserção
    $sql = 'INSERT INTO contatica (contato) VALUES (?)';
    $stmt = $pdo->prepare($sql);

    // Executa a instrução SQL com o valor do e-mail
    if ($stmt->execute([$email])) {
        echo 'Contato salvo com sucesso!';
    } else {
        echo 'Erro ao salvar contato.';
    }
}
?>
