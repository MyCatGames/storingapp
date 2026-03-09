<?php require_once __DIR__.'/../../../config/config.php'; ?>
<!doctype html>
<html lang="nl">

<head>
    <title>StoringApp / Meldingen / Nieuw</title>
    <?php require_once __DIR__.'/../components/head.php'; ?>
</head>

<body>

    <?php require_once __DIR__.'/../components/header.php'; ?>

    <div class="container">
        <h1>Nieuwe melding</h1>

        <?php if(isset($_GET['msg'])): ?>
            <div class="msg"><?php echo htmlspecialchars($_GET['msg']); ?></div>
        <?php endif; ?>

        <form action="<?php echo $base_url; ?>/app/Http/Controllers/meldingenController.php" method="POST">

            <div class="form-group">
                <label for="attractie">Naam attractie:</label>
                <input type="text" name="attractie" id="attractie" class="form-input" value="<?php echo isset($_GET['attractie']) ? htmlspecialchars($_GET['attractie']) : ''; ?>">
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <select name="type" id="type" class="form-input">
                    <option value="">-- kies type --</option>
                    <option value="achtbaan" <?php echo (isset($_GET['type']) && $_GET['type']=='achtbaan')? 'selected' : ''; ?>>achtbaan</option>
                    <option value="draaimolen" <?php echo (isset($_GET['type']) && $_GET['type']=='draaimolen')? 'selected' : ''; ?>>draaimolen</option>
                    <option value="waterattractie" <?php echo (isset($_GET['type']) && $_GET['type']=='waterattractie')? 'selected' : ''; ?>>waterattractie</option>
                </select>
            </div>
            <div class="form-group">
                <label for="capaciteit">Capaciteit p/uur:</label>
                <input type="number" min="0" name="capaciteit" id="capaciteit" class="form-input" value="<?php echo isset($_GET['capaciteit']) ? htmlspecialchars($_GET['capaciteit']) : ''; ?>">
            </div>
            <div class="form-group">
                <label for="prioriteit">
                    <input type="checkbox" name="prioriteit" id="prioriteit" value="1" <?php echo isset($_GET['prioriteit']) ? 'checked' : ''; ?>>
                    Prioriteit
                </label>
            </div>
            <div class="form-group">
                <label for="overige_info">Overige informatie:</label>
                <textarea name="overige_info" id="overige_info" class="form-input"><?php echo isset($_GET['overige_info']) ? htmlspecialchars($_GET['overige_info']) : ''; ?></textarea>
            </div>
            <div class="form-group">
                <label for="melder">Naam melder:</label>
                <input type="text" name="melder" id="melder" class="form-input" value="<?php echo isset($_GET['melder']) ? htmlspecialchars($_GET['melder']) : ''; ?>">
            </div>

            <input type="submit" value="Verstuur melding">

        </form>
    </div>

</body>

</html>
