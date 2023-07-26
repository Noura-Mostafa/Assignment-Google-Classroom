@props([

'name' , 'section' , 'room' , 'show' , 'edit' , 'delete' , 'cover'

])

<div class="card mb-4" style="width: 18rem; height: 18rem;">
    <img src="{{ asset('uploads/' . $cover)}}" class="card-img-top h-50"  alt="...">
    <div class="top-content h-50 p-3 pt-3">
        <a href="#" class="d-block text-black fs-4">{{ $name }}</a>
        <a href="#" class="d-block text-black fs-4">{{ $section }}</a>
        <a href="#" class="d-block text-black fs-5">{{ $room }}</a>
    </div>
    <div class="actions d-flex justify-content-around pb-3">
        <a href="{{ $show }}" class="btn btn-success">Show</a>
        <a href="{{ $edit }}" class="btn btn-secondary">Edit</a>
        <form action="{{ $delete }}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-warning">Delete</button>
        </form>
    </div>
</div>