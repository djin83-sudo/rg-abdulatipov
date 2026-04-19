<?php
require_once 'includes/config.php';
require_once 'includes/db.php';
require_once 'includes/functions.php';
require_once 'includes/seo.php';

$pageTitle = 'Контакты';
$pageDescription = 'Контактная информация и форма обратной связи для связи с Рамзаном Абдулатиповым';
$pageKeywords = 'Абдулатипов контакты, написать письмо, обратная связь, официальные контакты';

include 'includes/header.php';
?>

<main class="container">
    <section class="contacts-page">
        <h1>Контакты</h1>
        
        <div class="contacts-grid">
            <div class="contact-info">
                <h2>Официальные контакты</h2>
                <p>По вопросам сотрудничества, участия в мероприятиях и интервью вы можете 
                связаться через приемную или по электронной почте.</p>
                
                <ul class="contact-details">
                    <li><strong>E-mail:</strong> info@rg-abdulatipov.ru</li>
                    <li><strong>Пресс-служба:</strong> press@rg-abdulatipov.ru</li>
                </ul>

                <h3>Социальные сети</h3>
                <div class="social-links-page">
                    <a href="#" target="_blank">Telegram</a> | 
                    <a href="#" target="_blank">ВКонтакте</a> | 
                    <a href="#" target="_blank">Одноклассники</a>
                </div>
            </div>

            <div class="contact-form-wrapper">
                <h2>Обратная связь</h2>
                <form action="/api/send_message.php" method="POST" class="contact-form">
                    <div class="form-group">
                        <label for="name">Ваше имя:</label>
                        <input type="text" id="name" name="name" required placeholder="Иван Иванов">
                    </div>
                    <div class="form-group">
                        <label for="email">Ваш E-mail:</label>
                        <input type="email" id="email" name="email" required placeholder="example@mail.com">
                    </div>
                    <div class="form-group">
                        <label for="subject">Тема:</label>
                        <select id="subject" name="subject">
                            <option value="general">Общие вопросы</option>
                            <option value="press">Пресс-служба</option>
                            <option value="science">Научная деятельность</option>
                            <option value="other">Другое</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message">Сообщение:</label>
                        <textarea id="message" name="message" rows="5" required placeholder="Введите ваше сообщение..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Отправить сообщение</button>
                </form>
            </div>
        </div>

        <style>
            .contacts-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 40px;
                margin-top: 30px;
            }
            .contact-form .form-group {
                margin-bottom: 20px;
            }
            .contact-form label {
                display: block;
                margin-bottom: 5px;
                font-weight: bold;
            }
            .contact-form input, 
            .contact-form select, 
            .contact-form textarea {
                width: 100%;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 4px;
            }
            @media (max-width: 768px) {
                .contacts-grid {
                    grid-template-columns: 1fr;
                }
            }
        </style>
    </section>
</main>

<?php include 'includes/footer.php'; ?>
