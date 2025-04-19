<p>全 {{ $todos->count() }} 件（完了 {{ $todos->where('completed', true)->count() }} 件）</p>
<!DOCTYPE html>
<html>
<head>
    <title>ToDoリスト</title>
</head>
<body>
    <h1>📝 ToDoリスト</h1>

    <form action="/store" method="POST">
        @csrf
        <input id="todo-input" type="text" name="title" placeholder="やること" required autofocus>
        <button type="submit">追加</button>
    </form>


    <ul>
        @foreach($todos as $todo)
            <li>
                <form action="/toggle/{{ $todo->id }}" method="POST" style="display:inline">
                    @csrf
                    <button type="submit">
                        {{ $todo->completed ? '☑' : '☐' }}
                    </button>
                </form>

                <span style="{{ $todo->completed ? 'color:gray; text-decoration:line-through;' : '' }}">
                    {{ $todo->title }}
                </span>

                <form action="/delete/{{ $todo->id }}" method="POST" style="display:inline">
                    @csrf
                    <button type="submit">🗑</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>
<div>
    {{ $todos->links() }}
</div>
