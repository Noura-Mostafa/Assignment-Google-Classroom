@extends('layouts.master')

@section('title' , 'topics')
@section('content')
<div class="container p-5">
  <h1>Topics</h1>
  <div class="row">
    @foreach($topic as $topic)
    <div class="col-lg-4 col-md-3">
      <div class="card mb-2" style="width: 18rem;">
        {{--<img src="..." class="card-img-top" alt="...">--}}
        <div class="card-body">
          <h5 class="card-title">{{ $topic->name }}</h5>
          <div class="actions d-flex justify-content-between p-2">
            <a href="{{ route('topics.show' , $topic->id) }}" class="btn btn-success">Show</a>
            <a href="{{ route('topics.edit' , $topic->id) }}" class="btn btn-secondary">Edit</a>
            <form action="{{ route('topics.destroy' , $topic->id) }}" method="post">
              @csrf
              @method('delete')
              <button type="submit" class="btn btn-warning">Delete</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    @endforeach
  </div>
</div>

@endsection