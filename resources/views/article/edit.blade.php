@extends('layouts.master')
@section('content')
<style>
.content{
  margin-top: 20px;
}
</style>
  <section class='content'>

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
    <?php 
      if(is_null(Request::old('title'))){
        $title = $article->title;
        $body = $article->body;
        $keyword = $article->keyword;
      }else{
        $title = Request::old('title');
        $body = Request::old('body');
        $keyword = Request::old('keyword');
      }
    ?>
  <form method='post' action="{{ URL('article/'. $article->id ) }}" id='update_article'>
      <input type='hidden' name='_method' value='PATCH'>
      <input type='hidden' name='_token' value='{!! csrf_token() !!}'>
      <div class="form-group">
        <label for="exampleInputEmail1">標題</label>
        <input type="text" class="form-control" id="title" name='title' placeholder="標題" value="{{ $title }}">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">關鍵字</label>
        <input type="text" class="form-control" id="keyword" name='keyword' placeholder="關鍵字" value="{{ $keyword }}">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">內容</label>
        <textarea id='body' class='form-control' name='body' rows='20'>{!! $body !!}</textarea>
      </div>
      <input type='submit' value='送出' class='btn btn-default' id='send'>
      <button class='btn btn-default' id='back'>回上一頁</button>
  </form>
  </section>
  <script>
    $('#send').on('click',function(){
      if(confirm('確定更改此文章？')){
        $('#update_article').submit();
      }else{
        return false;
      }
      return false;
    });

    $('#back').on('click',function(){
      history.back();
    });

  </script>
@endsection