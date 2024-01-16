<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="app.css">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
@foreach ($posts as $post)
        <div class="one_post_box">
            <h1 class="one_post_header">{{ $post->header }}</h1>
            <p class="one_post_text">{{ $post->text }}</p>
            <p class="one_post_created_at">{{ $post->created_at }}</p>
        </div>
@endforeach
</body>
</html>
