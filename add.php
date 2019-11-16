<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "blog";

session_start();
/*print_r($_SESSION[$blogusername]);die();*/
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['title'])) {
        echo "请输入标题";
    }
    if (empty($_POST['content'])) {
        echo "请输入文章内容";
    }
    if (empty($_POST['cate'])) {
        echo "请选择类别";
    }
}
if (!empty($_POST['title']) && !empty($_POST['content']) && !empty($_POST['cate'])) {
    $title =$_POST['title'];
    $content =$_POST['content'];
    $cate =$_POST['cate'];
    try {
        $conn=new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $userid = $conn->query('SELECT id FROM blog_user where username="admin"');
        $userid_row = $userid->fetch();
        $userid_id = $userid_row['id'];
        $addtime = date('Y-m-d h:i:s', time());
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = $conn->query("INSERT INTO article (title,user_id,content,cate,article_createtime) VALUES ('$title','$userid_id','$content','$cate','$addtime')");
        $conn->exec($sql);
        header('Location:index.php');
    }
    catch(PDOException $e)
    {
        echo $sql . "<br>" . $e->getMessage();
    }
}
?>

<html>
<head>
    <meta charset="utf-8">
    <script charset="utf-8" src="./editor/kindeditor-all-min.js"></script>
    <script charset="utf-8" src="./editor/lang/zh-CN.js"></script>
    <script>
        KindEditor.ready(function(K) {
            window.editor = K.create('#editor_id');
        });
    </script>
</head>
<body>
<form method="POST" action="add.php">
        <textarea id="editor_id" name="content" style="width:1000px;height:600px;">

        </textarea>
    <input type="text" placeholder="请输入标题" name="title">
    <select name="cate">
        <option value="st">科技</option>
        <option value="throne">权力</option>
        <option value="family">家庭</option>
        <option value="faker">faker</option>
    </select>
    <input type="submit" name="button" value="提交">
</form>
</body>
</html>
