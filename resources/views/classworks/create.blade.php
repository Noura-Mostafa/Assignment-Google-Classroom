<x-main-layout title="Create Classswork">


    <div class="container pt-5 d-flex flex-column align-items-center">

        <div style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('classrooms.show' , $classroom->id)}}" class="text-decoration-none text-dark fs-4">{{ $classroom->name }}</a></li>
                <li class="breadcrumb-item active fs-4" aria-current="page">{{__('Create Classworks')}}</li>
            </ol>
        </div>
        <hr class="text-success">

        <form class="w-75" action="{{ route('classrooms.classworks.store' , [$classroom->id , 'type' => $type]) }}" method="post">
            @csrf

            @include('classworks._form' ,[
                'button' => 'Create '])
            
        </form>

    </div>

</x-main-layout>