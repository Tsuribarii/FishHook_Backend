<!DOCTYPE html>
<html>

<head>
    <title></title>
</head>

<body>
    <h1>배 정보</h1>
    <div>
        <h1>주인: {{ $ship->owner_id }}</h1>
    </div>
    <div>
        <p>최대인원: {{ $ship->people }}</p>
    </div>
    <div>
        <p>비용: {{ $ship->cost }}</p>
    </div>

    <div>
        <button onclick="window.location='{{ url('/recreate') }}/{{ $ship->id }}'">예약</button>
    </div>

</body>

</html>
