<x-main-layout title="Trashed Classrooms">


  <div class="container p-5">
    <h1>Trashed Classrooms</h1>

    <x-alert name="success" id="success" />
    <x-alert name="error" id="error" />


    <div class="row">
      @foreach($classrooms as $classroom)
      <div class="col-lg-3 col-md-6">
        <div class="card" style="width: 18rem; height: 18rem;">
          <img src="{{ asset('uploads/' . $classroom->cover_image_path)}}" class="card-img-top" alt="...">
          <div class="top-content h-50 p-3 pt-4">
            <a href="#" class="d-block text-black fs-4">{{ $classroom->name }}</a>
            <a href="#" class="d-block text-black fs-5">{{ $classroom->section }}</a>
            <a href="#" class="d-block text-black fs-6">{{ $classroom->room }}</a>
          </div>
          <div class="actions d-flex justify-content-between p-2">
            <form action="{{ route('classrooms.restore' , $classroom->id) }}" method="post">
              @csrf
              @method('put')
              <button type="submit" class="btn btn-success">Restore</button>
            </form>

            <form action="{{ route('classrooms.force-delete' , $classroom->id) }}" method="post">
              @csrf
              @method('delete')
              <button type="submit" class="btn btn-danger">Delete forever</button>
            </form>
          </div>
        </div>
      </div>

      @endforeach
    </div>
  </div>





  @pushIf('true' ,'scripts')
  <script>
    console.log('@@stack')
  </script>
  @endpushIf
</x-main-layout>