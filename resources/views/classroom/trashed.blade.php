<x-main-layout title="Trashed Classrooms">

  <div class="container pt-5">
  <div style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('classrooms.index')}}" class="text-decoration-none text-dark fs-4">{{__('Classrooms')}}</a></li>
    <li class="breadcrumb-item active fs-4" aria-current="page">{{__('Trashed')}}</li>
  </ol>
</div>


    <x-alert name="success" id="success" />
    <x-alert name="error" id="error" />


    <div class="row">
      @foreach($classrooms as $classroom)
      <div class="col-lg-3 col-md-6">
        <div class="card" style="width: 19rem;">
          <img src="{{ asset('uploads/' . $classroom->cover_image_path)}}" class="card-img-top" alt="...">
          <div class="container">
            <div class="top-content h-50 pt-2">
              <a href="#" class="d-block text-black fs-4">{{ $classroom->name }}</a>
              <a href="#" class="d-block text-black fs-6">{{ $classroom->section }} - {{$classroom->room}}</a>
            </div>
            <div class="actions d-flex justify-content-end pb-3 mt-3">
              <form action="{{ route('classrooms.restore' , $classroom->id) }}" method="post">
                @csrf
                @method('put')
                <button type="submit" class="btn btn-success btn-sm me-1">{{__('Restore')}}</button>
              </form>

              <form action="{{ route('classrooms.force-delete' , $classroom->id) }}" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger btn-sm me-1">{{__('Delete forever')}}</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      @endforeach
    </div>
  </div>

</x-main-layout>