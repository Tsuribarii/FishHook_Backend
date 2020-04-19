<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <h1>글 작성</h1>
    <form method="POST" action="{{ url('/store') }}">
        @csrf
        
        <div>
            <input type="text" name="title" placeholder="제목">
        </div>
        <div>
            <input type="text" name="species" placeholder="어종">
        </div>
        <div>
            <input type="text" name="tide" placeholder="물때">
        </div>
        <div>
            <input type="text" name="bait" placeholder="미끼">
        </div>
        <div>
            <input type="text" name="location" placeholder="장소">
        </div>
        <div>
            <textarea name="content" placeholder="내용"></textarea>    
        </div>
 
        <div>
            <button type="submit">글 작성</button>
        </div>
    </form>
</body>
</html>
