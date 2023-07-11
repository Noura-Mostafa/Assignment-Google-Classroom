@include('partials.header')


<div class="class-container p-5 min-vw-100 h-100">
  <div class="container">
    <div class="row">
      @foreach($classrooms as $classroom)
      <div class="col-lg-3 col-md-6">
        <div class="card position-relative" style="width: 18rem; height: 18rem;">
          <div class="top-content h-50 p-3 pt-4 text-white">
            <a href="#" class="d-block text-black text-white fs-4">{{ $classroom->name }}</a>
            <a href="#" class="d-block text-black text-white fs-5">{{ $classroom->section }}</a>
            <a href="#" class="d-block text-black text-white fs-6">{{ $classroom->room }}</a>
          </div>
          {{--<img class="person position-absolute top-50 end-0 rounded-circle me-2" src="imgs/pexels-daniel-xavier-1239291.jpg" alt="">--}}
          <div class="card-body p-3 h-50">
            <div class="actions d-flex justify-content-between p-2">
            <a href="{{ route('classrooms.show' , $classroom->id) }}" class="btn btn-success">Show</a>
            <a href="{{ route('classrooms.edit' , $classroom->id) }}" class="btn btn-secondary">Edit</a>
            <form action="{{ route('classrooms.destroy' , $classroom->id) }}" method="post">
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
</div>

@include('partials.footer')