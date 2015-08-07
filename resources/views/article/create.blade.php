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
  <form method='post' action='create'>
      <input type='hidden' name='_token' value='{!! csrf_token() !!}'>
      <div class="form-group">
        <label for="exampleInputEmail1">標題</label>
        <input type="text" class="form-control" id="title" name='title' placeholder="標題" value="{{Request::old('title')}}">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">關鍵字</label>
        <input type="text" class="form-control" id="keyword" name='keyword' placeholder="關鍵字" value="{{Request::old('keyword')}}">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">內容</label>
        <textarea id='body' class='form-control' name='body' rows='20'>{!! Request::old('body') !!}</textarea>
      </div>
      <input type='submit' value='送出' class='btn btn-default'>
  </form>
  </section>
@endsection