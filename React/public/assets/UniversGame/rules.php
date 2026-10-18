<?php ?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>یونیورس نتورک | ورود و ثبت نام</title>
    <meta name="description" content="سرور ماینکرافت یونیورس نتورک - بهترین تجربه بازی ماینکرافت با پایین‌ترین پینگ در ایران. ورود و ثبت نام.">
    <meta name="keywords" content="ماینکرافت, سرور ماینکرافت, یونیورس نتورک, بازی آنلاین, ماینکرفت ایران">
    <meta name="author" content="Universe Network">
    <meta http-equiv="X-Content-Type-Options" content="nosniff">
    <meta http-equiv="X-Frame-Options" content="DENY">
    <meta http-equiv="X-XSS-Protection" content="1; mode=block">
    <link rel="icon" href="logo.png" type="image/png">

<title>قوانین | Universe Game</title>

<style>
/* ---------------- FONT ---------------- */
@font-face {
    font-family: 'MyFont';
    src: url('fonts/Gowardo.woff2') format('woff2'); /* مسیر فونت خود را تنظیم کنید */
    font-weight: normal;
    font-style: normal;
}

:root {
    /* تم تاریک (طوسی و قرمز) */
    --bg: #151518;
    --bg2: #1e1e24;
    --card: rgba(255, 255, 255, 0.04);
    --card-hover: rgba(255, 255, 255, 0.08);
    --text: #f0f0f5;
    --muted: #9aa0a6;
    --accent: #ff3344;
    --accent-glow: rgba(255, 51, 68, 0.2);
    --border: rgba(255, 255, 255, 0.08);
    --glass: rgba(21, 21, 24, 0.65);
    --glass2: rgba(30, 30, 36, 0.95);
}

/* تم روشن */
body.light-mode {
    --bg: #f5f5f7;
    --bg2: #e4e4e9;
    --card: rgba(0, 0, 0, 0.04);
    --card-hover: rgba(0, 0, 0, 0.08);
    --text: #1a1a1f;
    --muted: #5f6368;
    --border: rgba(0, 0, 0, 0.12);
    --glass: rgba(245, 245, 247, 0.7);
    --glass2: rgba(228, 228, 233, 0.95);
}

* {
    box-sizing: border-box;
}

body {
    margin: 0;
    font-family: 'MyFont', Tahoma, sans-serif;
    /* بک گراند گیمینگ جذاب */
    background-color: var(--bg);
    background-image: 
        radial-gradient(circle at 15% 0%, var(--accent-glow) 0%, transparent 40%),
        radial-gradient(circle at 85% 100%, rgba(120, 120, 130, 0.1) 0%, transparent 40%),
        linear-gradient(145deg, var(--bg) 0%, var(--bg2) 100%);
    background-attachment: fixed;
    color: var(--text);
    overflow-x: hidden;
    transition: background 0.4s ease, color 0.4s ease;
}

/* ---------------- HEADER ---------------- */
header {
    position: sticky;
    top: 0;
    z-index: 9999;
    width: 100%;
    transition: all .35s ease;
}

.header-inner {
    max-width: 1300px;
    margin: 16px auto 0;
    padding: 12px 22px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    background: var(--glass);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border: 1px solid var(--border);
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,.15);
    transition: all .35s ease;
}

header.scrolled .header-inner {
    max-width: 100%;
    margin: 0;
    border-radius: 0;
    background: var(--glass2);
    border-left: none;
    border-right: none;
    border-top: none;
}

/* بخش راست: لوگو */
.logo {
    display: flex;
    align-items: center;
    gap: 12px;
    font-weight: 800;
    font-size: 18px;
    white-space: nowrap;
    color: var(--text);
}

.logo img {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    object-fit: cover;
    box-shadow: 0 4px 12px rgba(0,0,0,.2);
}

/* بخش وسط: منو */
.nav {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 30px;
    flex: 1;
}

.nav a {
    position: relative;
    text-decoration: none;
    color: var(--muted);
    font-weight: 600;
    font-size: 16px;
    transition: .25s;
}

.nav a:hover {
    color: var(--accent);
}

