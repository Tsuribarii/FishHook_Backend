<!DOCTYPE html>
<html>

<head>
    <title></title>
</head>

<body>
    <ul>
        <h1>글 목록</h1>
        <table>
            <tr>
                <th>제목</th>
                <th>내용</th>
                <th>글쓴이</th>
                <th>
            <tr>
                @foreach($boards as $board)
            <tr>
                <td>
                <a href="/show/ {{ $board->id }} ">
                    <!-- <a href="{{ url('show') }} / {{ $board->id }}"> -->
                        {{ $board->title }}</a>
                </td>
                <td>{{ $board->content }}</td>

            </tr>
            @endforeach
        </table>
        <div>
            <button onclick="location.href='create'">글 쓰기</button>
        </div>

    </ul>
</body>

</html>
