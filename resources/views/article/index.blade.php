@extends('layouts.master')

@section('content')
<style>
.content{
  margin-top: 20px;
}
.article_menu{
  border-radius: 15px;
  background-color: #ACEABA;
  width:100%;
  float:left;
  margin-bottom:15px;
}
.article_menu ul{
  width:100%;
  margin:auto;
}
.article_menu ul li{
  padding:5px;
  list-style-type:none;
  margin-right: 15px;
  float:right;

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
    <nav class='article_menu'>
      <ul>
        <li><a class='btn btn-info' href='article/create'>發表文章</a></li>
        <li><input type='text' name='search_article' id='search_article'  />  <button class='btn btn-info' id='search'>搜尋文章</button></li>
      </ul>
    </nav>
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
              {!! nl2br($article->body) !!}
            </div>
          </div>
        </div>
      @endforeach
  </section>
  <script>
  $('#search').on('click',function(){
    var keyword = $('#search_article').val();
    console.log(keyword);
  });
</script>
@endsection