.nav a::after {
    content: "";
    position: absolute;
    right: 0;
    bottom: -6px;
    width: 0;
    height: 2px;
    border-radius: 2px;
    background: var(--accent);
    transition: .3s;
}

.nav a:hover::after {
    width: 100%;
}

/* بخش چپ: بازیکنان و دکمه ها */
.header-left {
    display: flex;
    align-items: center;
    gap: 12px;
}

.online-box {
    display: flex;
    align-items: center;
    gap: 8px;
    white-space: nowrap;
    font-size: 14px;
    color: var(--accent);
    padding: 8px 14px;
    border-radius: 12px;
    background: var(--accent-glow);
    border: 1px solid rgba(255, 51, 68, 0.3);
}

.online-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: var(--accent);
    box-shadow: 0 0 8px var(--accent);
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { box-shadow: 0 0 0 0 rgba(255, 51, 68, 0.7); }
    70% { box-shadow: 0 0 0 6px rgba(255, 51, 68, 0); }
    100% { box-shadow: 0 0 0 0 rgba(255, 51, 68, 0); }
}

.theme-toggle, .hamburger {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 12px;
    border: 1px solid var(--border);
    background: var(--card);
    color: var(--text);
    cursor: pointer;
    font-size: 18px;
    transition: .25s;
}

.theme-toggle:hover, .hamburger:hover {
    border-color: var(--accent);
    color: var(--accent);
    background: var(--card-hover);
}

.hamburger {
    display: none;
    font-size: 22px;
}

/* Mobile Menu */
.mobile-menu {
    display: none; /* Flex by JS */
    flex-direction: column;
    gap: 6px;
    position: absolute;
    top: 100%;
    left: 16px;
    right: 16px;
    margin-top: 10px;
    padding: 16px;
    background: var(--glass2);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border: 1px solid var(--border);
    border-radius: 16px;
    box-shadow: 0 15px 40px rgba(0,0,0,.25);
}

.mobile-menu a {
    text-decoration: none;
    color: var(--muted);
    padding: 12px 14px;
    border-radius: 10px;
    font-weight: 600;
    transition: .2s;
}

.mobile-menu a:hover {
    background: var(--card);
    color: var(--accent);
}

/* ---------------- MAIN ---------------- */
.page {
    max-width: 1000px;
    margin: auto;
    padding: 100px 20px 60px;
    min-height: 70vh;
}

.hero {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: 35px;
    text-align: center;
    backdrop-filter: blur(12px);
    box-shadow: 0 8px 30px rgba(0,0,0,.05);
}

.hero h1 {
    margin: 0 0 12px;
    color: var(--accent);
    font-size: 32px;
    text-shadow: 0 0 15px var(--accent-glow);
}

.hero p {
    margin: 0;
    color: var(--muted);
    font-size: 16px;
}

.rules {
    margin-top: 30px;
    display: grid;
    gap: 14px;
}

.rule {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: 16px;
    overflow: hidden;
    backdrop-filter: blur(12px);
    transition: .3s;
}

.rule:hover {
    border-color: rgba(255, 51, 68, 0.3);
    background: var(--card-hover);
}

.rule-head {
    padding: 18px 22px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    cursor: pointer;
    font-weight: bold;
    font-size: 16px;
    color: var(--text);
}

.rule-head span {
    transition: transform .3s ease;
    font-size: 20px;
    color: var(--accent);
}

.rule.active .rule-head span {
    transform: rotate(180deg);
}

.rule-body {
    max-height: 0;
    overflow: hidden;
    padding: 0 22px;
    color: var(--muted);
    line-height: 1.8;
    transition: .4s cubic-bezier(0.1, 1, 0.1, 1);
}

.rule.active .rule-body {
    max-height: 300px; /* فضای کافی برای متن باز شده */
    padding: 0 22px 20px;
}

/* ---------------- FOOTER ---------------- */
footer {
    margin-top: 50px;
    padding: 0 20px 30px;
}

.footer-box {
    max-width: 1300px;
    margin: auto;
    padding: 40px;
    background: var(--glass2);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border: 1px solid var(--border);
    border-radius: 26px;
    box-shadow: 0 20px 40px rgba(0,0,0,.15);
}

.footer-grid {
    display: grid;
    grid-template-columns: 1.5fr 1fr 1fr 1fr;
    gap: 40px;
}

