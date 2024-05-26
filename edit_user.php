<?php

require 'connection.php';

$connection = new Connection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    $connection->execute("UPDATE users SET name = ?, email = ? WHERE id = ?", [$name, $email, $id]);

    header("Location: index.php");
    exit();
}

$id = $_GET['id'];
$user = $connection->query("SELECT * FROM users WHERE id = $id")[0];

include 'templates/header.php';
?>

<div class="container">
    <h2>Editar Usuário</h2>
    <form method="POST">
        <input type="hidden" name="id" value="<?= $user->id ?>">
        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" name="name" class="form-control" value="<?= $user->name ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="<?= $user->email ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>

<?php include 'templates/footer.php'; ?>
