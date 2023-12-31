<x-main-layout title="{{__('Topics')}}">


<div class="container pt-5">
<div class="container d-flex justify-content-between">
    <h1 class="mb-4">Topics</h1>
    <a class="text-secondary text-decoration-none fs-5" href="{{route('topics.trashed')}}">Trashed</a>
    </div>   
  <div class="row mt-4">
    @foreach($topic as $topic)
    <div class="col-lg-4 col-md-3">
      <div class="card mb-4" style="width: 18rem;">
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

</x-main-layout>