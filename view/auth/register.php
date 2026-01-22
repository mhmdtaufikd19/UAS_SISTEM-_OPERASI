<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Buat Akun</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', 'Segoe UI', sans-serif;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(120deg, #0f172a, #1e293b);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        /* Background blur kiri kanan */
        body::before,
        body::after {
            content: "";
            position: absolute;
            width: 35%;
            height: 100%;
            top: 0;
            background-size: cover;
            filter: blur(10px) brightness(0.6);
            z-index: 1;
        }

        body::before {
            left: 0;
            background-image: url("https://images.unsplash.com/photo-1517336714731-489689fd1ca8");
        }

        body::after {
            right: 0;
            background-image: url("https://images.unsplash.com/photo-1518770660439-4636190af475");
        }

        /* Wrapper */
        .login-wrapper {
            z-index: 2;
            width: 100%;
            display: flex;
            justify-content: center;
        }

        /* Card */
        .login-card {
            width: 420px;
            max-width: 90%;
            padding: 36px 34px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.35);
            text-align: center;
        }

        /* Title */
        .login-card h2 {
            font-size: 28px;
            font-weight: 700;
            color: #0f172a;
        }

        .subtitle {
            font-size: 14px;
            color: #64748b;
            margin: 8px 0 28px;
        }

        /* Form */
        .form-group {
            text-align: left;
            margin-bottom: 18px;
        }

        .form-group label {
            font-size: 14px;
            font-weight: 500;
            color: #334155;
            margin-bottom: 6px;
            display: block;
        }

        .form-group input {
            width: 100%;
            padding: 14px 15px;
            border-radius: 12px;
            border: 1px solid #cbd5e1;
            font-size: 14px;
            background: #f8fafc;
            transition: 0.2s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: #1e40af;
            background: white;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }

        /* Password */
        .password-group {
            position: relative;
        }

        .password-group .eye {
            position: absolute;
            right: 14px;
            top: 38px;
            font-size: 18px;
            opacity: 0.5;
            cursor: pointer;
        }

        /* Button login */
        .btn-login {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #1e3a8a, #2563eb);
            color: white;
            border: none;
            border-radius: 14px;
            font-size: 16px;
            font-weight: 600;
            margin-top: 8px;
            cursor: pointer;
            transition: 0.3s ease;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(37, 99, 235, 0.4);
        }

        /* Forgot */
        .forgot {
            display: block;
            margin: 18px 0;
            font-size: 14px;
            color: #64748b;
            text-decoration: none;
        }

        .forgot:hover {
            text-decoration: underline;
        }

        /* Google */
        .btn-google {
            width: 100%;
            padding: 12px;
            border-radius: 14px;
            border: 1px solid #e2e8f0;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-size: 14px;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .btn-google:hover {
            background: #f1f5f9;
        }

        .btn-google img {
            width: 18px;
        }

        /* Register */
        .register {
            margin-top: 22px;
            font-size: 14px;
            color: #475569;
        }

        .register a {
            color: #2563eb;
            font-weight: 600;
            text-decoration: none;
        }

        .register a:hover {
            text-decoration: underline;
        }

        /* ================= MOBILE ================= */
        @media (max-width: 768px) {
            body {
                background: linear-gradient(135deg, #1e3a8a, #2563eb);
            }

            body::before,
            body::after {
                display: none;
            }

            .login-card {
                width: 100%;
                min-height: 100vh;
                border-radius: 0;
                padding: 32px 24px;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }
        }
    </style>
</head>

<body>

    <div class="bg-left"></div>
    <div class="bg-right"></div>

    <div class="login-wrapper">
        <div class="login-card">
            <h2>Buat Akun Baru</h2>
            <p class="subtitle">Silahkan isi detail di bawah ini</p>
            <form method="POST" action="/UAS_SO/controller/AuthController.php">

                <input type="hidden" name="action" value="register">

                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" required>
                </div>

                <div class="form-group password-group">
                    <label>Password</label>
                    <input type="password" name="password" required>
                </div>

                <button class="btn-login">Daftar</button>

                <p class="register">
                    Sudah punya akun? <a href="login.php">Masuk Sekarang!</a>
                </p>

            </form>


        </div>



</body>

</html>