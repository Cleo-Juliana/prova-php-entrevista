<?php

require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $connection = new Connection();
    $connection->execute("INSERT INTO users (name, email) VALUES (?, ?)", [$name, $email]);

    header("Location: index.php");
    exit();
}

include 'templates/header.php';
?>

<div class="container">
    <h2>Criar Usuário</h2>
    <form method="POST">
        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Criar</button>
    </form>
</div>

<?php include 'templates/footer.php'; ?>
