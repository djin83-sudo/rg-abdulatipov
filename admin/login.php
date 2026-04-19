<?php
session_start();
require_once '../includes/config.php';

if (isset($_SESSION['admin_logged_in'])) {
    header('Location: index.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === 'admin' && password_verify($password, ADMIN_HASH)) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: index.php');
        exit;
    } else {
        $error = 'Неверный логин или пароль';
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход в панель управления</title>
    <style>
        body { font-family: 'Times New Roman', serif; background: #f0f2f5; display: flex; align-items: center; justify-content: center; height: 100vh; margin: 0; }
        .login-box { background: #fff; padding: 40px; border-radius: 4px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); width: 350px; }
        h1 { text-align: center; color: #1a365d; margin-bottom: 30px; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 5px; color: #4a5568; }
        input { width: 100%; padding: 12px; border: 1px solid #cbd5e0; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background: #1a365d; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; }
        button:hover { background: #2c5282; }
        .error { color: #e53e3e; text-align: center; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="login-box">
        <h1>Вход в CMS</h1>
        <?php if ($error): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label>Логин</label>
                <input type="text" name="username" required>
            </div>
            <div class="form-group">
                <label>Пароль</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit">Войти</button>
        </form>
    </div>
</body>
</html>
