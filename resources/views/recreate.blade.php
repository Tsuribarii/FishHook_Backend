<!DOCTYPE html>
<html>

<head>
    <title></title>
</head>

<body>
    <h1>예약</h1>
    <form method="POST" action="{{ url('/reservation/{id}') }}">
        @csrf
    <div>
        <input type="text" name="ship_id" placeholder="배번호">
    </div>
    <div>
        <input type="date" name="departure_date" placeholder="날짜">
    </div>
    <div>
        <input type="text" name="number_of_people" placeholder="인원수">
    </div>

    <div>
    <button type="submit">예약</button>
    </div>
    </form>

</body>

</html>
