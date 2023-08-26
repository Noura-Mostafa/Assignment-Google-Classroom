@extends('layouts.secondNav')

@section('title' , 'People')
@section('content')

    <div class="container p-5">
        <div style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('classrooms.index')}}" class="text-decoration-none text-dark fs-4">{{$classroom->name}}</a></li>
                <li class="breadcrumb-item active fs-4" aria-current="page">{{__('People')}}</li>
            </ol>
        </div>

        <x-alert name="success" id="success" />
        <x-alert name="error" id="error" />


        <table class="table border">
            <thead>
                <tr role="row">
                    <th></th>
                    <th>{{__('Name')}}</th>
                    <th>{{__('Role')}}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($classroom->users()->orderBy('name')->get() as $user)
                <tr role="row">
                    <td></td>
                    <td>{{$user->name}}</td>
                    <td>{{__($user->pivot->role)}}</td>
                    <td>
                        <form action="{{route('classrooms.people.destroy', $classroom->id)}}" method="post">
                            @csrf
                            {{method_field("DELETE")}}
                            <input type="hidden" name="user_id" value="{{$user->id}}">
                            <button type="submit" class="btn btn-sm btn-danger">{{__('ٌRemove')}}</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>




@endsection