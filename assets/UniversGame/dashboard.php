<?php
session_start();

// اگر کاربر لاگین نیست، به صفحه لاگین هدایت شود
// if (!isset($_SESSION['user_id'])) {
//     header("Location: index.php");
//     exit;
// }

// متغیرهای نمایشی برای تست
$username = $_SESSION['username'] ?? 'کاربر تستی';
$user_id = $_SESSION['user_id'] ?? '102938';
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پنل کاربری | یونیورس نتورک</title>
    
    <!-- Meta Tags (SEO & Security) -->
    <meta name="description" content="پنل کاربری سرور ماینکرافت یونیورس نتورک">
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

        * { box-sizing: border-box; margin: 0; padding: 0; cursor: none; }
        html { scroll-behavior: smooth; }

        /* ===== اسکرول بار ===== */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: var(--bg-color); }
        ::-webkit-scrollbar-thumb { background: var(--primary-color); border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--primary-hover); }

        /* ===== انیمیشن موس ===== */
        .cursor-dot {
            width: 8px; height: 8px; background-color: var(--primary-color); position: fixed; border-radius: 50%;
            pointer-events: none; z-index: 9999; transform: translate(-50%, -50%); transition: width 0.2s, height 0.2s;
        }
        .cursor-outline {
            width: 30px; height: 30px; border: 1.5px solid var(--primary-color); position: fixed; border-radius: 50%;
            pointer-events: none; z-index: 9998; transform: translate(-50%, -50%); transition: width 0.2s, height 0.2s, background-color 0.2s;
        }
        a:hover ~ .cursor-dot, button:hover ~ .cursor-dot, .sidebar-menu a:hover ~ .cursor-dot { width: 12px; height: 12px; }
        a:hover ~ .cursor-outline, button:hover ~ .cursor-outline, .sidebar-menu a:hover ~ .cursor-outline { width: 40px; height: 40px; background-color: rgba(255, 51, 51, 0.1); }

        body {
            font-family: 'Gowardo', Tahoma, sans-serif; background-color: var(--bg-color); color: var(--text-main);
            min-height: 100vh; display: flex; flex-direction: column; overflow-x: hidden; transition: 0.4s;
        }

        /* ===== پس‌زمینه انیمیشنی ===== */
        .animated-bg { position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; z-index: -1; background: var(--bg-color); overflow: hidden; }
        .blob { position: absolute; border-radius: 50%; filter: blur(90px); opacity: 0.5; animation: moveBlobs 10s infinite alternate ease-in-out; }
        .blob-1 { width: 40vw; height: 40vw; background: var(--primary-color); top: -10%; right: -10%; }
        .blob-2 { width: 35vw; height: 35vw; background: #444; bottom: -20%; left: -10%; animation-duration: 12s; animation-direction: alternate-reverse; }
        @keyframes moveBlobs { 0% { transform: translate(0, 0) scale(1); } 100% { transform: translate(-50px, 50px) scale(1.1); } }

        /* ===== استایل شیشه‌ای ===== */
        .glass-panel { background: var(--glass-bg); backdrop-filter: blur(16px); border: 1px solid var(--glass-border); border-radius: 24px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2); transition: 0.4s; }

        /* ===== هدر ===== */
        .header-wrapper { margin-top: 20px; padding: 0 15px; position: sticky; top: 20px; z-index: 100; }
        header { display: flex; justify-content: space-between; align-items: center; padding: 15px 30px; max-width: 1400px; margin: 0 auto; }
        .header-logo { display: flex; align-items: center; gap: 12px; font-size: 1.6rem; font-weight: bold; color: var(--text-main); text-decoration: none; }
        .header-logo img { width: 45px; height: 45px; object-fit: contain; }
        .header-nav { display: flex; gap: 25px; align-items: center; }
        .header-nav a { color: var(--text-muted); text-decoration: none; font-size: 1.1rem; position: relative; padding-bottom: 5px; transition: 0.3s; }
        .header-nav a::after { content: ''; position: absolute; width: 0; height: 2px; bottom: 0; left: 50%; background-color: var(--primary-color); transition: 0.3s; transform: translateX(-50%); }
        .header-nav a:hover, .header-nav a.active { color: var(--text-main); }
        .header-nav a:hover::after, .header-nav a.active::after { width: 100%; box-shadow: 0 0 8px var(--primary-color); }
        .header-actions { display: flex; align-items: center; gap: 15px; }
        .theme-toggle { background: transparent; border: none; color: var(--text-main); display: flex; padding: 8px; border-radius: 50%; transition: 0.3s; }
        .theme-toggle:hover { background: rgba(255,255,255,0.1); }
        .theme-toggle svg { width: 22px; height: 22px; fill: currentColor; }
        .player-count { background: rgba(255, 51, 51, 0.15); border: 1px solid rgba(255, 51, 51, 0.3); color: var(--primary-color); padding: 8px 16px; border-radius: 30px; font-size: 0.9rem; display: flex; align-items: center; gap: 8px; }
        .player-count .dot { width: 8px; height: 8px; background: var(--primary-color); border-radius: 50%; box-shadow: 0 0 8px var(--primary-color); }

        .hamburger { display: none; flex-direction: column; gap: 5px; padding: 5px; z-index: 101; }
        .hamburger span { width: 25px; height: 3px; background-color: var(--text-main); border-radius: 3px; transition: 0.4s; }
        .hamburger.active span:nth-child(1) { transform: translateY(8px) rotate(45deg); background-color: var(--primary-color); }
        .hamburger.active span:nth-child(2) { opacity: 0; }
        .hamburger.active span:nth-child(3) { transform: translateY(-8px) rotate(-45deg); background-color: var(--primary-color); }
        .mobile-menu { position: absolute; top: 85px; left: 15px; right: 15px; background: var(--glass-bg); backdrop-filter: blur(20px); border: 1px solid var(--glass-border); border-radius: 20px; overflow: hidden; max-height: 0; opacity: 0; transition: 0.5s; display: flex; flex-direction: column; text-align: center; }
        .mobile-menu.open { max-height: 400px; opacity: 1; padding: 20px 0; }
        .mobile-menu a { padding: 15px; color: var(--text-main); text-decoration: none; border-bottom: 1px solid rgba(255,255,255,0.05); }

        /* ===== داشبورد ===== */
        .dashboard-container { display: flex; flex: 1; max-width: 1400px; margin: 30px auto; width: 100%; padding: 0 15px; gap: 20px; }
        
        .sidebar { width: 280px; padding: 20px 0; display: flex; flex-direction: column; flex-shrink: 0; }
        .sidebar-menu { list-style: none; flex: 1; }
        .sidebar-menu a { display: flex; align-items: center; gap: 15px; padding: 15px 25px; color: var(--text-muted); text-decoration: none; transition: 0.3s; border-right: 3px solid transparent; font-size: 1.05rem; }
        .sidebar-menu a svg { width: 22px; height: 22px; fill: currentColor; }
        .sidebar-menu a:hover, .sidebar-menu a.active { background: rgba(255, 51, 51, 0.1); color: var(--text-main); border-right-color: var(--primary-color); }
        .sidebar-menu a.active svg { fill: var(--primary-color); }
        .logout-btn { margin-top: auto; padding: 15px 25px; color: #ff4d4d; text-decoration: none; display: flex; align-items: center; gap: 10px; transition: 0.3s; }
        .logout-btn:hover { background: rgba(255, 77, 77, 0.1); }

        .content-area { flex: 1; padding: 35px; min-width: 0; }
        .tab-content { display: none; animation: fadeSwitch 0.4s ease-in-out; }
        .tab-content.active { display: block; }
        @keyframes fadeSwitch { 0% { opacity: 0; transform: translateY(10px); } 100% { opacity: 1; transform: translateY(0); } }

        /* کامپوننت‌های داشبورد */
        .user-banner { background: linear-gradient(90deg, rgba(255,51,51,0.15) 0%, transparent 100%); border: 1px solid var(--glass-border); border-radius: 16px; padding: 30px 20px 30px 30px; display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; position: relative; }
        .user-info-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; flex: 1; }
        .info-label { font-size: 0.85rem; color: var(--text-muted); display: block; margin-bottom: 5px; }
        .info-value { font-size: 1.1rem; font-weight: bold; color: var(--text-main); }
        
        .user-avatar-box { position: absolute; left: -25px; top: -20px; background: var(--bg-color); padding: 8px; border-radius: 16px; border: 2px solid var(--primary-color); box-shadow: 0 10px 20px rgba(0,0,0,0.4); }
        .user-avatar-box img { width: 80px; height: 80px; border-radius: 10px; }

        .box-panel { background: rgba(0,0,0,0.2); border: 1px solid var(--glass-border); border-radius: 16px; padding: 25px; margin-bottom: 25px; }
        .box-title { font-size: 1.2rem; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 1px solid var(--glass-border); color: var(--primary-color); }

        .mock-chart { height: 200px; border-bottom: 1px solid var(--glass-border); border-left: 1px solid var(--glass-border); display: flex; align-items: flex-end; padding-left: 10px; gap: 2%; }
        .chart-bar { width: 8%; background: rgba(255, 51, 51, 0.4); border-top: 2px solid var(--primary-color); transition: 0.3s; border-radius: 4px 4px 0 0; }
        .chart-bar:hover { background: rgba(255, 51, 51, 0.8); height: 100% !important; }

        .empty-state { text-align: center; color: var(--text-muted); padding: 40px 0; }

        /* فرم‌ها */
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-size: 0.95rem; color: var(--text-muted); }
        .form-group input, .form-group textarea { width: 100%; padding: 12px 15px; background: var(--input-bg); border: 1px solid var(--input-border); color: var(--text-main); border-radius: 12px; outline: none; transition: 0.3s; font-family: inherit; }
        .form-group input:focus, .form-group textarea:focus { border-color: var(--primary-color); box-shadow: 0 0 0 3px rgba(255, 51, 51, 0.1); }
        
        .btn-main { padding: 12px 25px; background: var(--primary-color); color: #fff; border: none; border-radius: 12px; font-size: 1rem; transition: 0.3s; font-family: inherit; }
        .btn-main:hover { background: var(--primary-hover); box-shadow: 0 5px 15px rgba(255, 51, 51, 0.4); transform: translateY(-2px); }

        /* ===== فوتر ===== */
        .footer-wrapper { padding: 0 15px 30px 15px; margin-top: auto; }
        footer { max-width: 1400px; margin: 0 auto; padding: 40px; }
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
            .dashboard-container { flex-direction: column; }
            .sidebar { width: 100%; flex-direction: row; overflow-x: auto; padding: 10px; }
            .sidebar-menu { display: flex; flex-direction: row; }
            .sidebar-menu a { padding: 10px 15px; border-right: none; border-bottom: 3px solid transparent; white-space: nowrap; }
            .sidebar-menu a:hover, .sidebar-menu a.active { border-right-color: transparent; border-bottom-color: var(--primary-color); }
            .user-info-grid { grid-template-columns: repeat(2, 1fr); gap: 15px; }
            .logout-btn { margin-top: 0; white-space: nowrap; }
        }
        @media (max-width: 576px) {
            .header-logo span { display: none; }
            .user-banner { padding: 20px; flex-direction: column; align-items: flex-start; margin-top: 40px; }
            .user-avatar-box { top: -50px; left: 20px; }
            .user-info-grid { grid-template-columns: 1fr; width: 100%; margin-top: 20px; }
        }
    </style>
