<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "blog";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$blogusername = trim($_POST['username']);
$blogpassword = trim($_POST['password']);
$bolglogin = $conn->query("SELECT * FROM blog_user WHERE username='$blogusername' and password='$blogpassword' ");
$bolglogin_row = $bolglogin->fetch();

header('Content-type:text/html; charset=utf-8');
// 开启Session
session_start();
// 处理用户登录信息
if (isset($_POST['login'])) {
    // 判断提交的登录信息
    if (($blogusername == '') || ($blogpassword == '')) {
        echo "用户名或密码不能为空!";
        exit;
    } elseif (($blogusername != $bolglogin_row["username"]) || ($blogpassword != $bolglogin_row["password"])) {
        # 用户名或密码错误,同空的处理方式
        echo "用户名或密码错误!";
        exit;
    } elseif (($blogusername == $bolglogin_row["username"]) && ($blogpassword == $bolglogin_row["password"])) {
        # 用户名和密码都正确,将用户信息存到Session中
        $_SESSION['username'] = $blogusername;
        $_SESSION['islogin'] = 1;
        // 若勾选7天内自动登录,则将其保存到Cookie并设置保留7天
        if ($_POST['remember'] == "yes") {
            setcookie('username', $blogusername, time()+7*24*60*60);
            setcookie('code', md5($blogusername.md5($blogpassword)), time()+7*24*60*60);
        } else {
            // 没有勾选则删除Cookie
            setcookie('username', '', time()-999);
            setcookie('code', '', time()-999);
        }
        // 处理完附加项后跳转到登录成功的首页
        header('location:index.php');
    }
}
?>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>
<form action="login.php" method="post">

                <label>用户名:</label>
                <input type="text" name="username">

                <label>密   码:</label>
                <input type="password" name="password">

                <input type="checkbox" name="remember" value="yes">7天内自动登录

                <input type="submit" name="login" value="登录">

</form>
</body>
</html>