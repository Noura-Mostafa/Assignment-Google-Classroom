<x-main-layout title="{{__('Edit')}}">


<div class="container pt-5 text-center">
  <div style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('classrooms.index')}}" class="text-decoration-none text-dark fs-4">{{$classroom->name}}</a></li>
      <li class="breadcrumb-item active fs-4" aria-current="page">{{__('Edit')}}</li>
    </ol>
  </div>

  <div class="d-flex justify-content-between">
     <form action="{{ route('classrooms.update' , $classroom->id) }}" method="post" enctype="multipart/form-data" class="w-50">

    @csrf

    <input type="hidden" name="_method" value="put">
    {{ method_field('put')}}


    @include('classroom._form' , [
    'button_label' => 'update Classroom'
    ])

  </form>

  <div class="img">
  @if($classroom->cover_image_path)
    <h4>Cover Image</h4>
    <img src="{{ asset('uploads/' . $classroom->cover_image_path) }}" class="card-img-top  rounded"  alt="..." >
    @endif
  </div>
  </div>
 
</div>

</x-main-layout>