<?php
session_start();
require_once __DIR__.'/../../../config/conn.php';

// Controleer of gebruiker al ingelogd is
if(isset($_SESSION['user'])) {
    header('Location: ' . $base_url . '/resources/views/meldingen/index.php');
    exit;
}

$error = '';

// Verwerk login form
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    
    if(!empty($username) && !empty($password)) {
        // Check gebruiker in database
        $stmt = $conn->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($user && $user['password'] === $password) {
            $_SESSION['user'] = $username;
            header('Location: ' . $base_url . '/resources/views/meldingen/index.php');
            exit;
        } else {
            $error = 'Ongeldige gebruikersnaam of wachtwoord';
        }
    }
}
?>
<!doctype html>
<html lang="nl">

<head>
    <title>StoringApp / Inloggen</title>
    <?php require_once __DIR__.'/../components/head.php'; ?>
</head>

<body>

    <?php require_once __DIR__.'/../components/header.php'; ?>

    <div class="container">
        <h1>Inloggen</h1>
        <?php if($error): ?>
            <div class="msg error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <div>
                <label for="username">Gebruikersnaam:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div>
                <label for="password">Wachtwoord:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Inloggen</button>
        </form>
    </div>

</body>

</html>