</head>
<body>

    <!-- المان‌های موس -->
    <div class="cursor-dot" id="cursor-dot"></div>
    <div class="cursor-outline" id="cursor-outline"></div>

    <div class="animated-bg">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
    </div>

    <!-- هدر -->
    <div class="header-wrapper">
        <header class="glass-panel">
            <div class="header-actions">
                <div class="hamburger" id="hamburger" onclick="toggleMobileMenu()">
                    <span></span><span></span><span></span>
                </div>
                <div class="player-count">
                    <span class="dot"></span>
                    1,402 آنلاین
                </div>
                <button class="theme-toggle" onclick="toggleTheme()" title="تغییر تم">
                    <svg viewBox="0 0 24 24"><path d="M12 3c-4.97 0-9 4.03-9 9s4.03 9 9 9 9-4.03 9-9c0-.46-.04-.92-.1-1.36-.98 1.37-2.58 2.26-4.4 2.26-3.03 0-5.5-2.47-5.5-5.5 0-1.82.89-3.42 2.26-4.4C12.92 3.04 12.46 3 12 3z"/></svg>
                </button>
            </div>

            <nav class="header-nav">
                <a href="index.php">صفحه اصلی</a>
                <a href="#">شاپ</a>
                <a href="#">بلاگ</a>
                <a href="#" class="active">پنل کاربری</a>
            </nav>

            <a href="index.php" class="header-logo">
                <span>یونیورس</span>
                <img src="logo.png" alt="یونیورس نتورک" onerror="this.src='data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0iI2ZmMzMzMyI+PHBhdGggZD0iTTEyIDJMMiAxMmwxMCAxMCAxMC0xMEwxMiAyeiIvPjwvc3ZnPg==';">
            </a>
        </header>

        <!-- منوی موبایل -->
        <div class="mobile-menu" id="mobile-menu">
            <a href="index.php">صفحه اصلی</a>
            <a href="#">شاپ</a>
            <a href="#">بلاگ</a>
            <a href="#" style="color: var(--primary-color);">پنل کاربری</a>
        </div>
    </div>

    <!-- ساختار داشبورد -->
    <div class="dashboard-container">

        <!-- سایدبار -->
        <aside class="sidebar glass-panel">
            <ul class="sidebar-menu">
                <li><a href="#" onclick="openTab(event, 'tab-dashboard')" class="active">
                    <svg viewBox="0 0 24 24"><path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/></svg>
                    داشبورد
                </a></li>
                <li><a href="#" onclick="openTab(event, 'tab-shop')">
                    <svg viewBox="0 0 24 24"><path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"/></svg>
                    فروشگاه
                </a></li>
                <li><a href="#" onclick="openTab(event, 'tab-support')">
                    <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
                    پشتیبانی و تیکت
                </a></li>
                <li><a href="#" onclick="openTab(event, 'tab-blog')">
                    <svg viewBox="0 0 24 24"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>
                    وبلاگ
                </a></li>
                <li><a href="#" onclick="openTab(event, 'tab-settings')">
                    <svg viewBox="0 0 24 24"><path d="M19.14,12.94c0.04-0.3,0.06-0.61,0.06-0.94c0-0.32-0.02-0.64-0.06-0.94l2.03-1.58c0.18-0.14,0.23-0.41,0.12-0.61 l-1.92-3.32c-0.12-0.22-0.37-0.29-0.59-0.22l-2.39,0.96c-0.5-0.38-1.03-0.7-1.62-0.94L14.4,2.81c-0.04-0.24-0.24-0.41-0.48-0.41 h-3.84c-0.24,0-0.43,0.17-0.47,0.41L9.25,5.35C8.66,5.59,8.12,5.92,7.63,6.29L5.24,5.33c-0.22-0.08-0.47,0-0.59,0.22L2.73,8.87 C2.62,9.08,2.66,9.34,2.86,9.48l2.03,1.58C4.84,11.36,4.8,11.69,4.8,12s0.02,0.64,0.06,0.94l-2.03,1.58 c-0.18,0.14-0.23,0.41-0.12,0.61l1.92,3.32c0.12,0.22,0.37,0.29,0.59,0.22l2.39-0.96c0.5,0.38,1.03,0.7,1.62,0.94l0.36,2.54 c0.05,0.24,0.24,0.41,0.48,0.41h3.84c0.24,0,0.43-0.17,0.47-0.41l0.36-2.54c0.59-0.24,1.13-0.56,1.62-0.94l2.39,0.96 c0.22,0.08,0.47,0,0.59-0.22l1.92-3.32c0.12-0.22,0.07-0.49-0.12-0.61L19.14,12.94z M12,15.6c-1.98,0-3.6-1.62-3.6-3.6 s1.62-3.6,3.6-3.6s3.6,1.62,3.6,3.6S13.98,15.6,12,15.6z"/></svg>
                    تنظیمات
                </a></li>
            </ul>
            <a href="logout.php" class="logout-btn">
                <svg viewBox="0 0 24 24"><path d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z"/></svg>
                خروج از حساب
            </a>
        </aside>

        <!-- محتوای متغیر سمت چپ -->
        <main class="content-area glass-panel">

            <!-- تب داشبورد -->
            <div id="tab-dashboard" class="tab-content active">
                <div class="user-banner">
                    <div class="user-info-grid">
                        <div>
                            <span class="info-label">کاربر <?php echo htmlspecialchars($user_id); ?></span>
                            <span class="info-value" style="color: var(--primary-color);"><?php echo htmlspecialchars($username); ?></span>
                        </div>
                        <div>
                            <span class="info-label">تاریخ انقضای رنک</span>
                            <span class="info-value">مادام‌العمر</span>
                        </div>
                        <div>
                            <span class="info-label">آخرین ورود</span>
                            <span class="info-value">امروز</span>
                        </div>
                        <div>
                            <span class="info-label">تاریخ ثبت نام</span>
                            <span class="info-value">فروردین 1405</span>
                        </div>
                    </div>

                    <div class="user-avatar-box">
                        <img src="https://minotar.net/helm/<?php echo htmlspecialchars($username); ?>/100.png"
                             alt="Avatar"
                             onerror="this.src='data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAiIGhlaWdodD0iMTAwIj48cmVjdCB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgZmlsbD0iIzU1NSIvPjwvc3ZnPg=='">
                    </div>
                </div>

                <div class="box-panel">
                    <div class="box-title">سابقه بازی (۳۰ روز گذشته)</div>
                    <div class="mock-chart">
                        <div class="chart-bar" style="height: 20%;"></div>
                        <div class="chart-bar" style="height: 50%;"></div>
                        <div class="chart-bar" style="height: 30%;"></div>
                        <div class="chart-bar" style="height: 80%;"></div>
                        <div class="chart-bar" style="height: 10%;"></div>
                        <div class="chart-bar" style="height: 60%;"></div>
                        <div class="chart-bar" style="height: 40%;"></div>
                        <div class="chart-bar" style="height: 90%;"></div>
                        <div class="chart-bar" style="height: 70%;"></div>
                        <div class="chart-bar" style="height: 100%;"></div>
                    </div>
                </div>

                <div class="box-panel">
                    <div class="box-title">مجازات‌های شما</div>
                    <div class="empty-state">
                        <svg width="50" height="50" fill="var(--text-muted)" viewBox="0 0 24 24" style="margin-bottom:15px;">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zM4 12c0-4.42 3.58-8 8-8 1.85 0 3.55.63 4.9 1.69L5.69 16.9C4.63 15.55 4 13.85 4 12zm8 8c-1.85 0-3.55-.63-4.9-1.69L18.31 7.1C19.37 8.45 20 10.15 20 12c0 4.42-3.58 8-8 8z"/>
                        </svg>
                        <p>هیچ مجازاتی ثبت نشده است. شما بازیکن نمونه‌ای هستید!</p>
                    </div>
                </div>
            </div>

            <!-- تب فروشگاه -->
            <div id="tab-shop" class="tab-content">
                <h2 style="margin-bottom: 10px;">فروشگاه سرور</h2>
                <p style="color: var(--text-muted); margin-bottom: 25px;">رنک‌ها و آیتم‌های ویژه سرور را با تخفیف خریداری کنید.</p>
                <div style="display: flex; flex-wrap: wrap; gap: 20px;">
                    <div class="box-panel" style="flex: 1 1 250px; text-align: center;">
                        <h3 style="margin-bottom: 20px;">رنک VIP</h3>
                        <button class="btn-main">مشاهده و خرید</button>
                    </div>
                    <div class="box-panel" style="flex: 1 1 250px; text-align: center;">
                        <h3 style="margin-bottom: 20px;">آیتم‌های ویژه</h3>
                        <button class="btn-main">مشاهده و خرید</button>
                    </div>
                </div>
            </div>

            <!-- تب پشتیبانی -->
            <div id="tab-support" class="tab-content">
                <h2 style="margin-bottom: 25px;">پشتیبانی و تیکت</h2>
                <div class="box-panel">
                    <div class="box-title">ارسال تیکت جدید</div>
                    <div class="form-group">
                        <label>موضوع تیکت</label>
                        <input type="text" placeholder="مثلاً: مشکل در لاگین">
                    </div>
                    <div class="form-group">
                        <label>توضیحات کامل</label>
                        <textarea rows="5" placeholder="مشکل خود را توضیح دهید..."></textarea>
                    </div>
                    <button class="btn-main">ارسال تیکت</button>
                </div>
            </div>

            <!-- تب وبلاگ -->
            <div id="tab-blog" class="tab-content">
                <h2 style="margin-bottom: 25px;">آخرین اخبار سرور</h2>
                <div class="empty-state">
                    در حال حاضر خبری برای نمایش وجود ندارد.
                </div>
            </div>

            <!-- تب تنظیمات -->
            <div id="tab-settings" class="tab-content">
                <h2 style="margin-bottom: 25px;">تنظیمات اکانت</h2>
                <div class="box-panel">
                    <div class="box-title">لینک کردن اکانت داخل بازی</div>
                    <div class="form-group">
                        <label>نام کاربری ماینکرافت (IGN)</label>
                        <input type="text" placeholder="مثلاً: Player123">
                    </div>
                    <button class="btn-main">درخواست لینک</button>
                </div>

                <div class="box-panel">
                    <div class="box-title">تغییر رمز عبور سایت</div>
                    <div class="form-group">
                        <input type="password" placeholder="رمز عبور فعلی">
                    </div>
                    <div class="form-group">
                        <input type="password" placeholder="رمز عبور جدید">
                    </div>
                    <div class="form-group">
                        <input type="password" placeholder="تکرار رمز جدید">
                    </div>
                    <button class="btn-main">ذخیره رمز جدید</button>
                </div>
            </div>

        </main>
    </div>

    <!-- فوتر -->
    <div class="footer-wrapper">
        <footer class="glass-panel">
            <div class="row">
                <div class="col-lg-4 col-md-12 mb-4">
                    <a href="#" class="header-logo" style="margin-bottom: 15px;">
                        <span>یونیورس نتورک</span>
                        <img src="logo.png" alt="لوگو" style="width: 35px; height: 35px;" onerror="this.src='data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0iI2ZmMzMzMyI+PHBhdGggZD0iTTEyIDJMMiAxMmwxMCAxMCAxMC0xMEwxMiAyeiIvPjwvc3ZnPg==';">
                    </a>
                    <p style="color: var(--text-muted); line-height: 1.8; font-size: 0.95rem;">
                        ما صرفا یک سرور بازی نیستیم، بلکه یک خانواده بزرگ کیهانی از گیمرهای ایرانی هستیم. با ارائه پایین‌ترین پینگ ممکن و بالاترین سطح امنیت.
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
                        <p style="color: var(--text-muted);">پینگ: <span style="float:left; color:var(--primary-color);">12ms</span></p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script>
        // کاستوم کرسر
        const cursorDot = document.getElementById('cursor-dot');
        const cursorOutline = document.getElementById('cursor-outline');
        window.addEventListener('mousemove', function(e) {
            cursorDot.style.left = e.clientX + 'px'; cursorDot.style.top = e.clientY + 'px';
            cursorOutline.style.left = e.clientX + 'px'; cursorOutline.style.top = e.clientY + 'px';
        });

        // همبرگر منو
        function toggleMobileMenu() {
            document.getElementById('hamburger').classList.toggle('active');
            document.getElementById('mobile-menu').classList.toggle('open');
        }

        // تغییر تم لایت و دارک
        function toggleTheme() {
            document.body.classList.toggle('light-mode');
        }

        // سوئیچ تب‌های داشبورد
        function openTab(event, tabId) {
            event.preventDefault();
            
            // مخفی کردن تمام محتواها
            document.querySelectorAll('.tab-content').forEach(function (el) {
                el.classList.remove('active');
                // ریست انیمیشن
                el.style.animation = 'none';
                el.offsetHeight; 
            });

            // غیرفعال کردن تمامی لینک‌های منو
            document.querySelectorAll('.sidebar-menu a').forEach(function (el) {
                el.classList.remove('active');
            });

            // نمایش تب انتخاب شده و اعمال انیمیشن
            const activeTab = document.getElementById(tabId);
            activeTab.classList.add('active');
            activeTab.style.animation = 'fadeSwitch 0.4s ease-in-out';
            event.currentTarget.classList.add('active');
        }
    </script>
</body>
</html>
