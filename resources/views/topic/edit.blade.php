@extends('layouts.master')

@section('title' , 'edit')
@section('content')

<div class="container p-5">
    <h1>Edit Topic</h1>
    <form action="{{ route('topics.update' , $topic->id) }}" method="post">

        @csrf
        <!-- form method spoofing -->
        <input type="hidden" name="_method" value="put">
        {{ method_field('put')}}

        @include('topic._form' , [
        'button_label' => 'Update Topic'
        ])
        
    </form>
</div>

@endsection