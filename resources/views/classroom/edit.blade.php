@extends('layouts.master')

@section('title' , 'edit')
@section('content')

<div class="container p-5">
    <h1>Edit Classroom</h1>
    <form action="{{ route('classrooms.update' , $classroom->id) }}" method="post" enctype="multipart/form-data">

        @csrf
        <!-- form method spoofing -->
        <input type="hidden" name="_method" value="put">
        {{ method_field('put')}}


        @include('classroom._form' , [
        'button_label' => 'update Classroom'
        ])

    </form>
</div>

@endsection