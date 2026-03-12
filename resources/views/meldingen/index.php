<?php require_once __DIR__.'/../../../config/conn.php'; ?>
<!doctype html>
<html lang="nl">

<head>
    <title>StoringApp / Meldingen</title>
    <?php require_once __DIR__.'/../components/head.php'; ?>
</head>

<body>

    <?php require_once __DIR__.'/../components/header.php'; ?>

    <div class="container">
        <h1>Meldingen</h1>
        <a href="<?php echo $base_url; ?>/resources/views/meldingen/create.php">Nieuwe melding &gt;</a>

        <?php if(isset($_GET['msg']))
        {
            echo "<div class='msg'>" . $_GET['msg'] . "</div>";
        } ?>

        <?php
        // haal bestaande meldingen op
        require_once __DIR__.'/../../../config/conn.php';
        $stmt = $conn->query('SELECT * FROM meldingen ORDER BY gemeld_op DESC');
        $meldingen = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(count($meldingen) === 0):
        ?>
            <div>Er zijn nog geen meldingen.</div>
        <?php else: ?>
            <table class="meldingen-table">
                <thead>
                    <tr>
                        <th>Attractie</th>
                        <th>Type</th>
                        <th>Capaciteit</th>
                        <th>Prioriteit</th>
                        <th>Melder</th>
                        <th>Opmerking</th>
                        <th>Datum</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($meldingen as $m): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($m['attractie']); ?></td>
                            <td><?php echo htmlspecialchars($m['type']); ?></td>
                            <td><?php echo htmlspecialchars($m['capaciteit']); ?></td>
                            <td><?php echo $m['prioriteit'] ? 'Ja' : 'Nee'; ?></td>
                            <td><?php echo htmlspecialchars($m['melder']); ?></td>
                            <td><?php echo htmlspecialchars($m['overige_info']); ?></td>
                            <td><?php echo htmlspecialchars($m['gemeld_op']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

</body>

</html>
