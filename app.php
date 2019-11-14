<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "blog";

$conn=new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

$article = $conn->query('SELECT * FROM article a INNER JOIN blog_user b ON a.user_id=b.id');
$article_row = $article->fetchAll();
?>

<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <style>
            .left-side{
                float: left;
                position: absolute;
                width: 15%;
                height: 100%;
                background-color: #d1ecf1;
                font-size: x-large;
                font-style: italic;
            }
            .sidehover:hover{
                color: #5690D2;
                font-style: initial;
            }
            .contant{
                position: relative;
                float: right;
                width: 85%;
            }
            .arti-button{
                position: relative;
                padding: 5px;
                margin: 3px;
            }
        </style>
    </head>
    <body>
    <div class="left-side">
        <ul onclick="window.location.href='index.php'" class="sidehover">首页</ul>
    </div>
    <div class="contant">
        <input type="button" value="新增文章" class="arti-button" onclick="window.location.href='add.php'">
        <table width="100%" align="center" rules="rows" cellspacing="20%" cellpadding="20%">
            <tr>
                <th>序号</th>
                <th>标题</th>
                <th>作者</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            <?php
            foreach ($article_row as $value) {
                ?>
                <tr align="center">
                    <td><?php echo $value['article_id']; ?></td>
                    <td><?php echo $value['title']; ?></td>
                    <td><?php echo $value['username']; ?></td>
                    <td><?php echo $value['status']; ?></td>
                    <td><input type="button" value="编辑" onclick="window.location.href='edit.php'">
                        &nbsp;&nbsp;&nbsp;<button>删除</button></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
    </body>
</html>