.footer-title {
    font-weight: 800;
    font-size: 18px;
    margin-bottom: 18px;
    color: var(--text);
}

.footer-list a {
    display: block;
    padding: 8px 0;
    text-decoration: none;
    color: var(--muted);
    transition: .2s;
    font-size: 15px;
}

.footer-list a:hover {
    color: var(--accent);
    transform: translateX(-5px);
}

.server-box {
    background: var(--card);
    padding: 18px;
    border-radius: 16px;
    border: 1px solid var(--border);
    font-size: 14px;
    line-height: 2;
    color: var(--muted);
}

.server-box strong {
    color: #00e676; /* رنگ سبز برای آنلاین */
    display: inline-flex;
    align-items: center;
    gap: 6px;
    margin-bottom: 8px;
    font-size: 16px;
}

.server-box strong::before {
    content: "";
    display: block;
    width: 8px;
    height: 8px;
    background: #00e676;
    border-radius: 50%;
    box-shadow: 0 0 8px #00e676;
}

.footer-about {
    font-size: 15px;
    color: var(--muted);
    line-height: 1.9;
}

.footer-icons {
    display: flex;
    gap: 12px;
    margin-top: 20px;
}

.footer-icons a {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 42px;
    height: 42px;
    border-radius: 12px;
    background: var(--card);
    border: 1px solid var(--border);
    color: var(--text);
    text-decoration: none;
    font-size: 14px;
    font-weight: bold;
    transition: .3s;
}

.footer-icons a:hover {
    background: var(--accent);
    border-color: var(--accent);
    color: #fff;
    transform: translateY(-3px);
}

.copy {
    text-align: center;
    margin-top: 40px;
    padding-top: 20px;
    border-top: 1px solid var(--border);
    font-size: 14px;
    color: var(--muted);
}

/* ---------------- RESPONSIVE ---------------- */
@media (max-width: 1024px) {
    .nav {
        display: none;
    }
    .hamburger {
        display: flex;
    }
    .footer-grid {
        grid-template-columns: 1fr 1fr;
    }
}

