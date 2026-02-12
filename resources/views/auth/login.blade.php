<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: #f4fdf8;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            background: #ffffff;
            width: 360px;
            padding: 32px;
            border-radius: 14px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        }

        .login-card h2 {
            margin: 0 0 6px;
            font-weight: 600;
            color: #1f2937;
            text-align: center;
        }

        .login-card p.subtitle {
            font-size: 14px;
            color: #6b7280;
            text-align: center;
            margin-bottom: 24px;
        }

        label {
            font-size: 13px;
            color: #374151;
            font-weight: 500;
        }

        input {
            width: 100%;
            padding: 10px 12px;
            margin-top: 6px;
            margin-bottom: 16px;
            border-radius: 8px;
            border: 1px solid #d1d5db;
            font-size: 14px;
        }

        input:focus {
            outline: none;
            border-color: #22c55e;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
            padding: 10px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 16px;
        }

        button {
            width: 100%;
            padding: 11px;
            background: #22c55e;
            border: none;
            color: white;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
        }

        button:hover {
            background: #16a34a;
        }

        .register {
            margin-top: 18px;
            text-align: center;
            font-size: 13px;
            color: #6b7280;
        }

        .register a {
            color: #16a34a;
            text-decoration: none;
            font-weight: 500;
        }

        .register a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <h2>Masuk</h2>
        <p class="subtitle">Silakan login untuk melanjutkan</p>

        @if(session('error'))
            <div class="error">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="/login">
            @csrf

            <label>Email</label>
            <input type="email" name="email" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <button type="submit">Login</button>
        </form>

        <div class="register">
            Belum punya akun? <a href="/register">Daftar</a>
        </div>
    </div>

</body>
</html>
