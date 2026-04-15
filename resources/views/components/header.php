<?php 
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__.'/../../../config/conn.php'; 
?>

<header>
    <div class="container">
        <nav>
            <img src="<?php echo $base_url; ?>/public_html/img/logo-big-v4.png" alt="logo" class="logo">
            <a href="<?php echo $base_url; ?>/index.php">Home</a> |
            <a href="<?php echo $base_url; ?>/resources/views/meldingen/index.php">Meldingen</a>
        </nav>
        <div>
            <?php if(isset($_SESSION['user'])): ?>
                <span>Ingelogd als: <?php echo htmlspecialchars($_SESSION['user']); ?></span> | 
                <a href="<?php echo $base_url; ?>/resources/views/login/logout.php">Uitloggen</a>
            <?php else: ?>
                <a href="<?php echo $base_url; ?>/resources/views/login/index.php">Inloggen</a>
            <?php endif; ?>
        </div>
    </div>
</header>
