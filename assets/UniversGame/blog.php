<?php
$posts = $posts ?? [
    [
        'title' => 'آموزش شروع کار با سرور گیم',
        'excerpt' => 'در این مطلب با اصول اولیه راه‌اندازی، مدیریت و بهینه‌سازی سرور گیم آشنا می‌شوید.',
        'description' => 'اگر می‌خواهید یک سرور حرفه‌ای و پایدار داشته باشید، این مقاله نقطه شروع بسیار خوبی برای شما خواهد بود.',
        'date' => '1405/01/28',
        'category' => 'آموزشی',
        'image' => 'images/blog1.jpg',
        'link' => '#'
    ],
    [
        'title' => 'بهترین تنظیمات برای امنیت سرور',
        'excerpt' => 'در این مقاله مهم‌ترین نکات امنیتی برای جلوگیری از نفوذ، حملات و سوءاستفاده را بررسی می‌کنیم.',
        'description' => 'رعایت چند اصل ساده اما مهم می‌تواند امنیت سرور شما را چند برابر کند و تجربه بهتری برای کاربران بسازد.',
        'date' => '1405/01/25',
        'category' => 'امنیت',
        'image' => 'images/blog2.jpg',
        'link' => '#'
    ],
    [
        'title' => 'راهنمای افزایش بازدهی و عملکرد',
        'excerpt' => 'چطور مصرف منابع را کاهش دهیم و در عین حال کیفیت و سرعت سرور را بالاتر ببریم؟',
        'description' => 'در این مطلب روش‌هایی را می‌خوانید که به کمک آن‌ها می‌توانید عملکرد کلی سرویس خود را به‌صورت محسوسی بهتر کنید.',
        'date' => '1405/01/20',
        'category' => 'راهنما',
        'image' => 'images/blog3.jpg',
        'link' => '#'
    ]
];
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>وبلاگ</title>
    <meta name="theme-color" content="#151518">
    <meta name="description" content="سرور ماینکرافت یونیورس نتورک - بهترین تجربه بازی ماینکرافت با پایین‌ترین پینگ در ایران. ورود و ثبت نام.">
    <meta name="keywords" content="ماینکرافت, سرور ماینکرافت, یونیورس نتورک, بازی آنلاین, ماینکرفت ایران">
    <meta name="author" content="Universe Network">
    <meta http-equiv="X-Content-Type-Options" content="nosniff">
    <meta http-equiv="X-Frame-Options" content="DENY">
    <meta http-equiv="X-XSS-Protection" content="1; mode=block">
    <link rel="icon" href="logo.png" type="image/png">
    <style>
        :root{
            --bg: #151518;
            --bg2: #1e1e24;
            --card: rgba(255,255,255,0.04);
            --card-hover: rgba(255,255,255,0.08);
            --text: #f0f0f5;
            --muted: #9aa0a6;
            --accent: #ff3344;
            --accent-2: #d72638;
            --accent-soft: rgba(255, 51, 68, 0.12);
            --accent-glow: rgba(255, 51, 68, 0.20);
            --border: rgba(255,255,255,0.08);
            --glass: rgba(21, 21, 24, 0.78);
            --glass2: rgba(30, 30, 36, 0.96);
            --shadow: 0 18px 50px rgba(0,0,0,0.35);
            --radius: 22px;
            --header-radius: 24px;
            --container: 1300px;
        }

        *{
            box-sizing: border-box;
        }

        html{
            scroll-behavior: smooth;
        }

        body{
            margin: 0;
            font-family: Tahoma, Arial, sans-serif;
            background:
                radial-gradient(circle at top right, rgba(255, 51, 68, 0.14), transparent 25%),
                radial-gradient(circle at top left, rgba(255, 255, 255, 0.04), transparent 18%),
                linear-gradient(180deg, #1a0f12 0%, #151518 30%, #1e1e24 100%);
            color: var(--text);
            min-height: 100vh;
            overflow-x: hidden;
        }

        a{
            text-decoration: none;
            color: inherit;
        }

        img{
            display: block;
            max-width: 100%;
        }

        .container{
            width: min(var(--container), calc(100% - 32px));
            margin: 0 auto;
        }

        /* background */
        .hero-bg{
            position: absolute;
            inset: 0;
            overflow: hidden;
            pointer-events: none;
            z-index: 0;
        }

        .hero-glow{
            position: absolute;
            border-radius: 50%;
            filter: blur(50px);
            opacity: 0.45;
        }

        .hero-glow.g1{
            width: 340px;
            height: 340px;
            top: 20px;
            right: 8%;
            background: rgba(255, 51, 68, 0.18);
        }

        .hero-glow.g2{
            width: 280px;
            height: 280px;
            top: 120px;
            left: 8%;
            background: rgba(255,255,255,0.05);
        }

        .hero-glow.g3{
            width: 220px;
            height: 220px;
            top: 260px;
            right: 32%;
            background: rgba(255, 51, 68, 0.10);
        }

        /* header */
        .site-header{
            position: sticky;
            top: 0;
            z-index: 9999;
            padding-top: 18px;
            transition: all .35s ease;
        }

        .site-header .header-shell{
            width: min(var(--container), calc(100% - 32px));
            margin: 0 auto;
            transition: all .35s ease;
        }

        .site-header .header-inner{
            min-height: 92px;
            display: grid;
            grid-template-columns: 220px 1fr 220px;
            align-items: center;
            gap: 16px;
            padding: 0 22px;
            border: 1px solid rgba(255, 91, 104, 0.12);
            border-radius: 24px;
            background: rgba(24, 24, 28, 0.92);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            box-shadow:
                0 14px 40px rgba(0,0,0,0.28),
                inset 0 1px 0 rgba(255,255,255,0.03);
            transition: all .35s ease;
        }

        .site-header.scrolled{
            padding-top: 0;
        }

        .site-header.scrolled .header-shell{
            width: 100%;
        }

        .site-header.scrolled .header-inner{
            width: 100%;
            border-radius: 0;
            border-left: none;
            border-right: none;
            border-top: none;
            background: rgba(20, 20, 24, 0.96);
            min-height: 82px;
            padding: 0 28px;
        }

        .brand{
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 14px;
            min-width: 0;
        }

        .brand-title{
            color: #ff7b86;
            font-size: 24px;
            font-weight: 800;
            white-space: nowrap;
        }

        .brand-logo{
            width: 64px;
            height: 64px;
            border-radius: 12px;
            background: linear-gradient(135deg, #ff3344, #c9192c);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 900;
            font-size: 26px;
            box-shadow: 0 0 0 4px rgba(255,255,255,0.03);
            flex-shrink: 0;
        }

        .main-nav{
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 38px;
        }

        .main-nav a{
            position: relative;
            color: #e7e7ec;
            font-size: 18px;
            font-weight: 700;
            padding: 10px 2px;
            transition: color .25s ease;
        }

        .main-nav a::after{
            content: "";
            position: absolute;
            right: 0;
            bottom: 2px;
            width: 0;
            height: 3px;
            border-radius: 999px;
            background: linear-gradient(90deg, #ff3344, #ff6b78);
            transition: width .25s ease;
        }

        .main-nav a:hover,
        .main-nav a.active{
            color: #ffffff;
        }

        .main-nav a:hover::after,
        .main-nav a.active::after{
            width: 100%;
        }

        .header-status{
            display: flex;
            align-items: center;
            justify-content: flex-start;
        }

        .online-box{
            display: inline-flex;
            align-items: center;
            gap: 12px;
            min-height: 52px;
            padding: 0 18px;
            border-radius: 16px;
            color: #ff8c95;
            font-size: 16px;
            font-weight: 700;
            background: linear-gradient(180deg, rgba(255, 51, 68, 0.10), rgba(255, 51, 68, 0.05));
            border: 1px solid rgba(255, 51, 68, 0.20);
            box-shadow:
                inset 0 1px 0 rgba(255,255,255,0.04),
                0 10px 24px rgba(255, 51, 68, 0.08);
            white-space: nowrap;
        }

        .online-dot{
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #ff3344;
            box-shadow: 0 0 0 6px rgba(255, 51, 68, 0.10), 0 0 16px rgba(255, 51, 68, 0.65);
            animation: pulse 1.8s infinite;
            flex-shrink: 0;
        }

        @keyframes pulse{
            0%{ transform: scale(1); opacity: 1; }
            50%{ transform: scale(1.15); opacity: .8; }
            100%{ transform: scale(1); opacity: 1; }
        }

        .mobile-toggle{
            display: none;
            width: 48px;
            height: 48px;
            border: 1px solid var(--border);
            background: var(--card);
            color: #fff;
            border-radius: 14px;
            cursor: pointer;
            font-size: 22px;
        }

        /* hero */
        .hero{
            position: relative;
            padding: 40px 0 20px;
            min-height: 340px;
        }

        .hero-content{
            position: relative;
            z-index: 1;
            padding: 48px 0 20px;
        }

        .hero-card{
            width: 100%;
            border: 1px solid rgba(255,255,255,0.07);
            background:
                linear-gradient(180deg, rgba(255,255,255,0.04), rgba(255,255,255,0.02));
            border-radius: 30px;
            padding: 34px;
            box-shadow: var(--shadow);
        }

        .hero-badge{
            display: inline-flex;
            align-items: center;
            gap: 10px;
            min-height: 42px;
            padding: 0 16px;
            border-radius: 999px;
            color: #ff8c95;
            background: rgba(255, 51, 68, 0.10);
            border: 1px solid rgba(255, 51, 68, 0.18);
            margin-bottom: 18px;
            font-weight: 700;
        }

        .hero h1{
            margin: 0 0 14px;
            font-size: 42px;
            line-height: 1.4;
            color: #fff;
        }

        .hero p{
            margin: 0;
            max-width: 850px;
            color: #b9bcc6;
            line-height: 2;
            font-size: 17px;
        }

        /* content */
        .content{
            position: relative;
            z-index: 1;
            padding: 20px 0 70px;
        }

        .section-head{
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            margin-bottom: 24px;
        }

        .section-head h2{
            margin: 0;
            font-size: 28px;
            color: #fff;
        }

        .section-head p{
            margin: 0;
            color: var(--muted);
            font-size: 15px;
        }

        .posts-grid{
            display: grid;
            grid-template-columns: repeat(3, minmax(0,1fr));
            gap: 22px;
        }

        .post-card{
            overflow: hidden;
            border-radius: 26px;
            background: linear-gradient(180deg, rgba(255,255,255,0.04), rgba(255,255,255,0.03));
            border: 1px solid rgba(255,255,255,0.07);
            box-shadow: 0 12px 34px rgba(0,0,0,0.18);
            transition: transform .28s ease, box-shadow .28s ease, border-color .28s ease, background .28s ease;
        }

        .post-card:hover{
            transform: translateY(-6px);
            border-color: rgba(255, 51, 68, 0.22);
            box-shadow: 0 18px 40px rgba(0,0,0,0.24);
            background: linear-gradient(180deg, rgba(255,255,255,0.055), rgba(255,255,255,0.035));
        }

        .post-thumb{
            position: relative;
            display: block;
            aspect-ratio: 16 / 9;
            background: #1a1a1f;
            overflow: hidden;
        }

        .post-thumb img{
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .35s ease;
        }

        .post-card:hover .post-thumb img{
            transform: scale(1.05);
        }

        .post-thumb::after{
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, transparent 45%, rgba(0,0,0,0.52));
        }

        .post-body{
            padding: 18px 18px 22px;
        }

        .post-meta{
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 14px;
        }

        .post-category{
            display: inline-flex;
            align-items: center;
            min-height: 34px;
            padding: 0 12px;
            border-radius: 999px;
            color: #ff8d96;
            font-size: 13px;
            font-weight: 700;
            background: rgba(255, 51, 68, 0.10);
            border: 1px solid rgba(255, 51, 68, 0.14);
        }

        .post-date{
            color: #a3a8b1;
            font-size: 13px;
        }

        .post-title{
            margin: 0 0 10px;
            font-size: 20px;
            line-height: 1.8;
            color: #fff;
        }

        .post-excerpt{
            margin: 0 0 14px;
            color: #c8ccd3;
            line-height: 1.95;
            font-size: 15px;
        }

        .post-description{
            margin: 0 0 18px;
            color: #9da3ad;
            line-height: 1.95;
            font-size: 14px;
            padding-top: 14px;
            border-top: 1px solid rgba(255,255,255,0.06);
        }

        .post-actions{
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-top: 10px;
        }

        .read-btn{
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            min-height: 48px;
            padding: 0 18px;
            border-radius: 14px;
            color: #fff;
            font-size: 14px;
            font-weight: 700;
            background: linear-gradient(135deg, #ff3344, #c61d2f);
            border: 1px solid rgba(255,255,255,0.07);
            box-shadow: 0 12px 24px rgba(255, 51, 68, 0.18);
            transition: transform .25s ease, box-shadow .25s ease, filter .25s ease;
        }

        .read-btn:hover{
            transform: translateY(-2px);
            box-shadow: 0 16px 28px rgba(255, 51, 68, 0.24);
            filter: brightness(1.05);
        }

        .read-btn .arrow{
            font-size: 16px;
            line-height: 1;
        }

        .read-hint{
            color: #8e949d;
            font-size: 13px;
        }

        footer{
            padding: 10px 0 36px;
        }

        .footer-box{
            border-top: 1px solid rgba(255,255,255,0.07);
            padding-top: 18px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
            color: #98a0aa;
            font-size: 14px;
        }

        @media (max-width: 1100px){
            .site-header .header-inner{
                grid-template-columns: 180px 1fr 180px;
            }

            .main-nav{
                gap: 22px;
            }

            .posts-grid{
                grid-template-columns: repeat(2, minmax(0,1fr));
            }
        }

        @media (max-width: 860px){
            .site-header .header-inner{
                display: flex;
                align-items: center;
                justify-content: space-between;
                min-height: 82px;
            }

            .main-nav{
                display: none;
                position: absolute;
                top: calc(100% + 10px);
                right: 16px;
                left: 16px;
                flex-direction: column;
                align-items: stretch;
                gap: 8px;
                padding: 14px;
                background: rgba(24, 24, 28, 0.98);
                border: 1px solid rgba(255,255,255,0.07);
                border-radius: 20px;
                box-shadow: 0 18px 40px rgba(0,0,0,0.28);
            }

            .main-nav.open{
                display: flex;
            }

            .main-nav a{
                padding: 12px 10px;
                border-bottom: 1px solid rgba(255,255,255,0.05);
            }

            .main-nav a:last-child{
                border-bottom: none;
            }

            .main-nav a::after{
                display: none;
            }

            .mobile-toggle{
                display: inline-flex;
                align-items: center;
                justify-content: center;
            }

            .header-status{
                display: none;
            }

            .brand-title{
                font-size: 20px;
            }

            .brand-logo{
                width: 54px;
                height: 54px;
                font-size: 22px;
            }

            .hero h1{
                font-size: 32px;
            }

            .posts-grid{
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 640px){
            .container{
                width: calc(100% - 20px);
            }

            .site-header .header-shell{
                width: calc(100% - 20px);
            }

            .site-header .header-inner{
                padding: 0 14px;
                border-radius: 18px;
            }

            .site-header.scrolled .header-inner{
                padding: 0 16px;
            }

            .hero{
                padding-top: 26px;
            }

            .hero-card{
                padding: 22px;
                border-radius: 22px;
            }

            .hero h1{
                font-size: 26px;
            }

            .hero p{
                font-size: 15px;
            }

            .section-head{
                flex-direction: column;
                align-items: flex-start;
            }

            .post-body{
                padding: 16px;
            }

            .post-title{
                font-size: 18px;
            }

            .read-btn{
                width: 100%;
            }

            .post-actions{
                flex-direction: column;
                align-items: stretch;
            }
        }
    </style>
</head>
<body>

    <header class="site-header" id="siteHeader">
        <div class="header-shell">
            <div class="header-inner">
                <div class="brand">
                    <div class="brand-logo">ب</div>
                    <div class="brand-title">یونیورس گیم</div>
                </div>

                <nav class="main-nav" id="mainNav">
                    <a href="index.php">صفحه اصلی</a>
                    <a href="rules.php">قوانین</a>
                    <a href="#" class="active">وبلاگ</a>
                    <a href="auth.php">ورود / ثبت نام</a>
                </nav>

                <div class="header-status">
                    <div class="online-box">
                        <span class="online-dot"></span>
                        <span>1,402 بازیکن آنلاین</span>
                    </div>
                </div>

                <button class="mobile-toggle" id="mobileToggle" type="button">☰</button>
            </div>
        </div>
    </header>

    <section class="hero">
        <div class="hero-bg">
            <div class="hero-glow g1"></div>
            <div class="hero-glow g2"></div>
            <div class="hero-glow g3"></div>
        </div>

        <div class="container hero-content">
            <div class="hero-card">
                <div class="hero-badge">وبلاگ رسمی سایت</div>
                <h1>آخرین مطالب، آموزش‌ها و اخبار دنیای گیم</h1>
                <p>
                    در این بخش می‌توانید جدیدترین آموزش‌ها، راهنماها، نکات امنیتی و مطالب کاربردی مربوط به سرور و گیم را مطالعه کنید.
                    طراحی این صفحه به‌صورت کامل با تم قرمز و طوسی هماهنگ شده تا از نظر ظاهری با rules.php و استایل اصلی سایت یکپارچه باشد.
                </p>
            </div>
        </div>
    </section>

    <main class="content">
        <div class="container">
            <div class="section-head">
                <h2>جدیدترین مقالات وبلاگ</h2>
                <p>مطالب به‌روز، کاربردی و قابل استفاده برای کاربران و مدیران</p>
            </div>

            <div class="posts-grid">
                <?php foreach ($posts as $post): ?>
                    <article class="post-card">
                        <a href="<?php echo htmlspecialchars($post['link']); ?>" class="post-thumb">
                            <img src="<?php echo htmlspecialchars($post['image']); ?>" alt="<?php echo htmlspecialchars($post['title']); ?>">
                        </a>

                        <div class="post-body">
                            <div class="post-meta">
                                <span class="post-category"><?php echo htmlspecialchars($post['category']); ?></span>
                                <span class="post-date"><?php echo htmlspecialchars($post['date']); ?></span>
                            </div>

                            <h3 class="post-title">
                                <a href="<?php echo htmlspecialchars($post['link']); ?>">
                                    <?php echo htmlspecialchars($post['title']); ?>
                                </a>
                            </h3>

                            <p class="post-excerpt">
                                <?php echo htmlspecialchars($post['excerpt']); ?>
                            </p>

                            <a href="<?php echo htmlspecialchars($post['link']); ?>" class="read-more">
                                خواندن بیشتر <span>←</span>
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </main>
