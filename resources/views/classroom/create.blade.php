@extends('layouts.master')

@section('title' , 'create')
@section('content')

<div class="container p-5">
    <h1>Create Classroom</h1>

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('classrooms.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        @include('classroom._form' , [
        'button_label' => 'Create Classroom'
        ])


    </form>
</div>

@endsection