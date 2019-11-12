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
    <textarea id="editor_id" name="content" style="width:1000px;height:600px;">
    请输入
    </textarea>
</body>
</html>
