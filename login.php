<!DOCTYPE html>
<html>
<head>
    <title>Login Perpustakaan</title>

    <style>

        body{
            margin:0;
            padding:0;
            font-family:Arial, sans-serif;
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .login-box{
            width:350px;
            background:white;
            padding:30px;
            border-radius:12px;
            box-shadow:0 10px 25px rgba(0,0,0,0.3);
        }

        .login-box h2{
            text-align:center;
            margin-bottom:25px;
            color:#333;
        }

        .input-group{
            margin-bottom:15px;
        }

        .input-group label{
            display:block;
            margin-bottom:5px;
            font-weight:bold;
        }

        .input-group input{
            width:100%;
            padding:10px;
            border:1px solid #ccc;
            border-radius:6px;
            outline:none;
        }

        .input-group input:focus{
            border-color:#00aaff;
        }

        .btn{
            width:100%;
            padding:10px;
            background:#00aaff;
            border:none;
            color:white;
            font-size:16px;
            border-radius:6px;
            cursor:pointer;
        }

        .btn:hover{
            background:#008ecc;
        }

        .footer{
            text-align:center;
            margin-top:15px;
            font-size:12px;
            color:#666;
        }

    </style>

</head>
<body>

<div class="login-box">

    <h2>Login Perpustakaan</h2>

    <form action="proses_login.php" method="POST">

        <div class="input-group">
            <label>Username (NIM / Admin)</label>
            <input type="text" name="username" required>
        </div>

        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <button class="btn" type="submit">
            Login
        </button>

    </form>

    <div class="footer">
        Sistem Informasi Perpustakaan
    </div>

</div>

</body>
</html>