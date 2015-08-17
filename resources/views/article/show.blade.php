@extends('layouts.master')

@section('content')
<style>
body{
  font-style: '微軟正黑體';
}
.btn{
  margin:5px;
}
.body{
  font-size: 24px;
}
.title_comment{
  color:#D1C0C0;
}
.comment{
  margin:5px;
  border-style: solid;
  border-radius: 15px;
  padding:15px;
}
.comment_title{
  color:#8E3030;
  font-weight: 900;
}
</style>
  <section class='content col-md-8'>
       <h1>{{ $article->title }}</h1>
        <h3>{{ $article->user->name }}</h3>
         <?php
          if(!is_null(Session::get('warning'))){
            echo "<p class='text-danger'>".Session::get('warning')."</p>";
          }
          if(!is_null(Session::get('success'))){
            echo "<p class='text-success'>".Session::get('success')."</p>";
          }
        ?>
        <div class='row tool'>
          <a href="{{ URL('article') }}" class='btn btn-primary col-md-2'>‹‹ 回文章列表</a>
        @if (\Auth::check() && ($article->user->id == Auth::user()->id || Auth::user()->permission==2 ) )
              <a href="{{ URL('article/' .$article->id.'/edit') }}" class='btn btn-info col-md-1 '>編輯</a>
              <form id='delete' method='post' action='{{ URL("article/".$article->id) }}'>
                <input name="_method" type="hidden" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type='submit' value='刪除' class='btn btn-danger  col-md-1'>
              </form>
        @endif
        </div>
        
    <hr />
    <div class='body'>
    {!! nl2br(e($article->body)) !!}
    </div>
  </section>

  <section class='col-md-8 comments'>
    <div class='label'>
      <?php
      $keywords = '';
      if($article->keyword!=''){
        $keywords = explode(',',$article->keyword);
        }
      ?>
      @if($keywords!='')
        @foreach($keywords as $keyword)
          <a href="{{ URL('article/keyword/search/'. $keyword .'') }}" class='btn btn-info'>{!! $keyword !!}</a>| 
        @endforeach
      @endif
    </div>
    <hr />
    <h1 class='title_comment'>Comments</h1>
    @if (count($errors) > 0)
            <div class="alert alert-danger">
              <strong>Whoops!</strong> 看來你輸入的有些是錯誤的<br><br>
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
    @endif
    @if (\Auth::check()) 
      <form action='{{ URL("article/".$article->id)."/comment" }}' class='col-md-8' method='post'>
        <input type='hidden' name='_token' value="{!! csrf_token() !!}">
        <div class="form-group">
          <label>標題</label>
          <input type="text" class="form-control" id="title" name='title' placeholder="標題" value="{{Request::old('title')}}">
        </div>
        <div class="form-group">
          <label>內容</label>
          <textarea name='body' class='form-control' rows='5'>{{ Request::old('body') }}</textarea>
        </div>
        <input type='submit' value='送出' class='btn btn-success'>
      </form>
    @endif
    @foreach($article->comments()->orderBy('created_at','DESC')->get() as $comment)
      <div class='row'>
        <div class='col-md-6'>
            <div class='comment'>
              <div class='comment_header'>
                <div class='comment_title'>
                    <h4>{{ $comment->title }}</h4>
                </div>
                <div class='row'>
                  <div class='comment_user col-md-6'>
                      <small>{{ $comment->user->name }}</small>
                  </div>
                  <div class='comment_created_at col-md-6'>
                      <small>{{ $comment->created_at }}</small>
                  </div>
                </div>
              </div>
              <hr />
              <div class='comment_body'>
                  {!! nl2br(e($comment->body)) !!}
              </div>
            </div>
        </div>
      </div>
    @endforeach    
  </section>
  <script>
    $('#delete').click(function(){
      if(confirm('確定刪除『<?=$article->title?>』？')){
        $(this).submit();
      }else{
        return false;
      }
      return false;
    });
  </script>
@endsection