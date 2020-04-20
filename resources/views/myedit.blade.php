<!DOCTYPE html>
<html>

<head>
    <title></title>
</head>

<body>
    <h1>마이페이지 수정</h1>
    <form action="/update/ {{ $user->id }}" method="POST" role="form" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="profile_image">Profile Image</label>
            <div>
                <input id="profile_image" type="file" class="form-control" name="profile_image">
                @if (auth()->user()->image)
                <code>{{ auth()->user()->image }}</code>
                @endif
            </div>
        </div>
        <div>
            <input type="text" name="email" value="{{ $user->email }}">
        </div>
        <div>
            <input type="text" name="nickname" value="{{ $user->nickname }}">
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Update Profile</button>
        </div>
    </form>

</body>

</html>
