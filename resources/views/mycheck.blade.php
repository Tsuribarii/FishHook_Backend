<!DOCTYPE html>
<html>

<head>
    <title></title>
</head>

<body>
    <h1>마이페이지check</h1>
        
    <div>
        <p>이메일: {{ $user->email }}</p>
    </div>
    <div>
        <p>작성자: {{ $user->nickname }}</p>
    </div>
    <div>
        <p>역할: {{ $user->roles }}</p>
    </div>

    <div>
        <button onclick="window.location='{{ url('/myedit') }}/{{ $user->id }}'">수정</button>
    </div>

</body>

</html>
