@extends('layouts.app')

@section('content')
<div class="album py-5 bg-light">
  <div class="container">

    <div class="row">
      @foreach ($posts as $post)
      <div class="col-md-4">
        <div class="card mb-4 box-shadow">
          <img class="card-img-top" src="{{asset('images/post/'.$post->image_path)}}" alt="Card image cap"
               style="height: 250px">
          <div class="card-body" style="height:  116px;">
            <p class="card-text" style="text-align: right;direction:  rtl;">{{$post->body}}</p>
            <br>
          </div>
          <div class="card-footer">
            <div class="d-flex justify-content-between align-items-center">
              <form action="{{route('post.destroy', $post->id)}}" method="POST">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
                <div class="btn-group">
                  <a class="btn btn-sm btn-outline-secondary" href="{{route('post.show', $post->id)}}">عرض</a>
                  <a class="btn btn-sm btn-outline-secondary" href="{{route('post.edit', $post->id)}}">تعديل</a>
                  <button class="btn btn-sm btn-outline-secondary" >حذف</button>
                </div>
              </form>
              <small class="text-muted">{{$post->created_at}}</small>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
      {{ null !== $posts ? $posts->links("pagination::bootstrap-4") : ''  }}

  </div>
</div>
@endsection
