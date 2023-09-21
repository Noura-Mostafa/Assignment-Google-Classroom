<x-main-layout title="{{__('Create')}}">


<div class="container pt-5 d-flex flex-column align-items-center text-center">
<div style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('classrooms.index')}}" class="text-decoration-none text-dark fs-4">{{__('Classrooms')}}</a></li>
      <li class="breadcrumb-item active fs-4" aria-current="page">{{__('Create')}}</li>
    </ol>
  </div>
    <x-errorbox />

    <form action="{{ route('classrooms.store') }}" method="post" enctype="multipart/form-data" class="w-50">
        @csrf

        @include('classroom._form' , [
        'button_label' => 'Create Classroom'
        ])


    </form>
</div>

</x-main-layout>