@media (max-width: 768px) {
    .header-inner {
        margin: 12px 12px 0;
        padding: 12px;
        border-radius: 16px;
    }
    .logo {
        font-size: 16px;
    }
    .logo img {
        width: 38px;
        height: 38px;
    }
    .online-box {
        display: none; /* در موبایل برای خلوت شدن هدر مخفی می‌شود */
    }
    .page {
        padding: 90px 16px 50px;
    }
    .hero {
        padding: 25px 20px;
    }
    .footer-grid {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    .footer-box {
        padding: 30px 20px;
    }
}
</style>
</head>
<body>

<header id="header">
    <div class="header-inner">
        <!-- راست: لوگو -->
        <div class="logo">
            <img src="logo.png" alt="Logo">
            یونیورس گیم
        </div>

        <!-- وسط: منو -->
        <nav class="nav">
            <a href="index.php">صفحه اصلی</a>
            <a href="auth.php">شاپ</a>
            <a href="#">وبلاگ</a>
            <a href="auth.php">ورود / ثبت نام</a>
        </nav>

        <!-- چپ: دکمه ها -->
        <div class="header-left">
            <div class="online-box">
                <div class="online-dot"></div>
                1,402 آنلاین
            </div>
            <button class="theme-toggle" id="themeToggle" title="تغییر تم">☀</button>
            <div class="hamburger" id="menuBtn">☰</div>
        </div>
    </div>

    <!-- منوی موبایل -->
    <div class="mobile-menu" id="mobileMenu">
        <a href="#">صفحه اصلی</a>
        <a href="#">شاپ</a>
        <a href="#">وبلاگ</a>
        <a href="#">ورود / ثبت نام</a>
    </div>
</header>

<main class="page">
    <section class="hero">
        <h1>قوانین سرور</h1>
        <p>برای داشتن تجربه‌ای بی‌نقص و لذت‌بخش در کنار سایر گیمرها، رعایت قوانین زیر الزامی است.</p>
    </section>

    <section class="rules">
        <?php
        $rules = [
            [
                "قوانین تبلیغات | Advertising Punish", 
                "نوار 1 : هرگونه پخش اسم , لینک , ای پی (IP) و غیره که مربوط به فضای خارجی سرور باشد خلاف قوانین هست و فرد مورد نظر نمیتواند برای مدتی از قابلیت چت استفاده کند.<br><br>نوار 2 : هرگونه تبلیغ در سیستم ویس چت غیر مجاز میباشد و فرد مورد نظر تا مدت زمانی نمیتواند از قابلیت ویس چت استفاده نماید."
            ],
            [
                "قوانین تقلب | Cheat Punish", 
                "نوار 1 : هرگونه استفاده از کلاینت های غیر مجاز یا استفاده از روش های غیر مجاز برای بم ریخت , پیشرفت سریع , خراب کردن سیستم گیم غیر قانونی میباشد و فرد مورد نظر برای مدتی نمیتواند وارد سرور شود.<br><br>نوار 2 : هرگونه استفاده از سیستم های اکسپلویت برای گریف کردن سرور یا خراب کردن پینگ سرور غیر قانونی بوده و فرد مورد نظر برای همیشه از ورود به سرور منع میشود."
            ],
            [
                "قوانین بی احترامی | Swearing Punish", 
                "نوار 1 : هرگونه استفاده از کلمات نامناسب در سرور باعث میشود شما برای مدتی نتوانید از قابلیت های ویس چت و چت استفاده نمیاید.<br><br>نوار 2 : هرگونه حرکت نژادی در سرور غیر قانونی بوده و برای مدتی شما نمیتوانید از قابلیت ویس چت و چت استفاده نمایید."
            ],
            [
                "قوانین رفتار سمی | Toxic Behaviour Punish", 
                "نوار 1 : هرگونه ایجاد رفتار سمی و اذیت کردن بازیکن ها غیر قانونی بوده و فرد مورد نظر برای مدتی از ورود به سرور منع میشود."
            ],
            [
                "قوانین اسپم | Spam Punish", 
                "نوار 1 : هرگونه اسپم درون چت یا تکرار کردن برای اذیت کردن بازیکن در ویس چت اسپم خوانده میشه و غیر قانونی بوده و بازیکن برای مدتی نمیتواند از قابلیت ویس چت یا چت استفاده کند."
            ],
            [
                "قوانین فلود | Flood Punish", 
                "نوار 1 : هرگونه کشیدن حرفی یا کلمه ای داخل چت فلود حساب میشود و پلیر برای مدتی نمیتواند از قابلیت چت استفاده کند."
            ],
            [
                "قوانین انجام ندادن اسکرین شئیر | SS Ignoring Punish", 
                "نوار 1 : اگر استفی درخواست انجام اسکرین شئیر رو از بازیکنی بخواد , بازیکن مورد نظر اگر به درخواست استف گوش نکند برای مدتی زیاد یا حتی همیشه از ورود به سرور منع میشود."
            ],
            [
                "قوانین انجام ندادن دستور استف | Staff Ignoring Punish", 
                "نوار 1 : اگر استفی درخواست کاری از شما بکند یا به شما اخطار بدهد و شما گوش نکنید برای مدتی نسبت به درخواست استف مجازات میشید."
            ],
            [
                "قوانین سوء استفاده از باگ | Bug Abuse Punish", 
                "نوار 1 : هرگونه استفاده از مشکلات سرور که میتواند باعث شود سرور دچار مشکل بشود غیر قانونی بوده و بازیکن مجازات میشود.<br><br>نوار 2 : اگر از وجود یک مشکل در سرور خبردار میشوید یا اگر مشکلی را کشف کردید با اطلاع داده به تیم استف میتوانید جوایزی دریافت کنید."
            ],
            [
                "قوانین استفاده از اکانت های فیک | Alt Account", 
                "نوار 1 : هرگونه استفاده از اکانت های فیک بیشتر از 3 تا غیر قانونی بوده و اکانت هایی که کمترین طول عمر را دارن برای همیشه یا مدتی از ورود به سرور منع میشوند.<br><br>نوار 2 : اگر یکی از 3 تا اکانت فیک شما مجازات شود تمام اکانت های شما این مجازات را دریافت میکنند."
            ],
            [
                "قوانین کلاهبرداری | Scam Punish", 
                "نوار 1 : هرگونه کلاهبرداری در سرور غیر قانونی بوده و بازیکن مجازات میشود.<br><br>نوار 2 : هرگونه کلاهبرداری به صورتی که بازیکن بخواهد ایتمی یا اکانتی یا کیت های بازی را بفروشد به شددت مجازات میشود."
            ]
        ];

        foreach ($rules as $r) {
            echo '
            <div class="rule">
                <div class="rule-head">'.$r[0].'<span>⌄</span></div>
                <div class="rule-body"><br>'.$r[1].'<br><br></div>
            </div>';
        }
        ?>
    </section>

</main>

<footer>
    <div class="footer-box">
        <div class="footer-grid">

            <!-- درباره -->
            <div>
                <div class="footer-title" style="color:var(--accent);">یونیورس نتورک</div>
                <div class="footer-about">
                    ما فقط یک سرور گیمینگ نیستیم؛ ما یک خانواده بزرگ از گیمرهای ایرانی هستیم که هدفمان ساخت بهترین تجربه بازی برای شماست.
                </div>
                <div class="footer-icons">
                    <a href="#" title="Discord">DC</a>
                    <a href="#" title="Telegram">TG</a>
                    <a href="#" title="Instagram">IG</a>
                    <a href="#" title="YouTube">YT</a>
                </div>
            </div>

            <!-- لینک های سریع -->
            <div>
                <div class="footer-title">لینک‌های سریع</div>
                <div class="footer-list">
                    <a href="index.php">صفحه اصلی سایت</a>
                <li><a href="auth.php" class="nav-item">شاپ</a></li>
                <li><a href="#blog" class="nav-item">وبلاگ</a></li>
                <li><a href="auth.php" class="nav-item">ورود / ثبت نام</a></li>
                </div>
            </div>

            <!-- پشتیبانی -->
            <div>
                <div class="footer-title">پشتیبانی بازیکنان</div>
                <div class="footer-list">
                    <a href="#">ارسال تیکت جدید</a>
                    <a href="#">آموزش ورود به سرور</a>
                    <a href="#">گزارش باگ یا بازیکن</a>
                    <a href="#">ارتباط مستقیم با مدیریت</a>
                </div>
            </div>

            <!-- وضعیت سرور -->
            <div>
                <div class="footer-title">وضعیت سرور</div>
                <div class="server-box">
                    <strong>آنلاین</strong>
                    تعداد پلیرها: 1402 / 3000<br>
                    آپتایم سرور: 99.9%<br>
                    پینگ حدودی: 12ms تا 30ms<br>
                    نسخه: 1.16 - 1.20
                </div>
            </div>

        </div>
        <div class="copy">© 2026 Universe Studio - تمامی حقوق محفوظ است</div>
    </div>
</footer>

<script>
// Elements
const header = document.getElementById("header");
const menuBtn = document.getElementById("menuBtn");
const mobileMenu = document.getElementById("mobileMenu");
const themeToggle = document.getElementById("themeToggle");

// آکاردئون قوانین
document.querySelectorAll(".rule-head").forEach(el => {
    el.addEventListener("click", () => {
        const parent = el.parentElement;
        // بستن بقیه تب‌ها (اختیاری)
        document.querySelectorAll(".rule").forEach(rule => {
            if(rule !== parent) rule.classList.remove("active");
        });
        parent.classList.toggle("active");
    });
});

// منوی همبرگری
menuBtn.addEventListener("click", () => {
    mobileMenu.style.display = mobileMenu.style.display === "flex" ? "none" : "flex";
});

// اسکرول هدر
window.addEventListener("scroll", () => {
    if (window.scrollY > 40) {
        header.classList.add("scrolled");
    } else {
        header.classList.remove("scrolled");
    }
});

// تغییر تم با کلاس body
let isDark = true;
themeToggle.addEventListener("click", () => {
    isDark = !isDark;
    
    if (isDark) {
        document.body.classList.remove('light-mode');
        themeToggle.textContent = '☀';
    } else {
        document.body.classList.add('light-mode');
        themeToggle.textContent = '☾';
    }
});
</script>

</body>
</html>
