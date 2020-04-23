<!DOCTYPE html>
<html>

<head>
    <title></title>
</head>

<body>
    <h1>예약확인</h1>
    <div>
        <h1>배 아이디: {{ $board->title }}</h1>
    </div>
    <div>
        <p>날짜: {{ $board->created_at }}</p>
    </div>
    <div>
        <p>인원수: {{ $user->nickname }}</p>
    </div>

</body>

</html>
