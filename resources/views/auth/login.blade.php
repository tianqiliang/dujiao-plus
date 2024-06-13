<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登录</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #F8F8F8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background: #FFF;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
<div class="login-container">
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <label for="email">用户名/邮箱:</label>
        <input type="email" placeholder="请输入用户名/邮箱" name="email" required>
        <label for="psw">密码:</label>
        <input type="password" placeholder="请输入密码" name="password" required>
        <button type="submit">登录</button>
    </form>
</div>
</body>
</html>
