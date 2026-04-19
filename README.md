# Персональный сайт Рамзана Гаджимуратовича Абдулатипова

> Официальный сайт государственного деятеля, Героя Труда России, бывшего Главы Республики Дагестан

## О проекте

Этот репозиторий содержит исходный код персонального веб-сайта **Рамзана Гаджимуратовича Абдулатипова** — выдающегося государственного деятеля, дипломата и учёного.

### Технический стек

- **Frontend**: HTML5, CSS3 (Vanilla), JavaScript
- **Backend**: PHP 8.x
- **БД**: MySQL / SQLite
- **Архитектура**: MVC-подобная структура
- **CMS**: Собственная админ-панель
- **CI/CD**: GitHub Actions

---

## Структура проекта

```
rg-abdulatipov/
├── index.php              # Главная страница
├── biography.php          # Биография
├── activities.php         # Деятельность
├── publications.php       # Публикации и СМИ
├── gallery.php            # Фотогалерея
├── contacts.php           # Контакты
├── includes/              # PHP-модули
│   ├── config.php        # Конфигурация
│   ├── db.php            # Подключение к БД
│   ├── functions.php     # Вспомогательные функции
│   ├── header.php        # Шапка сайта
│   ├── footer.php        # Подвал сайта
│   └── seo.php           # SEO-функции
├── assets/
│   ├── css/style.css     # Основные стили
│   ├── js/main.js        # JavaScript
│   ├── img/              # Изображения
│   └── pdf/              # PDF-файлы
├── admin/                 # CMS (админ-панель)
│   ├── index.php
│   ├── login.php
│   └── ...
└── .github/workflows/
    └── deploy.yml         # CI/CD конфигурация
```

---

## Настройка сервера

### Требования

- **ОС**: Ubuntu 20.04+ / Debian 11+
- **Веб-сервер**: Apache 2.4+ или Nginx 1.18+
- **PHP**: 8.0+
- **БД**: MySQL 8.0+ или MariaDB 10.5+
- **SSL**: Let's Encrypt (Certbot)

### 1. Установка зависимостей

#### Apache + PHP + MySQL

```bash
sudo apt update
sudo apt install -y apache2 php8.1 php8.1-mysql php8.1-mbstring php8.1-xml php8.1-curl mysql-server
sudo systemctl enable apache2 mysql
sudo systemctl start apache2 mysql
```

#### Включение mod_rewrite

```bash
sudo a2enmod rewrite
sudo systemctl restart apache2
```

### 2. Настройка виртуального хоста

Создайте файл `/etc/apache2/sites-available/rg-abdulatipov.conf`:

```apache
<VirtualHost *:80>
    ServerName rg-abdulatipov.ru
    ServerAlias www.rg-abdulatipov.ru
    DocumentRoot /var/www/rg-abdulatipov.ru

    <Directory /var/www/rg-abdulatipov.ru>
        Options -Indexes +FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/rg-abdulatipov-error.log
    CustomLog ${APACHE_LOG_DIR}/rg-abdulatipov-access.log combined
</VirtualHost>
```

Активируйте сайт:

```bash
sudo a2ensite rg-abdulatipov.conf
sudo systemctl reload apache2
```

### 3. Настройка SSL (Let's Encrypt)

```bash
sudo apt install -y certbot python3-certbot-apache
sudo certbot --apache -d rg-abdulatipov.ru -d www.rg-abdulatipov.ru
```

Certbot автоматически настроит HTTPS и перенаправление.

### 4. Создание базы данных

```bash
sudo mysql
```

```sql
CREATE DATABASE rg_abdulatipov CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'rg_user'@'localhost' IDENTIFIED BY 'ВАШПАРОЛЬ';
GRANT ALL PRIVILEGES ON rg_abdulatipov.* TO 'rg_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

### 5. Импорт схемы БД

```bash
mysql -u rg_user -p rg_abdulatipov < database/schema.sql
```

### 6. Настройка конфигурации

Отредактируйте `includes/config.php`:

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'rg_abdulatipov');
define('DB_USER', 'rg_user');
define('DB_PASS', 'ВАШПАРОЛЬ');
define('SITE_URL', 'https://rg-abdulatipov.ru');
```

### 7. Установка прав доступа

```bash
sudo chown -R www-data:www-data /var/www/rg-abdulatipov.ru
sudo chmod -R 755 /var/www/rg-abdulatipov.ru
sudo chmod -R 775 /var/www/rg-abdulatipov.ru/assets/img/uploads
sudo chmod -R 775 /var/www/rg-abdulatipov.ru/assets/pdf
```

---

## Настройка CI/CD (GitHub Actions)

### 1. Генерация SSH-ключа

На **локальной машине**:

```bash
ssh-keygen -t rsa -b 4096 -C "deploy@rg-abdulatipov.ru" -f ~/.ssh/rg_deploy
```

### 2. Добавление публичного ключа на сервер

На **сервере** (под пользователем с доступом):

```bash
mkdir -p ~/.ssh
echo "СОДЕРЖИМОЕ_ПУБЛИЧНОГО_КЛЮЧА" >> ~/.ssh/authorized_keys
chmod 600 ~/.ssh/authorized_keys
```

### 3. Добавление GitHub Secrets

Перейдите в **Settings → Secrets and variables → Actions** и добавьте:

- `SERVER_HOST` = `157.22.193.251`
- `SERVER_USER` = `ваш_пользователь`
- `SERVER_SSH_KEY` = содержимое приватного ключа `~/.ssh/rg_deploy`
- `SERVER_PATH` = `/var/www/rg-abdulatipov.ru/`

### 4. Проверка деплоя

Сделайте коммит в ветку `main`:

```bash
git add .
git commit -m "Test CI/CD"
git push origin main
```

Деплой должен запуститься автоматически. Проверьте во вкладке **Actions**.

---

## Настройка домена

### DNS A-запись

В панели вашего DNS-провайдера добавьте:

```
Тип: A
Имя: @
Значение: 157.22.193.251
TTL: 3600

Тип: A
Имя: www
Значение: 157.22.193.251
TTL: 3600
```

### Проверка

```bash
dig +short rg-abdulatipov.ru
# Должен вернуть: 157.22.193.251
```

---

## Первый вход в CMS

1. Перейдите на https://rg-abdulatipov.ru/admin/
2. Логин: `admin`
3. Пароль: сгенерируйте хэш:

```bash
php -r "echo password_hash('ВАШ_ПАРОЛЬ', PASSWORD_BCRYPT);"
```

Вставьте результат в `includes/config.php` → `ADMIN_HASH`.

---

## Разработка

### Локальный сервер

```bash
php -S localhost:8000
```

### Структура веток

- `main` — продакшн (автодеплой)
- `develop` — разработка

### Создание feature-ветки

```bash
git checkout -b feature/новая-функция develop
```

---

## Поддержка

По вопросам технической поддержки: [support@rg-abdulatipov.ru](mailto:support@rg-abdulatipov.ru)

---

## Лицензия

© 2026 Рамзан Абдулатипов. Все права защищены.
