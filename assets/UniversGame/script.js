document.addEventListener('DOMContentLoaded', () => {
    
    // اگر در صفحه ثبت نام باشیم کدهای زیر اجرا میشوند
    const passwordInput = document.getElementById('password');
    if (passwordInput) {
        const confirmPasswordInput = document.getElementById('confirmPassword');
        const generateBtn = document.getElementById('generateBtn');
        const registerForm = document.getElementById('registerForm');
        const bars = [document.getElementById('bar1'), document.getElementById('bar2'), document.getElementById('bar3')];

        let isPasswordStrong = false;

        // بررسی قدرت رمز عبور هنگام تایپ
        passwordInput.addEventListener('input', () => {
            checkPasswordStrength(passwordInput.value);
        });

        // تابع تولید پسورد قوی
        generateBtn.addEventListener('click', () => {
            const chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+";
            let generatedPassword = "";
            let isValid = false;

            // حلقه برای اطمینان از اینکه پسورد تولید شده واقعا قوی است
            while (!isValid) {
                generatedPassword = "";
                for (let i = 0; i < 12; i++) {
                    let randomNumber = Math.floor(Math.random() * chars.length);
                    generatedPassword += chars.substring(randomNumber, randomNumber + 1);
                }
                // چک میکنیم که پسورد تولید شده حداقل ها را داشته باشد
                if (generatedPassword.match(/[a-z]/) && generatedPassword.match(/[A-Z]/) && generatedPassword.match(/[0-9]/) && generatedPassword.match(/[^a-zA-Z0-9]/)) {
                    isValid = true;
                }
            }

            passwordInput.value = generatedPassword;
            confirmPasswordInput.value = generatedPassword;
            
            // تغییر تایپ به text برای دیدن پسورد تولید شده
            passwordInput.type = "text";
            confirmPasswordInput.type = "text";
            
            checkPasswordStrength(generatedPassword);

            // بعد از ۳ ثانیه دوباره پسوردها را مخفی کن
            setTimeout(() => {
                passwordInput.type = "password";
                confirmPasswordInput.type = "password";
            }, 3000);
        });

        // مدیریت ارسال فرم
        registerForm.addEventListener('submit', (e) => {
            e.preventDefault();

            if (passwordInput.value !== confirmPasswordInput.value) {
                alert("رمز عبور و تکرار آن با هم مطابقت ندارند!");
                return;
            }

            if (!isPasswordStrong) {
                alert("رمز عبور شما ضعیف است! لطفاً از ترکیب حروف بزرگ، کوچک، اعداد و نمادها استفاده کنید.");
                return;
            }

            // اینجا بعدا کد اتصال به بک‌اند (API) قرار می‌گیرد
            alert("ثبت‌نام با موفقیت انجام شد! (نمایشی)");
        });

        // تابع منطق بررسی قدرت رمز
        function checkPasswordStrength(password) {
            let strength = 0;

            if (password.length >= 8) strength += 1; // طول مناسب
            if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength += 1; // حروف بزرگ و کوچک
            if (password.match(/[0-9]/) && password.match(/[^a-zA-Z0-9]/)) strength += 1; // اعداد و نمادها

            // ریست کردن رنگ بارها
            bars.forEach(bar => bar.style.background = '#333');

            // اعمال رنگ بر اساس قدرت
            if (strength >= 1) {
                bars[0].style.background = '#ef4444'; // قرمز - ضعیف
                isPasswordStrong = false;
            }
            if (strength >= 2) {
                bars[1].style.background = '#f59e0b'; // زرد - متوسط
                isPasswordStrong = false;
            }
            if (strength >= 3) {
                bars[2].style.background = '#10b981'; // سبز - قوی
                isPasswordStrong = true;
            }
            
            if(password.length === 0) {
                isPasswordStrong = false;
            }
        }
    }
});
