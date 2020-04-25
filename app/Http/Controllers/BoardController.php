<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Board;
use App\User;


class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        //모델과 컨트롤러 연결
        $this->board_model = new Board();

        //사용자 권한 auth 미들웨어
        // $this->middleware('auth');
    }

    public function index()
    {
        //게시글 리스트 
        $board =  Board::all();

        // $user = User::where('id',$board->user_id)->first();
        return response()->json([
            'boards'=>$board,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'species' => 'required',
            'tide' => 'required',
            'bait' => 'required',
            'location' => 'required',
            'content' => 'required',
        ]);

        return Board::create([
            'user_id'=>\Auth::id(),
            'title' => $request['title'],
            'species' => $request['species'],
            'tide' => $request['tide'],
            'bait' => $request['bait'],
            'location' => $request['location'],
            'content' => $request['content']
         ]);

         return response()->json([
            'message' => '저장되었습니다.'
           ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return $id;
        
        //board테이블의 id컬럼에서 $id의 정보를 가져옴
        $board = Board::where('id',$id)->first();
        $user = User::where('id',$board->user_id)->first();

        return response()->json([
            'user'=>$user,
            'board'=>$board
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $board = Board::where('id',$id)->first();
        return response()->json([
            'board'=>$board
        ]);
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
        $this->validate($request, [
            'title' => 'required',
            'species' => 'required',
            'tide' => 'required',
            'bait' => 'required',
            'location' => 'required',
            'content' => 'required',
        ]);

        $board = Board::findOrFail($id);

        $board->update($request->all());

        return response()->json([
            'message' => '업데이트 되었습니다.'
           ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $board = Board::findOrFail($id);
        $board->delete();
        return response()->json([
            'message' => '삭제 되었습니다.'
           ]);
    }
}
