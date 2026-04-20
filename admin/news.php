<?php
session_start();
require_once '../includes/config.php';
require_once '../includes/db.php';
require_once '../includes/functions.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

$db = Database::getInstance()->getConnection();
$stmt = $db->query("SELECT * FROM news ORDER BY created_at DESC");
$news = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Управление новостями - CMS</title>
    <style>
        body { font-family: sans-serif; margin: 0; display: flex; }
        .sidebar { width: 250px; background: #1a365d; color: white; min-height: 100vh; padding: 20px; }
        .content { flex: 1; padding: 40px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        .btn { padding: 8px 15px; text-decoration: none; border-radius: 4px; color: white; font-size: 14px; }
        .btn-add { background: #28a745; margin-bottom: 20px; display: inline-block; }
        .btn-edit { background: #007bff; margin-right: 5px; }
        .btn-delete { background: #dc3545; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>CMS Admin</h2>
        <nav>
            <a href="index.php" style="color:white; display:block; padding:10px 0;">Рабочий стол</a>
            <a href="news.php" style="color:white; display:block; padding:10px 0; font-weight:bold;">Новости</a>
            <a href="logout.php" style="color:#fc8181; display:block; padding:10px 0;">Выход</a>
        </nav>
    </div>
    <div class="content">
        <h1>Управление новостями</h1>
        <a href="news_edit.php" class="btn btn-add">Добавить новость</a>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Заголовок</th>
                    <th>Дата</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($news as $item): ?>
                <tr>
                    <td><?php echo $item['id']; ?></td>
                    <td><?php echo htmlspecialchars($item['title']); ?></td>
                    <td><?php echo $item['created_at']; ?></td>
                    <td>
                        <a href="news_edit.php?id=<?php echo $item['id']; ?>" class="btn btn-edit">Ред.</a>
                        <a href="news_delete.php?id=<?php echo $item['id']; ?>" class="btn btn-delete" onclick="return confirm('Удалить?')">Удалить</a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($news)): ?>
                <tr>
                    <td colspan="4" style="text-align:center;">Новостей пока нет.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
