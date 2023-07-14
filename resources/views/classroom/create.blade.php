@extends('layouts.master')

@section('title' , 'create')
@section('content')

<div class="container p-5">
    <h1>Create Classroom</h1>
    <form action="{{ route('classrooms.store') }}" method="post" enctype="multipart/form-data">
        {{--
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
        {{ csrf_field() }}
        --}}

        @csrf

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="name" placeholder="class name" name="name">
            <label for="name">Class Name</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="section" placeholder="section name" name="section">
            <label for="name">Section</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="subject" placeholder="section name" name="subject">
            <label for="subject">Subject</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="room" placeholder="section name" name="room">
            <label for="room">Room</label>
        </div>
        <div class="form-floating mb-3">
            <input type="file" class="form-control" id="cover_image" name="cover_image">
            <label for="cover_image">Cover Image</label>
        </div>
        <div class="form-floating mb-3">
            <button type="submit" class="btn btn-success">Create Classroom</button>
        </div>
    </form>
</div>

@endsection