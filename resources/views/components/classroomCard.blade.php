@props([

'name' , 'section' , 'room' , 'show' , 'edit' , 'delete' , 'cover'

])

<div class="card mb-4" style="width: 19rem;">
    <img src="{{ asset('uploads/' . $cover)}}" class="card-img-top h-50" height="100" width="21rem"  alt="...">
    <div class="container">
        <div class="top-content h-50 pt-2">
        <a href="#" class="d-block text-black fs-4">{{ $name }}</a>
        <a href="#" class="d-block text-black fs-6">{{ $section }} - {{ $room }}</a>
    </div>
    <div class="actions d-flex justify-content-end pb-3 mt-3">
        <a href="{{ $show }}" class="btn btn-success btn-sm me-1">Show</a>
        <a href="{{ $edit }}" class="btn btn-secondary btn-sm me-1">Edit</a>
        <form action="{{ $delete }}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-warning btn-sm">Delete</button>
        </form>
    </div> 
    </div>
</div>