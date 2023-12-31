@extends('layouts.secondNav')

@section('title' , $classroom->name)
@section('content')


<div class="container pt-5">
    <div class="row">

        <div class="col-lg-3  p-5">
            <div>
                @can('create' , ['App\Models\Topic'])
                <a href="{{route('topics.create' , $classroom->id)}}" class="btn btn-outline-success rounded-pill mb-4">{{__('Create Topic')}}</a>

                <h5 class="text-success">{{__('All topics')}}</h5>
                @foreach ($classroom->topics as $topic)
                <h6>{{__($topic->name)}}</h6>
                @endforeach

                @else
                <div class="border rounded p-3">
                    <h6 class="text-success fw-bold">Dear Student , {{Auth::user()->name}}</h6>
                    <p class="text-muted">
                        Keep attention to your classworks
                    </p>
                </div>
                <div class="border rounded p-3 mt-4">
                    <h6 class="text-success fw-bold">Existing Topic</h6>
                    @foreach ($classroom->topics as $topic)
                    <h6>{{__($topic->name)}}</h6>
                    @endforeach
                </div>
                @endcan

            </div>
        </div>

        <div class="col-lg-9">
            <div style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('classrooms.show' , $classroom->id)}}" class="text-decoration-none text-dark fs-4">{{ $classroom->name }}</a></li>
                    <li class="breadcrumb-item active fs-4" aria-current="page">{{__('Classworks')}}</li>
                </ol>
            </div>
            @can('create' , ['App\Models\Classwork' , $classroom])
            <div class="dropdown mt-2">
                <button class="btn btn-success rounded-pill dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    + {{__('Create')}}
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('classrooms.classworks.create' , [$classroom->id , 'type' => 'assignment']) }}">{{__('Assignment')}}</a></li>
                    <li><a class="dropdown-item" href="{{ route('classrooms.classworks.create' , [$classroom->id , 'type' => 'material']) }}">{{__('Material')}}</a></li>
                    <li><a class="dropdown-item" href="{{ route('classrooms.classworks.create' , [$classroom->id , 'type' => 'question']) }}">{{__('Question')}}</a></li>
                </ul>
            </div>
            @endcan
            <hr class="text-success">

            <form action="{{ URL::current() }}" method="get" class="d-flex mb-3 justify-content-end">
                <input type="text" placeholder="{{__('Search')}}" name="search" class="form-control w-25 me-1">
                <button class="btn btn-outline-success" type="submit">{{__('Search')}}</button>
            </form>

            @forelse($classworks as $group)
            <h3 class="mt-4 text-success">{{__($group->first()->topic->name ?? '')}}</h3>
            <hr class="text-success">

            <div class="accordion accordion-flush" id="accordionFlushxample">
                @foreach($group as $classwork)
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$classwork->id}}" aria-expanded="false" aria-controls="flush-collapseThree">
                            {{$classwork->title}}
                        </button>
                    </h2>
                    <div id="flush-collapse{{$classwork->id}}" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body text-secondary">

                            <div class="row">
                                <div class="col-md-6">
                                    <h6>{!! $classwork->description !!}</h6>
                                </div>
                                @can('update' , [$classwork])
                                <div class="col-md-6 row">
                                    <div class="col-md-4">
                                        {{ $classwork->assigned_count }}
                                        <br> {{__('Assigned')}}
                                    </div>

                                    <div class="col-md-4">
                                        {{ $classwork->turnedin_count }}
                                        <br> {{__('Turned In')}}
                                    </div>

                                    <div class="col-md-4">
                                        {{ $classwork->graded_count }}
                                        <br> {{__('Graded')}}
                                    </div>
                                </div>
                            </div>
                            <div class="actions d-flex mt-3">
                                <a href="{{route('classrooms.classworks.show' , [$classroom->id , $classwork->id])}}" class="btn rounded-pill btn-sm btn-outline-success me-1">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{route('classrooms.classworks.edit' , [$classroom->id , $classwork->id])}}" class="rounded-pill btn btn-sm btn-outline-dark me-1">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <form action="{{route('classrooms.classworks.destroy',[$classroom->id , $classwork->id])}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-outline-danger rounded-pill btn-sm" type="submit"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                        @else
                        <a href="{{route('classrooms.classworks.show' , [$classroom->id , $classwork->id])}}" class="text-success ps-3">
                            view instruction
                        </a>
                        @endcan
                    </div>
                </div>
                @endforeach
            </div>
            @empty
            <small class="text-success">{{__('No Classworks Found.')}}</small>
            @endforelse
        </div>

    </div>

</div>

@push('scripts')
<script>
    var classroomId;
    classroomId = "{{$classwork->classroom_id}}";
</script>
@endpush


@endsection