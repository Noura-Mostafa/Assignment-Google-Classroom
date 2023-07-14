@extends('layouts.master')

@section('title' , 'create')
@section('content')

<div class="container p-5">
    <h1>Create Topic</h1>
    <form action="{{ route('topics.store') }}" method="post">

        @csrf

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="name" placeholder="topic name" name="name">
            <label for="name">Topic Name</label>
        </div>
        <div class="form-floating mb-3">
            <select name="classroom_id" id="classroom_id" class="form-control" required autofocus>
                <option value="">Select Classroom</option>
                @foreach ($classroom as $classroom)
                <option value="{{$classroom->id}}">{{$classroom->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-floating mb-3">
            <input type="hidden" class="form-control" id="user_id" value="" name="user_id">
        </div>
        <div class="form-floating mb-3">
            <button type="submit" class="btn btn-success">Create Topic</button>
        </div>
    </form>
</div>

@endsection