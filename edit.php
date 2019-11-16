<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "blog";

$conn=new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$artiid = $_GET['id'];

$edit = $conn->query("SELECT * FROM article where article_id=$artiid");

$edit_row = $edit->fetch();
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
<form method="POST" action="edit.php">
        <textarea id="editor_id" name="content" style="width:1000px;height:600px;">
            <?php echo $edit_row['content'] ?>
        </textarea>
    <input type="text" placeholder="请输入标题" name="title" value="<?php echo $edit_row['title'] ?>">
    <select name="cate">
        <option value="st" <?php if ($edit_row['cate'] == 'st'){ echo 'selected';} ?>>科技</option>
        <option value="throne" <?php if ($edit_row['cate'] == 'throne'){ echo 'selected';} ?>>权力</option>
        <option value="family" <?php if ($edit_row['cate'] == 'family'){ echo 'selected';} ?>>家庭</option>
        <option value="faker" <?php if ($edit_row['cate'] == 'faker'){ echo 'selected';} ?>>faker</option>
    </select>
    <input type="submit" name="button" value="提交">
</form>
</body>
</html>
