@extends('layouts.master')

@section('title' , 'edit')
@section('content')

<div class="container p-5">
    <h1>Edit Topic</h1>
    <form action="{{ route('topics.update' , $topic->id) }}" method="post">
        {{--
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
        {{ csrf_field() }}
        --}}

        @csrf
        <!-- form method spoofing -->
        <input type="hidden" name="_method" value="put">
        {{ method_field('put')}}


        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="name" value="{{ $topic->name }}" name="name">
            <label for="name">topic Name</label>
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
            <button type="submit" class="btn btn-success">Update Topic</button>
        </div>
    </form>
</div>

@endsection