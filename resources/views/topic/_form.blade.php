<div class="form-floating mb-3">
    <input type="text" value="{{old('name' , $topic->name)}}" @class(['form-control' , 'is-invalid'=> $errors->has('name')]) id="name" name="name">
    <label for="name">topic Name</label>
    @error('name')
    <div class="invalid-feedback">{{$message}}</div>
    @endError
</div>
<div class="form-floating mb-3">
    <select name="classroom_id" id="classroom_id" value="{{old('classroom_id' , $topic->classroom_id)}}" @class(['form-control' , 'is-invalid'=> $errors->has('classroom_id')])>
        <option value="">Select Classroom</option>
        @foreach ($classroom as $classroom)
        <option value="{{$classroom->id}}">{{$classroom->name}}</option>
        @endforeach
    </select>
    @error('classroom_id')
    <div class="invalid-feedback">{{$message}}</div>
    @endError
</div>
<div class="form-floating mb-3">
    <input type="hidden" class="form-control" id="user_id" value="" name="user_id">
</div>
<div class="form-floating mb-3">
    <button type="submit" class="btn btn-success">{{$button_label}}</button>
</div>