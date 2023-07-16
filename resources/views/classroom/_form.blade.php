<div class="form-floating mb-3">
    <input type="text" value="{{old('name' , $classroom->name)}}" @class(['form-control' , 'is-invalid'=> $errors->has('name')]) name="name" id="name" placeholder="Class Name">
    <label for="name">Class Name</label>
    @error('name')
    <div class="invalid-feedback">{{$message}}</div>
    @endError
</div>

<div class="form-floating mb-3">
    <input type="text" value="{{old('subject' , $classroom->section)}}" @class(['form-control' , 'is-invalid'=> $errors->has('section')]) name="section" id="section" placeholder="Section">
    <label for="section">Section</label>
    @error('section')
    <div class="invalid-feedback">{{$message}}</div>
    @endError
</div>

<div class="form-floating mb-3">
    <input type="text" value="{{old('subject' , $classroom->subject)}}" @class(['form-control' , 'is-invalid'=> $errors->has('subject')]) name="subject" id="subject" placeholder="Subject">
    <label for="subject">Subject</label>
    @error('subject')
    <div class="invalid-feedback">{{$message}}</div>
    @endError
</div>

<div class="form-floating mb-3">
    <input type="text" value="{{old('room' , $classroom->room)}}" name="room" id="room" placeholder="Class room" @class(['form-control' , 'is-invalid'=> $errors->has('room')])>
    <label for="room">Room</label>
    @error('room')
    <div class="invalid-feedback">{{$message}}</div>
    @endError
</div>

<div class="form-floating mb-3">
    @if($classroom->cover_image_path)
    <img src="{{ asset('uploads/' . $classroom->cover_image_path) }}" class="card-img-top" alt="...">
    @endif
    <input type="file" value="{{old('cover_image' , $classroom->cover_image)}}" name="cover_image" id="cover_image" @class(['form-control' , 'is-invalid'=> $errors->has('cover_image')])>
    <label for="cover_image">Cover Image</label>
    @error('cover_image')
    <div class="invalid-feedback">{{$message}}</div>
    @endError
</div>
<div class="form-floating mb-3">
    <button class="btn btn-success" type="submit">{{$button_label}}</button>
</div>