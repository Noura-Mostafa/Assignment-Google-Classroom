@include('partials.header')

    <div class="container p-5">
        <h1>Edit Classroom</h1>
        <form action="{{ route('classrooms.update' , $classroom->id) }}" method="post">
            {{--
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                {{ csrf_field() }}
            --}}
           
            @csrf
            <!-- form method spoofing -->
            <input type="hidden" name="_method" value="put">
            {{ method_field('put')}}


        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="name" value="{{ $classroom->name }}" name="name">
            <label for="name">Class Name</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="section" value="{{ $classroom->section }}" name="section">
            <label for="name">Section</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="subject" value="{{ $classroom->subject }}" name="subject">
            <label for="subject">Subject</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="room" value="{{ $classroom->room }}" name="room">
            <label for="room">Room</label>
        </div>
        <div class="form-floating mb-3">
            <input type="file" class="form-control" id="cover_image" value="{{ $classroom->cover_image }}" name="cover_image">
            <label for="cover_image">Cover Image</label>
        </div>
        <div class="form-floating mb-3">
            <button class="btn btn-success">Update Classrrom</button>
        </div>
        </form>
    </div>

@include('partials.footer')