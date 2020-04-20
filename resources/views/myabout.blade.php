<!DOCTYPE html>
<html>

<head>
    <title></title>
</head>

<body>
    <h1>마이페이지</h1>
    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false" v-pre>
        @if (auth()->user()->image)
        <img src="{{ asset(auth()->user()->image) }}" style="width: 40px; height: 40px; border-radius: 50%;">
        @endif
        {{ Auth::user()->name }} <span class="caret"></span>
    </a>
    <div>
        <p>이메일: {{ $user->email }}</p>
    </div>
    <div>
        <p>작성자: {{ $user->nickname }}</p>
    </div>

    <div>
        <button onclick="window.location='{{ url('/myedit') }}/{{ $user->id }}'">수정</button>
    </div>

</body>

</html>
