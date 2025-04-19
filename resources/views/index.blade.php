<!DOCTYPE html>
<html>
<head>
    <title>メモ帳</title>
</head>
<body>
    <h1>メモ帳</h1>
    <form action="/store" method="POST">
        @csrf
        <textarea name="content" rows="4" cols="40" placeholder="メモを書く..."></textarea><br>
        <button type="submit">保存</button>
    </form>

    <h2>保存されたメモ</h2>
    <ul>
        @foreach ($memos as $memo)
            <li>{{ $memo->content }} <small>（{{ $memo->created_at->diffForHumans() }}）</small></li>
        @endforeach
    </ul>
</body>
</html>
