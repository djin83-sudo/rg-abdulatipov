<?php
session_start();
require_once '../includes/config.php';
require_once '../includes/db.php';
require_once '../includes/functions.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$title = '';
$content = '';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    
    if ($id > 0) {
        $stmt = $pdo->prepare("UPDATE news SET title = ?, content = ? WHERE id = ?");
        $stmt->execute([$title, $content, $id]);
        $message = "Новость обновлена";
    } else {
        $stmt = $pdo->prepare("INSERT INTO news (title, content, created_at) VALUES (?, ?, NOW())");
        $stmt->execute([$title, $content]);
        $message = "Новость добавлена";
        $id = $pdo->lastInsertId();
    }
}

if ($id > 0) {
    $stmt = $pdo->prepare("SELECT * FROM news WHERE id = ?");
    $stmt->execute([$id]);
    $news = $stmt->fetch();
    if ($news) {
        $title = $news['title'];
        $content = $news['content'];
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?php echo $id > 0 ? 'Редактировать' : 'Добавить'; ?> новость</title>
    <style>
        body { font-family: sans-serif; margin: 0; display: flex; }
        .sidebar { width: 250px; background: #1a365d; color: white; min-height: 100vh; padding: 20px; }
        .content { flex: 1; padding: 40px; background: #f7fafc; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], textarea { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; }
        textarea { height: 300px; }
        .btn { padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; color: white; text-decoration: none; }
        .btn-save { background: #3182ce; }
        .btn-back { background: #718096; margin-left: 10px; }
        .message { padding: 10px; background: #c6f6d5; color: #22543d; margin-bottom: 20px; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>CMS Admin</h2>
        <nav>
            <a href="index.php" style="color:white; display:block; padding:10px 0;">Рабочий стол</a>
            <a href="news.php" style="color:white; display:block; padding:10px 0;">Новости</a>
        </nav>
    </div>
    <div class="content">
        <h1><?php echo $id > 0 ? 'Редактировать' : 'Добавить'; ?> новость</h1>
        
        <?php if ($message): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label>Заголовок</label>
                <input type="text" name="title" value="<?php echo htmlspecialchars($title); ?>" required>
            </div>
            <div class="form-group">
                <label>Содержание</label>
                <textarea name="content" required><?php echo htmlspecialchars($content); ?></textarea>
            </div>
            <button type="submit" class="btn btn-save">Сохранить</button>
            <a href="news.php" class="btn btn-back">Назад</a>
        </form>
    </div>
</body>
</html>
