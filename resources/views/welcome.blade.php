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
    <div class="mother_box">
        @foreach ($posts as $post)
            <a href="{{ $post->slug }}">
                <div class="post_box">
                    <h1 class="post_header">{{ $post->header }}</h1>
                    <p class="post_text">{{ $post->text }}</p>
                    <p class="post_created_at">{{ $post->created_at }}</p>
                </div>
            </a>
        @endforeach
    </div>
    <div class="pagination">
    {{ $posts->links() }}
    </div>
</body>
</html>
