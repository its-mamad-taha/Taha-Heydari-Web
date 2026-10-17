<?php
session_start();

// تنظیمات دیتابیس
$host = '127.0.0.1';
$db   = 'minecraft_server';
$user = 'root'; 
$pass = '';     

$message = '';
$messageType = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (\PDOException $e) {
    // die("خطا در اتصال به دیتابیس: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'] ?? '';
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $message = "لطفاً تمام فیلدها را پر کنید.";
        $messageType = "error";
    } else {
        if ($action === 'register') {
            $confirm_password = $_POST['confirm_password'] ?? '';
            if ($password !== $confirm_password) {
                $message = "رمز عبور و تکرار آن یکسان نیستند.";
                $messageType = "error";
            } else {
                try {
                    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
                    $stmt->execute([$username]);
                    if ($stmt->rowCount() > 0) {
                        $message = "این نام کاربری قبلاً ثبت شده است.";
                        $messageType = "error";
                    } else {
                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
                        if ($stmt->execute([$username, $hashed_password])) {
                            $_SESSION['user_id'] = $pdo->lastInsertId();
                            $_SESSION['username'] = $username;
                            header("Location: dashboard.php");
                            exit;
                        } else {
                            $message = "خطا در ثبت نام. لطفاً دوباره تلاش کنید.";
                            $messageType = "error";
                        }
                    }
                } catch (\Exception $e) {
                    $message = "خطای سیستم. لطفا بعدا تلاش کنید.";
                    $messageType = "error";
                }
            }
        } elseif ($action === 'login') {
            try {
                $stmt = $pdo->prepare("SELECT id, password FROM users WHERE username = ?");
                $stmt->execute([$username]);
                $userRow = $stmt->fetch();

                if ($userRow && password_verify($password, $userRow['password'])) {
                    $_SESSION['user_id'] = $userRow['id'];
                    $_SESSION['username'] = $username;
                    header("Location: dashboard.php");
                    exit;
                } else {
                    $message = "نام کاربری یا رمز عبور اشتباه است.";
                    $messageType = "error";
                }
            } catch (\Exception $e) {
                $message = "خطای سیستم. لطفا بعدا تلاش کنید.";
                $messageType = "error";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Meta Tags (SEO & Security) -->
    <title>یونیورس نتورک | ورود و ثبت نام</title>
    <meta name="description" content="سرور ماینکرافت یونیورس نتورک - بهترین تجربه بازی ماینکرافت با پایین‌ترین پینگ در ایران. ورود و ثبت نام.">
    <meta name="keywords" content="ماینکرافت, سرور ماینکرافت, یونیورس نتورک, بازی آنلاین, ماینکرفت ایران">
    <meta name="author" content="Universe Network">
    <meta http-equiv="X-Content-Type-Options" content="nosniff">
    <meta http-equiv="X-Frame-Options" content="DENY">
    <meta http-equiv="X-XSS-Protection" content="1; mode=block">
    <link rel="icon" href="logo.png" type="image/png">

    <!-- Bootstrap Grid (ArvanCloud CDN) -->
    <link rel="stylesheet" href="https://lib.arvancloud.ir/bootstrap/5.3.0-alpha1/css/bootstrap-grid.rtl.css">

    <style>
        /* ===== فونت ===== */
        @font-face {
            font-family: 'Gowardo';
            src: url('fonts/Gowardo.woff2') format('woff2');
            font-weight: normal;
            font-style: normal;
        }

        /* ===== متغیرهای تم ===== */
        :root {
            --primary-color: #ff3333;
            --primary-hover: #cc0000;
            --bg-color: #0f0f13;
            --glass-bg: rgba(25, 25, 30, 0.7);
            --glass-border: rgba(255, 255, 255, 0.08);
            --text-main: #ffffff;
            --text-muted: #a0a0a0;
            --input-bg: rgba(10, 10, 15, 0.6);
            --input-border: #333;
        }

        body.light-mode {
            --primary-color: #e60000;
            --primary-hover: #b30000;
            --bg-color: #f0f0f5;
            --glass-bg: rgba(255, 255, 255, 0.7);
            --glass-border: rgba(0, 0, 0, 0.1);
            --text-main: #222222;
            --text-muted: #555555;
            --input-bg: rgba(255, 255, 255, 0.8);
            --input-border: #ccc;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            cursor: none; /* پنهان کردن موس پیش‌فرض برای کاستوم کرسر */
        }

        html {
            scroll-behavior: smooth;
        }

        /* ===== اسکرول بار نرم و زیبا ===== */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: var(--bg-color); }
        ::-webkit-scrollbar-thumb { background: var(--primary-color); border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--primary-hover); }

        /* ===== انیمیشن موس (Custom Cursor) ===== */
        .cursor-dot {
            width: 8px; height: 8px;
            background-color: var(--primary-color);
            position: fixed; border-radius: 50%;
            pointer-events: none; z-index: 9999;
            transform: translate(-50%, -50%);
            transition: width 0.2s, height 0.2s;
        }
        .cursor-outline {
            width: 30px; height: 30px;
            border: 1.5px solid var(--primary-color);
            position: fixed; border-radius: 50%;
            pointer-events: none; z-index: 9998;
            transform: translate(-50%, -50%);
            transition: width 0.2s, height 0.2s, background-color 0.2s;
        }
        /* بزرگ شدن موس روی لینک‌ها */
        a:hover ~ .cursor-dot, button:hover ~ .cursor-dot { width: 12px; height: 12px; }
        a:hover ~ .cursor-outline, button:hover ~ .cursor-outline { width: 40px; height: 40px; background-color: rgba(255, 51, 51, 0.1); }

        body {
            font-family: 'Gowardo', Tahoma, sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
            transition: background-color 0.4s, color 0.4s;
        }

        /* ===== پس‌زمینه انیمیشنی ===== */
        .animated-bg {
            position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; z-index: -1; background: var(--bg-color); overflow: hidden;
        }
        .blob {
            position: absolute; border-radius: 50%; filter: blur(90px); opacity: 0.5; animation: moveBlobs 10s infinite alternate ease-in-out;
        }
        .blob-1 { width: 40vw; height: 40vw; background: var(--primary-color); top: -10%; right: -10%; }
        .blob-2 { width: 35vw; height: 35vw; background: #444; bottom: -20%; left: -10%; animation-duration: 12s; animation-direction: alternate-reverse; }
        @keyframes moveBlobs { 0% { transform: translate(0, 0) scale(1); } 100% { transform: translate(-50px, 50px) scale(1.1); } }

        /* ===== استایل شیشه‌ای ===== */
        .glass-panel {
            background: var(--glass-bg); backdrop-filter: blur(16px); border: 1px solid var(--glass-border); border-radius: 24px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2); transition: 0.4s;
        }

        /* ===== هدر و منوی همبرگری ===== */
        .header-wrapper { margin-top: 20px; padding: 0 15px; position: sticky; top: 20px; z-index: 100; }
        header { display: flex; justify-content: space-between; align-items: center; padding: 15px 30px; max-width: 1200px; margin: 0 auto; }
        
        .header-logo { display: flex; align-items: center; gap: 12px; font-size: 1.6rem; font-weight: bold; color: var(--text-main); text-decoration: none; }
        .header-logo img { width: 45px; height: 45px; object-fit: contain; }
        
        /* انیمیشن هاور هدر */
        .header-nav { display: flex; gap: 25px; align-items: center; }
        .header-nav a { color: var(--text-muted); text-decoration: none; font-size: 1.1rem; position: relative; padding-bottom: 5px; transition: 0.3s; }
        .header-nav a::after { content: ''; position: absolute; width: 0; height: 2px; bottom: 0; left: 50%; background-color: var(--primary-color); transition: 0.3s ease-out; transform: translateX(-50%); }
        .header-nav a:hover, .header-nav a.active { color: var(--text-main); }
        .header-nav a:hover::after, .header-nav a.active::after { width: 100%; box-shadow: 0 0 8px var(--primary-color); }

        .header-actions { display: flex; align-items: center; gap: 15px; }
        .theme-toggle { background: transparent; border: none; color: var(--text-main); display: flex; padding: 8px; border-radius: 50%; transition: 0.3s; }
        .theme-toggle:hover { background: rgba(255,255,255,0.1); }
        .theme-toggle svg { width: 22px; height: 22px; fill: currentColor; }
        .player-count { background: rgba(255, 51, 51, 0.15); border: 1px solid rgba(255, 51, 51, 0.3); color: var(--primary-color); padding: 8px 16px; border-radius: 30px; font-size: 0.9rem; display: flex; align-items: center; gap: 8px; }
        .player-count .dot { width: 8px; height: 8px; background: var(--primary-color); border-radius: 50%; box-shadow: 0 0 8px var(--primary-color); }

        /* همبرگر منو */
        .hamburger { display: none; flex-direction: column; gap: 5px; cursor: pointer; padding: 5px; z-index: 101; }
        .hamburger span { width: 25px; height: 3px; background-color: var(--text-main); border-radius: 3px; transition: 0.4s; }
        .hamburger.active span:nth-child(1) { transform: translateY(8px) rotate(45deg); background-color: var(--primary-color); }
        .hamburger.active span:nth-child(2) { opacity: 0; }
        .hamburger.active span:nth-child(3) { transform: translateY(-8px) rotate(-45deg); background-color: var(--primary-color); }

        /* منوی موبایل */
        .mobile-menu {
            position: absolute; top: 85px; left: 15px; right: 15px; background: var(--glass-bg); backdrop-filter: blur(20px); border: 1px solid var(--glass-border); border-radius: 20px;
            overflow: hidden; max-height: 0; opacity: 0; transition: all 0.5s ease-in-out; display: flex; flex-direction: column; text-align: center; box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }
        .mobile-menu.open { max-height: 400px; opacity: 1; padding: 20px 0; }
        .mobile-menu a { padding: 15px; color: var(--text-main); text-decoration: none; border-bottom: 1px solid rgba(255,255,255,0.05); }
        .mobile-menu a:last-child { border: none; }
        .mobile-menu a:hover { color: var(--primary-color); background: rgba(255,51,51,0.05); }

        /* ===== فرم احراز هویت ===== */
        .main-content { flex: 1; display: flex; justify-content: center; align-items: center; padding: 40px 15px; }
        .auth-card { width: 100%; max-width: 450px; padding: 35px 30px; overflow: hidden; }
        
        .auth-tabs { display: flex; border-bottom: 2px solid var(--input-border); margin-bottom: 30px; }
        .auth-tab { flex: 1; text-align: center; padding: 12px; color: var(--text-muted); transition: 0.3s; position: relative; }
        .auth-tab.active { color: var(--text-main); font-weight: bold; }
        .auth-tab.active::after { content: ''; position: absolute; bottom: -2px; left: 0; width: 100%; height: 2px; background: var(--primary-color); }

        /* انیمیشن سوییچ تب */
        .form-container { animation: fadeSwitch 0.4s ease-in-out; }
        @keyframes fadeSwitch { 0% { opacity: 0; transform: translateY(10px); } 100% { opacity: 1; transform: translateY(0); } }

        .form-group { margin-bottom: 20px; position: relative; }
        .form-group label { display: block; margin-bottom: 8px; font-size: 0.95rem; color: var(--text-muted); }
        .form-group input { width: 100%; padding: 12px 15px 12px 45px; background: var(--input-bg); border: 1px solid var(--input-border); color: var(--text-main); border-radius: 12px; outline: none; transition: 0.3s; }
        .form-group input:focus { border-color: var(--primary-color); box-shadow: 0 0 0 3px rgba(255, 51, 51, 0.1); }
        .input-icon { position: absolute; top: 40px; left: 15px; width: 20px; height: 20px; fill: var(--text-muted); }

        /* بررسی قدرت رمز عبور */
        .password-strength { height: 5px; background: var(--input-border); border-radius: 5px; margin-top: 10px; overflow: hidden; display: none; }
        .strength-bar { height: 100%; width: 0; transition: 0.4s; }
        .btn-gen { background: rgba(255,255,255,0.05); border: 1px solid var(--input-border); color: var(--text-muted); padding: 8px 12px; border-radius: 8px; font-size: 0.85rem; display: flex; align-items: center; gap: 8px; margin-top: 10px; transition: 0.3s; }
        .btn-gen:hover { border-color: var(--primary-color); color: var(--text-main); }
        .btn-gen svg { width: 16px; height: 16px; fill: currentColor; }

        .btn-main { width: 100%; padding: 14px; background: var(--primary-color); color: #fff; border: none; border-radius: 12px; font-size: 1.1rem; transition: 0.3s; margin-top: 10px; }
        .btn-main:hover { background: var(--primary-hover); box-shadow: 0 5px 15px rgba(255, 51, 51, 0.4); transform: translateY(-2px); }

        /* ===== فوتر ===== */
        .footer-wrapper { padding: 0 15px 30px 15px; }
        footer { max-width: 1200px; margin: 0 auto; padding: 40px; }
        .footer-title { color: var(--text-main); font-size: 1.3rem; margin-bottom: 20px; position: relative; padding-right: 15px; }
        .footer-title::before { content: ''; position: absolute; right: 0; top: 5px; height: 70%; width: 3px; background: var(--primary-color); border-radius: 2px; }
        .footer-links { list-style: none; }
        .footer-links li { margin-bottom: 12px; }
        .footer-links a { color: var(--text-muted); text-decoration: none; transition: 0.3s; display: flex; align-items: center; gap: 8px; }
        .footer-links a::before { content: '›'; color: var(--primary-color); font-size: 1.2rem; }
        .footer-links a:hover { color: var(--primary-color); transform: translateX(-5px); }

        /* ریسپانسیو */
        @media (max-width: 991px) {
            .header-nav { display: none; }
            .hamburger { display: flex; }
        }
        @media (max-width: 576px) {
            .header-logo span { display: none; } /* مخفی کردن متن لوگو در موبایل کوچک */
            .player-count { font-size: 0.8rem; padding: 6px 10px; }
        }
    </style>
</head>
<body>

    <!-- المان‌های موس سفارشی -->
    <div class="cursor-dot" id="cursor-dot"></div>
    <div class="cursor-outline" id="cursor-outline"></div>

    <div class="animated-bg">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
    </div>

    <!-- هدر -->
    <div class="header-wrapper">
          <header class="glass-panel">
        
        <!-- ۱. لوگو (سمت راست) -->
        <a href="#" class="header-logo">
              <img src="logo.png" alt="یونیورس نتورک" onerror="this.src='data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0iI2ZmMzMzMyI+PHBhdGggZD0iTTEyIDJMMiAxMmwxMCAxMCAxMC0xMEwxMiAyeiIvPjwvc3ZnPg==';">
            <span>یونیورس گیم</span>
          
        </a>

        <!-- ۲. منوی ناوبری (وسط) -->
        <nav class="header-nav">
            <a href="index.php">صفحه اصلی</a>
            <a href="rules.php">قوانین</a>
            <a href="blog.php">وبلاگ</a>
            <a href="auth.php" class="active">ورود / ثبت نام</a>
        </nav>

        <!-- ۳. پلیر آنلاین، لایت مود و منوی موبایل (سمت چپ) -->
        <div class="header-actions">
            <div class="player-count">
                <span class="dot"></span>
                1,402 آنلاین
            </div>
            
            <button class="theme-toggle" onclick="toggleTheme()" title="تغییر تم">
                <svg id="theme-icon" viewBox="0 0 24 24">
                    <path d="M12 3c-4.97 0-9 4.03-9 9s4.03 9 9 9 9-4.03 9-9c0-.46-.04-.92-.1-1.36-.98 1.37-2.58 2.26-4.4 2.26-3.03 0-5.5-2.47-5.5-5.5 0-1.82.89-3.42 2.26-4.4C12.92 3.04 12.46 3 12 3z"/>
                </svg>
            </button>

            <div class="hamburger" id="hamburger" onclick="toggleMobileMenu()">
                <span></span><span></span><span></span>
            </div>
        </div>

    </header>

        <!-- منوی موبایل (ریسپانسیو) -->
        <div class="mobile-menu" id="mobile-menu">
            <a href="index.php">صفحه اصلی</a>
            <a href="auth.php">شاپ</a>
            <a href="#">بلاگ</a>
            <a href="auth.php" style="color: var(--primary-color);">ورود / ثبت نام</a>
        </div>
    </div>

    <!-- فرم -->
    <main class="main-content">
        <div class="auth-card glass-panel">
            <?php if ($message): ?>
                <div style="padding: 10px; border-radius: 8px; margin-bottom: 20px; text-align: center; background: rgba(255,51,51,0.2); color: #ff6666; border: 1px solid var(--primary-color);">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>

            <div class="auth-tabs">
                <div class="auth-tab active" id="tab-login" onclick="switchTab('login')">ورود</div>
                <div class="auth-tab" id="tab-register" onclick="switchTab('register')">ثبت نام</div>
            </div>

            <div id="forms-wrapper">
                <!-- فرم ورود -->
                <form id="form-login" class="form-container" method="POST">
                    <input type="hidden" name="action" value="login">
                    <div class="form-group">
                        <label>نام کاربری</label>
                        <input type="text" name="username" required placeholder="نام کاربری خود را وارد کنید">
                    </div>
                    <div class="form-group">
                        <label>رمز عبور</label>
                        <input type="password" name="password" id="log-pass" required placeholder="رمز عبور خود را وارد کنید">
                        <svg class="input-icon" onclick="togglePass('log-pass')" viewBox="0 0 24 24"><path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/></svg>
                    </div>
                    <button type="submit" class="btn-main">ورود به پنل</button>
                </form>

                <!-- فرم ثبت نام -->
                <form id="form-register" class="form-container" method="POST" style="display: none;">
                    <input type="hidden" name="action" value="register">
                    <div class="form-group">
                        <label>نام کاربری</label>
                        <input type="text" name="username" required placeholder="مثال: Player123">
                    </div>
                    <div class="form-group">
                        <label>رمز عبور</label>
                        <input type="password" name="password" id="reg-pass" required placeholder="رمز عبور قوی وارد کنید">
                        <svg class="input-icon" onclick="togglePass('reg-pass')" viewBox="0 0 24 24"><path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/></svg>
                        
                        <div class="password-strength" id="strength-container">
                            <div class="strength-bar" id="strength-bar"></div>
                        </div>
                        <button type="button" class="btn-gen" onclick="generatePass()">
                            <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm5 11h-4v4h-2v-4H7v-2h4V7h2v4h4v2z"/></svg>
                            پیشنهاد رمز قوی
                        </button>
                    </div>
                    <div class="form-group">
                        <label>تکرار رمز عبور</label>
                        <input type="password" name="confirm_password" required placeholder="رمز عبور را دوباره وارد کنید">
                    </div>
                    <button type="submit" class="btn-main">ثبت نام در سایت</button>
                </form>
            </div>
        </div>
    </main>

    <!-- فوتر -->
    <div class="footer-wrapper">
        <footer class="glass-panel">
            <div class="row">
                <div class="col-lg-4 col-md-12 mb-4">
                    <a href="#" class="header-logo" style="margin-bottom: 15px;">
                        <span>یونیورس گیم</span>
                        <img src="logo.png" alt="لوگو" style="width: 35px; height: 35px;" onerror="this.src='data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0iI2ZmMzMzMyI+PHBhdGggZD0iTTEyIDJMMiAxMmwxMCAxMCAxMC0xMEwxMiAyeiIvPjwvc3ZnPg==';">
                    </a>
                    <p style="color: var(--text-muted); line-height: 1.8; font-size: 0.95rem;">
                        ما صرفا یک سرور بازی نیستیم، بلکه یک خانواده بزرگ کیهانی از گیمرهای ایرانی هستیم. با ارائه پایین‌ترین پینگ ممکن و بالاترین سطح امنیت، تضمین می‌کنیم بهترین تجربه ماینکرافت را داشته باشید.
                    </p>
                </div>
                <div class="col-lg-3 col-md-4 mb-4">
                    <h3 class="footer-title">لینک‌های سریع</h3>
                    <ul class="footer-links">
                        <li><a href="#">صفحه اصلی سرور</a></li>
                        <li><a href="#">معرفی گیم‌مودها</a></li>
                        <li><a href="#">فروشگاه رنک و آیتم</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4 mb-4">
                    <h3 class="footer-title">پشتیبانی</h3>
                    <ul class="footer-links">
                        <li><a href="#">ارسال تیکت</a></li>
                        <li><a href="#">آموزش ورود</a></li>
                        <li><a href="#">گزارش باگ</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-4 mb-4">
                    <h3 class="footer-title">وضعیت سرور</h3>
                    <div style="background: rgba(0,0,0,0.2); padding: 15px; border-radius: 12px; font-size:0.9rem;">
                        <p style="margin-bottom:8px; color: var(--text-muted);">وضعیت: <span style="float:left; color:#4caf50;">آنلاین</span></p>
                        <p style="margin-bottom:8px; color: var(--text-muted);">بازیکنان: <span style="float:left; color:white;">1,402</span></p>
                        <p style="color: var(--text-muted);">پینگ: <span style="float:left; color:#ff3333;">12ms</span></p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script>
        // Custom Cursor
        const cursorDot = document.getElementById('cursor-dot');
        const cursorOutline = document.getElementById('cursor-outline');
        window.addEventListener('mousemove', function(e) {
            cursorDot.style.left = e.clientX + 'px';
            cursorDot.style.top = e.clientY + 'px';
            cursorOutline.style.left = e.clientX + 'px';
            cursorOutline.style.top = e.clientY + 'px';
        });

        // Hamburger Menu
        function toggleMobileMenu() {
            document.getElementById('hamburger').classList.toggle('active');
            document.getElementById('mobile-menu').classList.toggle('open');
        }

        // انیمیشن سوییچ فرم
        function switchTab(tab) {
            const loginForm = document.getElementById('form-login');
            const regForm = document.getElementById('form-register');
            
            // ریست انیمیشن
            loginForm.style.animation = 'none'; regForm.style.animation = 'none';
            loginForm.offsetHeight; regForm.offsetHeight; // trigger reflow
            
            if(tab === 'login') {
                loginForm.style.display = 'block'; regForm.style.display = 'none';
                loginForm.style.animation = 'fadeSwitch 0.4s ease-in-out';
            } else {
                loginForm.style.display = 'none'; regForm.style.display = 'block';
                regForm.style.animation = 'fadeSwitch 0.4s ease-in-out';
            }
            document.getElementById('tab-login').classList.toggle('active', tab === 'login');
            document.getElementById('tab-register').classList.toggle('active', tab === 'register');
        }

        // مشاهده رمز
        function togglePass(id) {
            const el = document.getElementById(id);
            el.type = el.type === 'password' ? 'text' : 'password';
        }

        // بررسی قدرت رمز
        const regPass = document.getElementById('reg-pass');
        const sCont = document.getElementById('strength-container');
        const sBar = document.getElementById('strength-bar');

        regPass.addEventListener('input', function() {
            let val = regPass.value;
            if(!val) { sCont.style.display = 'none'; return; }
            sCont.style.display = 'block';
            let score = 0;
            if(val.length > 7) score++;
            if(/[A-Z]/.test(val)) score++;
            if(/[0-9]/.test(val)) score++;
            if(/[^A-Za-z0-9]/.test(val)) score++;

            sBar.style.width = (score * 25) + '%';
            if(score <= 1) sBar.style.background = '#ff3333';
            else if(score === 2) sBar.style.background = '#ff9800';
            else if(score === 3) sBar.style.background = '#ffeb3b';
            else sBar.style.background = '#4caf50';
        });

        // ساخت رمز قوی
        function generatePass() {
            const chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*";
            let p = "";
            for(let i=0; i<12; i++) p += chars.charAt(Math.floor(Math.random() * chars.length));
            regPass.value = p;
            regPass.type = 'text'; // نمایش موقت رمز ساخته شده
            regPass.dispatchEvent(new Event('input')); // اعمال قدرت رمز
            setTimeout(() => { regPass.type = 'password'; }, 3000); // مخفی کردن بعد 3 ثانیه
        }

        // دارک/لایت مود
        function toggleTheme() {
            document.body.classList.toggle('light-mode');
        }
    </script>
</body>
</html>
