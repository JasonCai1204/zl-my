<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{!! $news->news_class->name !!}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
    <link rel="stylesheet" href="/css/api/app.css">
</head>
<body>
    <p class="webViewTitle">{!! $news->title !!}</p>

    <div class="container">
        {!! $news->content !!}
    </div>
</body>
</html>