<?php

require 'connection.php';

$connection = new Connection();
$user_id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $colors = $_POST['colors'] ?? [];

    // Remover todas as associações existentes para este usuário
    $connection->execute("DELETE FROM user_colors WHERE user_id = ?", [$user_id]);

    // Adicionar associações para as cores selecionadas
    foreach ($colors as $color_id) {
        $connection->execute("INSERT INTO user_colors (user_id, color_id) VALUES (?, ?)", [$user_id, $color_id]);
    }

    header("Location: index.php");
    exit; // Garante que o script seja encerrado após o redirecionamento
}

$user = $connection->query("SELECT * FROM users WHERE id = $user_id")[0];
$all_colors = $connection->query("SELECT * FROM colors");
$user_colors = $connection->query("SELECT c.name FROM user_colors uc JOIN colors c ON uc.color_id = c.id WHERE uc.user_id = $user_id");

$user_color_names = array_map(function($uc) { return $uc->name; }, $user_colors);

include 'templates/header.php';
?>

<div class="container">
    <h2>Gerenciar Cores para <?= $user->name ?></h2>
    <form method="POST">
        <div class="form-group">
            <?php foreach ($all_colors as $color): ?>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="colors[]" value="<?= $color->id ?>" <?= in_array($color->name, $user_color_names) ? 'checked' : '' ?>>
                    <label class="form-check-label"><?= $color->name ?></label>
                </div>
            <?php endforeach; ?>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>

<?php include 'templates/footer.php'; ?>


