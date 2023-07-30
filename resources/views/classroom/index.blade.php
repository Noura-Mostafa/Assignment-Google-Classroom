<x-main-layout title="Classrooms">

  <div class="container pt-5">
    <div style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}" class="text-decoration-none text-dark fs-4">Dashboard</a></li>
        <li class="breadcrumb-item active fs-4" aria-current="page">Classrooms</li>
      </ol>
    </div>
    <x-alert name="success" id="success" />
    <x-alert name="error" id="error" />

    <div class="row">
      @foreach($classrooms as $classroom)
      <div class="col-lg-3 col-md-6">
        <div class="card mb-4" style="width: 19rem;">
          <img src="{{$classroom->cover_image_url}}" class="card-img-top h-50" height="100" width="21rem" alt="...">
          <div class="container">
            <div class="top-content h-50 pt-2">
              <a href="#" class="d-block text-black fs-4">{{ $classroom->name }}</a>
              <a href="#" class="d-block text-black fs-6">{{ $classroom->section }} - {{ $classroom->room }}</a>
            </div>
            <div class="actions d-flex justify-content-end pb-3 mt-3">
              <a href="{{ $classroom->url }}" class="btn btn-success btn-sm me-1">Show</a>
              <a href="{{ route('classrooms.edit' , $classroom->id) }}" class="btn btn-secondary btn-sm me-1">Edit</a>
              <form action="{{route('classrooms.destroy' , $classroom->id)}}" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-warning btn-sm">Delete</button>
              </form>
            </div>
          </div>
        </div>      
      </div>
        @endforeach

    </div>
  </div>

</x-main-layout>




{{-- <x-classroomCard 
        name="{{$classroom->name}}"
section="{{$classroom->section}}"
room="{{$classroom->room}}"
show="{{route('classrooms.show' , $classroom->id)}}"
edit="{{route('classrooms.edit' , $classroom->id)}}"
delete="{{route('classrooms.destroy' , $classroom->id)}}"
cover="{{$classroom->cover_image_url}}" />
</div>--}}