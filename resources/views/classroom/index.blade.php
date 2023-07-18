<x-main-layout title="Classrooms">

<div class="class-container p-5 min-vw-100 h-100">
  <div class="container">
    <h1 class="mb-4">My Classrooms</h1>

  <x-alert name="success" id="success" />
  <x-alert name="error" id="error" />

    <div class="row">
      @foreach($classrooms as $classroom)
      <div class="col-lg-3 col-md-6">
      <x-classroomCard 
      name="{{$classroom->name}}" 
      section="{{$classroom->section}}" 
      room="{{$classroom->room}}" 
      show="{{route('classrooms.show' , $classroom->id)}}" 
      edit="{{route('classrooms.edit' , $classroom->id)}}" 
      delete="{{route('classrooms.destroy' , $classroom->id)}}" 
      cover="{{$classroom->cover_image_path}}" />
      </div>
      @endforeach
    </div>
  </div>
</div>

</x-main-layout>