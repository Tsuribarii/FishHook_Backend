<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <h1>글 상세페이지</h1>
    <div>
        {{ $board->title }}
    </div>
    <div>
        {{ $board->content }}
    </div>
 
    <div>
        
    <!-- <button onclick="window.location='{{ url('/edit') }}/{{ $article->id }}'">수정</button>
    <button onclick="window.location='{{ url('/delete') }}/{{ $article->id }}'">삭제</button> -->
    <button onclick="window.location='{{ route('list') }}'">목록으로</button>
    </div>
 
</body>
</html>
