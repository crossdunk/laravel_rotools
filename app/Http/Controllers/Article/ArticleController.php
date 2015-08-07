<?php namespace App\Http\Controllers\Article;

use Validator;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ArticleController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$articles = DB::table('articles')->select('users.id as user_id','articles.id as id','title','name','body','articles.created_at as created_at')
							->leftjoin('users','articles.user_id','=','users.id')
							->orderBy('articles.created_at','DESC')->get();
		$data = compact('articles');
		return view('article.index',$data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
		return view('article.create');

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//
		$rules = [
			'title'=>'required|unique:articles|max:255',
			'body'=>'required|min:50',
		];

		$messages = [
			 'title.required' => '你必須輸入標題!',
			 'title.unique' => '此標題已經存在!',
			 'title.max' => '標題必須小於255個字!',
			 'body.required' => '你必須要輸入內容!',
			 'body.min' => '內容必須50個字以上!',
		];

		$validator = Validator::make($request->all(), $rules,$messages);
		 if ($validator->fails()) {
            return redirect('article/create')
            ->withErrors($validator)
            ->withInput();
        }

       $article = new \App\Article;

       $article->title = $request->title;
       $article->keyword = $request->keyword;
       $article->body = $request->body;
       $article->user_id = \Auth::user()->id;
		$article->save();
       return redirect('article');

       /*return redirect()->route('posts.show', $post->id)
                         ->with('success', '新增文章完成');*/
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
		$article = \App\Article::find($id);
		$data = compact('article');
		return view('article.show',$data);
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
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
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
		$article = \App\Article::find($id);

		 if (is_null($article)) {
            return redirect()->route('article')
                             ->with('warning', '找不到該文章');
        }
        if ($article && $article->user->id != \Auth::user()->id) {
            return redirect()->route('article')
                             ->with('warning', '您沒有權限刪除這篇文章');
        }

        if ($id == 30) {
            return redirect('article')->with('warning', '您沒有權限刪除這篇文章');
        }

		foreach($article->comments as $comment) {
            $comment->delete();
       }

		$article->delete();
		return redirect('article')->with('success', '文章已被刪除');
	}

	public function comment($id,Request $request)
	{
		//

		$article = \App\Article::find($id);

		if(is_null($article)){
			 return Redirect::back()->withInput('此文章不存在');
		}

		$rules = [
			'title'=>'required',
			'body'=>'required|min:5',
		];

		$messages = [
			 'title.required' => '你必須輸入標題!',
			 'body.required' => '你必須要輸入內容!',
			 'body.min' => '內容必須5個字以上!',
		];

		$validator = Validator::make($request->all(), $rules,$messages);
		 if ($validator->fails()) {
            return redirect('article/'.$id.'')
            ->withErrors($validator)
            ->withInput();
        }

       $comment = new \App\Comment;

       $comment->title = $request->title;
       $comment->body = $request->body;
       $comment->user_id = \Auth::user()->id;
       $comment->article_id = $id;
		$comment->save();
       return redirect('article/'.$id.'');
	}

}
