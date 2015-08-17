<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        if(\Auth::user()->permission!=2){
            return redirect('/')->with('warning', '您沒有權限！');
        }else{
            $users = \App\User::all();
            $data = compact('users');
            return view('admin.index',$data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //

       if(\Auth::user()->permission!=2){
            return redirect()->route('admin')
                             ->with('warning', '您沒有權限刪除這個使用者');
        }

        $user = \App\User::find($id);

       if (is_null($user)) {
            return redirect()->route('admin')
                             ->with('warning', '找不到該使用者');
        }

       foreach($user->comments as $comment){
            $comment->delete();
       }

       foreach($user->articles as $article){
            $article->delete();
       }

        $user->delete();
        return redirect('admin')->with('success', '使用者已被刪除');
       }
}
