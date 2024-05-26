<?php

/*require 'connection.php';

$connection = new Connection();

$users = $connection->query("SELECT * FROM users");

echo "<table border='1'>

    <tr>
        <th>ID</th>    
        <th>Nome</th>    
        <th>Email</th>
        <th>Ação</th>    
    </tr>
";

foreach($users as $user) {

    echo sprintf("<tr>
                      <td>%s</td>
                      <td>%s</td>
                      <td>%s</td>
                      <td>
                           <a href='#'>Editar</a>
                           <a href='#'>Excluir</a>
                      </td>
                   </tr>",
        $user->id, $user->name, $user->email);

}

echo "</table>";

*/

require 'connection.php';

$connection = new Connection();
$users = $connection->query("SELECT * FROM users");

include 'templates/header.php';
?>

<div class="container">
    <h2>Lista de Usuários</h2>
    <a href="create_user.php" class="btn btn-primary">Criar Usuário</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>    
                <th>Nome</th>    
                <th>Email</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user->id ?></td>
                <td><?= $user->name ?></td>
                <td><?= $user->email ?></td>
                <td>
                    <a href="edit_user.php?id=<?= $user->id ?>" class="btn btn-warning">Editar</a>
                    <a href="delete_user.php?id=<?= $user->id ?>" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                    <a href="user_colors.php?id=<?= $user->id ?>" class="btn btn-info">Vincular/Desvincular Cores</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'templates/footer.php'; ?>
