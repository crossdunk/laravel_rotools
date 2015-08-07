@extends('layouts.master')

@section('content')
<style>
body{
  font-family: '微軟正黑體';
}
.content{
  margin-top: 20px;
}
.top_nav{
  border-radius: 15px;
  background-color: #B0F1C6;
  padding:5px;
  margin-bottom: 15px;
}
.top_nav .keyword{
  font-weight: 900;
  font-size: 24px;
  padding:5px;
}
.article_menu .keyword_bar{
  padding:10px;
  font-size: 24px;
  float:left;
  font-weight: 900;
}
.block{
  margin-bottom: 15px;
}
.article{
  height: 200px;
  overflow: hidden;
  border-radius: 15px;
  padding:5px;
  border:solid 3px;
  background-color: #F7F5F5;
  -webkit-transition: border-color 0.5s;
}
.article:hover{
  border-color: #8EF8C4;
}
.article_title{
  padding:5px;
  min-height: 30px;
  border-radius: 15px;
  text-align: center;
  width:100%;
  background-color: #D94141;
  color:white;
  font-weight: 900;
}
.article_title a{
  text-decoration: none;
  color:white;
}
.user_name{
  text-align: left;
  font-weight: 300;
}
.created_at{
  text-align: right;
  font-weight: 300;
}
.article_body{
  margin-top: 10px;
  font-weight: 300;
}
</style>
  <section class='content'>
    <div class='nav col-md-12 top_nav'>
      <div  class='col-md-8 keyword'><?=$keyword?></div>
      <div  class='col-md-3'><input type='text' name='search_article' id='search_article'  />  <button class='btn btn-info' id='search'>搜尋文章</button></div>
      <div class='col-md-1'><a class='btn btn-info' href='article/create'>發表文章</a></div>
    </div>
      <?php
        if(!is_null(Session::get('warning'))){
          echo "<p class='text-danger'>".Session::get('warning')."</p>";
        }
        if(!is_null(Session::get('success'))){
          echo "<p class='text-success'>".Session::get('success')."</p>";
        }
        ?>
      @foreach($articles as $article)
        <div class='col-md-4 block'>
          <div class='article'>
            <div class='article_title'>
              <a href='{{ URL("article/".$article->id) }}'>{{ $article->title }}</a>
              <div class='row'>
                <div class='user_name col-md-6'>
                  作者：{{ $article->name }}
                </div>
                <div class='created_at col-md-6'>
                  {{ $article->created_at }}
                </div>
              </div>
            </div>
            <div class='article_body'>
              {!! nl2br(e($article->body)) !!}
            </div>
          </div>
        </div>
      @endforeach
  </section>
  <script>
  $('#search').on('click',function(){
    var keyword = $('#search_article').val();
    if(keyword==''){

    }else{
      location.href = "<?=URL('article/"+ keyword +"/keyword')?>";
    }
    
  });
</script>
@endsection

