<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <form action="../MVC-QLNSPB/controller/C_Login.php" method="POST">
        <h1>ĐĂNG NHẬP</h1>
        <div>
            <label>USERNAME:</label>    
            <input type="text" name="username" required>
        </div>
        <br>
        <div>
            <label>PASSWORD:</label>    
            <input type="password" name="password" required>
        </div>
        <br>
        <button type="submit" name="ok">OK</button>
        <button  name="huy">Hủy</button>
    </form>
    
</body>
</html>
