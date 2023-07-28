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
        <x-classroomCard name="{{$classroom->name}}" section="{{$classroom->section}}" room="{{$classroom->room}}" show="{{route('classrooms.show' , $classroom->id)}}" edit="{{route('classrooms.edit' , $classroom->id)}}" delete="{{route('classrooms.destroy' , $classroom->id)}}" cover="{{$classroom->cover_image_path}}" />
      </div>
      @endforeach
    </div>
  </div>
  </div>

</x-main-layout>