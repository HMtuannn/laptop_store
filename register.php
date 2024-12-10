<?php
require_once 'db/base.php';

session_start();
$config = require_once 'config/config.php';
$db = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];

    $data = [
        'username' => $username,
        'phone' => $phone,
        'password' => md5($password),
    ];

    $userId = $db->insertAndGetId('t_users', $data);

    if ($userId) {
        // Hiện đang fix cứng 2 role
        $db->insert('t_user_roles',['userId' => $userId,'roleId'=> 1]);
        $success = "Đăng ký thành công cho tên đăng nhập: " . htmlspecialchars($username);
    } else {
        $error = "Đăng ký không thành công. Vui lòng thử lại!";
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laptop Store</title>
    <link rel="icon" type="image/x-icon" href="<?php echo $config['BASE_URL'] .'/assets/images/iassets/logo.png'; ?>">
    <?php require_once "views/lib.php"; ?>

    <style>
    .content {
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 60vh;
    background-color: #f4f7fa; /* Màu nền nhẹ nhàng */
}

.register-container {
    background-color: #fff;
    padding: 2.5rem;
    border-radius: 12px; /* Bo góc mềm mại */
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1); /* Đổ bóng nhẹ */
    width: 100%;
    max-width: 400px;
    font-family: 'Arial', sans-serif;
}

.register-container h2 {
    margin-bottom: 2rem;
    color: #333;
    font-size: 1.8rem;
    font-weight: 600;
    text-transform: uppercase; /* Chữ in hoa */
}

.register-container label {
    display: block;
    font-weight: bold;
    margin-bottom: 0.5rem;
    font-size: 1.1rem;
    color: #444;
}

.register-container input {
    width: 100%;
    padding: 0.9rem;
    margin-bottom: 1.2rem;
    border: 1px solid #ccc;
    border-radius: 8px; /* Bo góc mềm mại */
    font-size: 1rem;
    color: #333;
    transition: border-color 0.3s, box-shadow 0.3s;
}

.register-container input:focus {
    border-color: #f96f3a;
    box-shadow: 0 0 8px rgba(0, 123, 255, 0.2);
    outline: none;
}

.register-container button {
    width: 100%;
    padding: 0.9rem;
    background-color:  #f96f3a;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.2s;
}

.register-container button:hover {
    background-color: #8f4225;
    transform: translateY(-2px); /* Hiệu ứng nhấc nút */
}

.register-container button:active {
    transform: translateY(2px); /* Hiệu ứng khi nhấn nút */
}

.register-container .message {
    margin-bottom: 1.5rem;
    padding: 1rem;
    border-radius: 8px;
    text-align: center;
}

.register-container .success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.register-container .error {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.register-container p {
    margin-top: 1.5rem;
    text-align: center;
    font-size: 1rem;
    color: #777;
}

.register-container a {
    color: #f96f3a;
    text-decoration: none;
    font-weight: bold;
}

.register-container a:hover {
    text-decoration: underline;
}

    </style>
</head>

<body>

    <div class="home_page">

        <?php require_once "views/header.php"; ?>

        <div class="content">
            <div class="register-container">
                <h2>Đăng Ký</h2>
                <?php if (!empty($success)) : ?>
                <div class="message success"><?php echo $success; ?></div>
                <?php endif; ?>
                <?php if (!empty($error)) : ?>
                <div class="message error"><?php echo $error; ?></div>
                <?php endif; ?>
                <form method="POST" action="#">
                    <label for="username">Tên đăng nhập:</label>
                    <input type="text" id="username" name="username" required>

                    <label for="phone">Số điện thoại:</label>
                    <input type="text" id="phone" name="phone" required>

                    <label for="password">Mật khẩu:</label>
                    <input type="password" id="password" name="password" required>

                    <button type="submit">Đăng Ký</button>
                </form>
                <p>Đã có tài khoản? <a href="login.php">Đăng nhập</a></p>
            </div>

        </div>

        <?php require_once 'views/footer.php'; ?>
    </div>


</body>

</html>