<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title>病情报告 - 肿瘤名医</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
    <link rel="stylesheet" href="/css/api/app.css">
</head>
<body>
    <div class="container">
        <div class="container">
            <!-- 内容 -->
            {!! $report !!}

            <!-- 内容为空时展示“暂无病情报告。” -->
            <div class="no-content">
                <p>暂无病情报告。</p>
            </div>
        </div>
    </div>
</body>
</html>
