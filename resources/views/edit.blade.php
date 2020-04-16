<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <h1>글 수정</h1>
    <form method="POST" action="/update/ {{ $board->id }}">
        @csrf
        <!-- @method('PATCH') -->
        <div>
            <input type="text" name="title"  value="{{ $board->title }}">
        </div>
        <div>
            <input type="text" name="species"  value="{{ $board->species }}">
        </div>
        <div>
            <input type="text" name="tide"  value="{{ $board->tide }}">
        </div>
        <div>
            <input type="text" name="bait"  value="{{ $board->bait }}">
        </div>
        <div>
            <input type="text" name="location"  value="{{ $board->location }}">
        </div>
 
        <div>
            <textarea name="content">{{ $board->content }}</textarea>    
        </div>
 
        <div>
            <button type="submit">글 수정</button>
        </div>
    </form>
</body>
</html>