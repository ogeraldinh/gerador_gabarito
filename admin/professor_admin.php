<?php
require_once('../conex.php');
include('../protect.php');
include("../pesquisar_dis_ou_prof.php");
// Inicia sessão se não estiver iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once('verificar_admin.php'); // Inclua a função de verificação

// Chama a função para verificar se o usuário é um administrador
verificarAdmin();

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/css/main.css" />
    <link rel="stylesheet" href="../assets/css/navbar.css" />
    <link rel="stylesheet" href="../assets/css/footer.css" />
    <link rel="stylesheet" href="../assets/css/tabela.css" />
    <title>Professores</title>
</head>
<body>
    <nav class="navbar"></nav>
    
    <main class="container">
        <h1>Lista de Professores</h1>
        
        <form method="POST" class="search-form">
            <input type="text" name="busca" placeholder="Pesquisar por nome ou disciplina" value="<?= htmlspecialchars($busca) ?>">
            <button type="submit" class="btn-buscar">Buscar</button>
        </form>
        
        <div class="table-responsive">
            <table class="tabela-dados">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Tipo</th>
                        <th>Disciplina</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->rowCount() > 0): ?>
                        <?php while ($user_data = $result->fetch(PDO::FETCH_ASSOC)): ?>
                            <tr>
                                <td><?= htmlspecialchars($user_data['id']) ?></td>
                                <td><?= htmlspecialchars($user_data['nome']) ?></td>
                                <td><?= htmlspecialchars($user_data['email']) ?></td>
                                <td><?= htmlspecialchars($user_data['tipos_usuario']) ?></td>
                                <td><?= htmlspecialchars($user_data['disciplinas_nome']) ?></td>
                                <td class="acoes">
                                    <a href="atualizar_prof.php?id=<?= $user_data['id'] ?>" class="btn-editar">Editar</a>
                                    <a href="excluir_professor.php?id=<?= $user_data['id'] ?>" class="btn-excluir" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="sem-dados">Nenhum professor encontrado</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div>
            <a href="cadastro_professor.php" class="btn-cadastro">Cadastrar professor</a>
        </div>
        <a href="admin.php">voltar</a>
    </main>

    <footer class="footer"></footer>

    <script src="assets/js/navbar.js"></script>
    <script src="assets/js/footer.js"></script>
</body>
</html>