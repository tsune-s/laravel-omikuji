<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>おみくじ結果</title>
</head>
<body>
    <h1>🎉 {{ $name }} さんの運勢は…</h1>
    <h2 style="font-size: 3em;">{{ $fortuneKey }}</h2>
    <p>{{ $message }}</p>

    <a href="/omikuji">もう一度引く</a>
</body>
</html>
