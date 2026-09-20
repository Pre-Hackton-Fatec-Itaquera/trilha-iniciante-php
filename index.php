<?php
    require_once 'config/config.php';

    $pdo = conectar();
    $erro = null;

    $professores = $pdo->query(
        'SELECT p.id, p.nome, AVG(a.nota) AS media
        FROM professores p 
        LEFT JOIN avaliacoes a ON a.professorId = p.id
        GROUP BY p.id, p.nome
        ORDER BY p.nome
        '
    )->fetchAll();

    $materias = $pdo->query(
        'SELECT m.id, m.nome
        FROM materias m
        '
    )->fetchAll();

    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $professorId = (int) ($_POST['professorId'] ?? 0);
        $materiaId = (int) ($_POST['materiaId'] ?? 0);
        $nota = (int) ($_POST['nota'] ?? 0);
        $comentario = trim($_POST['comentario'] ?? "");

        $valido = $professorId > 0 && $materiaId > 0 && $nota >= 1 && $nota <=5;
        if($valido){
            $query = $pdo->prepare(
                'INSERT INTO avaliacoes (professorId, materiaId, nota, comentario)
                VALUES (:professorId, :materiaId, :nota, :comentario)
            ');

            $query->execute([
                "professorId" => $professorId,
                "materiaId" => $materiaId,
                "nota" => $nota,
                "comentario" => $comentario,
            ]);

            header("Location: index.php");
            exit;
        }

        $erro = "Preencha corretamente os campos!";
    }
?>

    <?php require 'includes/cabecalho.php' ?>

    <main id="Principal">
        <!-- CardInfo -->
        <section id="Info">
            <h1>Professor Mensuring</h1>
            <p>Avalie seus professores e veja a média de cada um.</p>
        </section>
        <!-- Listagem -->
        <section id="Lista">
            <h2>Professores:</h2>
            <ul>
            <?php foreach($professores as $p):?>
                    <li>
                        <?= htmlspecialchars($p['nome']) ?>
                        <?= $p['media'] !== null
                            ? "⭐" . number_format((float) $p['media'], 1)
                            : "Ainda não avaliado" 
                        ?>
                    </li>
            <?php endforeach?>
            </ul>
        </section>

        <!-- Form -->
        <section id="Formulario">
            <h2>Deixar uma avaliação</h2>

            <?php if($erro):?>
                <p>
                    <?= htmlspecialchars($erro) ?>
                </p>
            <?php endif?>

            <!-- Professor - Materia - Nota - Comentario -->
            <form action="index.php" method="post">
                <label for="professor">Professor</label>
                <select name="professorId" id="professor" required>
                    <option value="">Selecione</option>
                    <?php foreach($professores as $p): ?>
                        <option value="<?= $p['id'] ?>">
                            <?= htmlspecialchars($p['nome']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="materia">Materia</label>
                <select name="materiaId" id="materia" required>
                    <option value="">Selecione</option>
                    <?php foreach($materias as $m): ?>
                        <option value="<?= $m['id'] ?>">
                            <?= htmlspecialchars($m['nome']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="nota">Nota</label>
                <input name="nota" id="nota" type="number" min="1" max="5" required>

                <label for="comentario">Comentario</label>
                <textarea name="comentario" id="comentario" maxLength="256" rows="3"></textarea>

                <button type="submit">Criar Avaliação</button>
            </form>
        </section>
    </main>

    <?php require 'includes/rodape.php' ?>
</body>
</html>