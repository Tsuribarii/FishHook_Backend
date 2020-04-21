<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Traits\UploadTrait;

class MypageController extends Controller
{
    use UploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        //모델과 컨트롤러 연결
        $this->user_model = new User();
        $this->middleware('auth');

    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id',$id)->first();
        return view('myabout')->with('user',$user);
    }

    public function updateProfile(Request $request)
    {
        
        $request->validate([
            'name'=>'required',
            'profile_photo'=>'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $user = User::findOrFail(auth()->user()->id);
        $user->name = $request->input('name');
        
        //업로드 되었는지 확인
        if ($request->hasFile('profile_photo')) {
            
            //이미지 파일 가져오기
            $image = $request->file('profile_photo');
            //사용자 이름과 현재 타임 스탬프를 기준으로 이미지 이름을 만듭니다.
            $name = str_slug($request->input('name')).'_'.time();
            // 폴더 경로 정의
            $folder = "{{asset('img')}}";
            // 이미지가 저장 될 파일 경로를 만듭니다. [폴더 경로 + 파일 이름 + 파일 확장자]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            //이미지 업로드
            $this->uploadOne($image, $folder, 'public', $name);
            // 데이터베이스의 사용자 프로필 이미지 경로를 filePath로 설정
            $user->profile_photo = $filePath;
        }
        
        $user->save();
 
        return redirect('myabout/' .$id)->back()->with(['status' => 'Profile updated successfully.']);
        // return redirect('myabout/' .$id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id',$id)->first();
        return view('myedit')->with('user',$user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->file('profile_photo')->store('images', 'public');

        User::where('id',$id)->update([
            'profile_photo'=>$request->profile_photo,
            'email'=>$request->email,
            'nickname'=>$request->nickname,
            ]);

        return redirect('myabout/' .$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
