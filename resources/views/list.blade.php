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
                <th>Title</th>
                <th>Content
                <th>
            <tr>
                @foreach($boards as $board)
            <tr>
                <td>
                    <a href="{{url('show')}} / {{$board->id}}">
                        {{ $board->title }}</a>
                </td>
                <td>{{$board->content}}</td>
            </tr>
            @endforeach
        </table>

    </ul>
</body>

</html>
