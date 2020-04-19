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
    }

    public function index()
    {
        //게시글 리스트 
        $board =  Board::all();
        // $user = User::where('id',$board->user_id)->first();
        return view('list')->with('boards', $board);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Board::insert([
            'user_id'=> \Auth::id(),
            'title'=>$request->title,
            'species'=>$request->species,
            'tide'=>$request->tide,
            'bait'=>$request->bait,
            'location'=>$request->location,
            'content'=>$request->content
            ]);

        return redirect(route('list'));
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
        return view('show')->with('board',$board)->with('user',$user);
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
        return view('edit')->with('board',$board);
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
        Board::where('id',$id)->update([
            // 'user_id'=>$request->user_id,
            'title'=>$request->title,
            'species'=>$request->species,
            'tide'=>$request->tide,
            'bait'=>$request->bait,
            'location'=>$request->location,
            'content'=>$request->content
            ]);
        // insert 나 delete update 했을 경우 view로 연결할 때는 redirect
        return redirect('show/' .$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Board::where('id',$id)->delete();
        return redirect('list');
    }
}
