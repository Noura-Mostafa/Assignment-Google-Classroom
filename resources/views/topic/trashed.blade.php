<x-main-layout title="{{__('Trashed Topic')}}">


<div class="container pt-5">
  <h1> RestoredTopics</h1>
  <div class="row mt-4">
    @foreach($topics as $topic)
    <div class="col-lg-4 col-md-3">
      <div class="card" style="width: 18rem;">
        {{--<img src="..." class="card-img-top" alt="...">--}}
        <div class="card-body">
          <h5 class="card-title">{{ $topic->name }}</h5>
          <div class="actions d-flex justify-content-between p-2">
            
          <form action="{{ route('topics.restore' , $topic->id) }}" method="post">
              @csrf
              @method('put')
              <button type="submit" class="btn btn-success">Restore</button>
            </form>
          
          
          
          <form action="{{ route('topics.force-delete' , $topic->id) }}" method="post">
              @csrf
              @method('delete')
              <button type="submit" class="btn btn-danger">Delete forever</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    @endforeach
  </div>
</div>

</x-main-layout>
