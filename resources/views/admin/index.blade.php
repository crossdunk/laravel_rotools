@extends('layouts.master')

@section('content')
<style>
  section{
    margin-top: 30px;
  }
</style>
  <section>
    <table class='table table-bordered'>
      <thead><tr><th>編號</th><th>名稱</th><th>Email</th><th>權限</th><th>功能</th></tr></thead>
      @foreach($users as $user)
        <tr><td>{{ $user->id }}</td><td>{{ $user->name }}</td><td>{{ $user->permission }}</td><td>{{ $user->email }}</td><td>
        <form method='post' action='{{ URL("admin/".$user->id) }}' id='delete{{ $user->id }}'>
          <input name="_method" type="hidden" value="DELETE">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type='submit'  alt='{{ $user->name }}' value='刪除' class='btn btn-danger delete' />
        </form>
        </td></tr>
      @endforeach
    </table>
  </section>

  <script>
    $('.delete').on('click',function(){
      var name = $(this).attr('alt');
      if(confirm('確定刪除'+ name +'?')){
        $(this).parent().submit();
      }else{
        return false;
      }
      return false;
    });
  </script>
@endsection