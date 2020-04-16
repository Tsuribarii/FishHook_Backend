<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <h1>글 상세페이지</h1>
    <div>
        <h1>{{ $board->title }}</h1>
    </div>
    <div>
        <p>{{ $board->content }}</p>
    </div>
 
    <div>
        
    <button onclick="window.location='{{ url('/edit') }}/{{ $board->id }}'">수정</button>
    <button onclick="window.location='{{ url('/delete') }}/{{ $board->id }}'">삭제</button>
    <button onclick="window.location='{{ route('list') }}'">목록으로</button>
    </div>
 
</body>
</html>
