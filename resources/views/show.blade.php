<!DOCTYPE html>
<html>

<head>
    <title></title>
</head>

<body>
    <h1>글 상세페이지</h1>
    <div>
        <h1>제목: {{ $board->title }}</h1>
    </div>
    <div>
        <p>작성날짜: {{ $board->created_at }}</p>
    </div>
    <div>
        <p>작성자: {{ $user->nickname }}</p>
    </div>
    <div>
        <p>내용: {{ $board->content }}</p>
    </div>

    <div>
        @if(Auth::user() == $user)
        <button onclick="window.location='{{ url('/edit') }}/{{ $board->id }}'">수정</button>
        <button onclick="window.location='{{ url('/delete') }}/{{ $board->id }}'">삭제</button>
        @endif
        <button onclick="window.location='{{ route('list') }}'">목록으로</button>
    </div>

</body>

</html>
