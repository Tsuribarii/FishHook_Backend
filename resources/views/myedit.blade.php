<!DOCTYPE html>
<html>

<head>
    <title></title>
</head>

<body>
    <h1>마이페이지 수정</h1>
    <form method="POST" action="/myupdate/ {{ $user->id }}" role="form" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="profile_photo">Profile Image</label>
            <div>
                <input id="profile_photo" type="file" class="form-control" name="profile_photo">
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
