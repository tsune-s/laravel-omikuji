<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>おみくじ</title>
</head>
<body>
    <h1>🔮 おみくじを引いてみよう！</h1>

    <form action="/omikuji/result" method="POST">
        @csrf
        <label>あなたの名前：</label>
        <input type="text" name="name" required>
        <button type="submit">おみくじを引く！</button>
    </form>
</body>
</html>
