<x-main-layout :title="$classroom->name">


    @if(session()->has('sucess'))
    <div class="alert alert-success">
        {{ $success }}
    </div>
    @endif

    <div class="container pt-5">
        <div class="row">

            <div class="col-lg-3  p-5">
                <div>
                    <h5 class="text-success">All topics</h5>
                    @foreach ($topics as $topic)
                    <h6>{{$topic->name}}</h6>
                    @endforeach
                </div>
            </div>

            <div class="col-lg-9">
                <div style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('classrooms.show' , $classroom->id)}}" class="text-decoration-none text-dark fs-4">{{ $classroom->name }}</a></li>
                        <li class="breadcrumb-item active fs-4" aria-current="page">Classworks</li>
                    </ol>
                </div>

                <div class="dropdown mt-2">
                    <button class="btn btn-success rounded-pill dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        + Create
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('classrooms.classworks.create' , [$classroom->id , 'type' => 'assignment']) }}">Assignment</a></li>
                        <li><a class="dropdown-item" href="{{ route('classrooms.classworks.create' , [$classroom->id , 'type' => 'material']) }}">Material</a></li>
                        <li><a class="dropdown-item" href="{{ route('classrooms.classworks.create' , [$classroom->id , 'type' => 'question']) }}">Question</a></li>
                    </ul>
                </div>
                <hr class="text-success">

                @forelse($classworks as $group)
                <h3 class="mt-4 text-success">{{ $group->first()->topic->name }}</h3>
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
                                <h6>{{$classwork->description}}</h6>
                                <div class="actions d-flex mt-3">
                                    <a href="{{route('classrooms.classworks.show' , [$classroom->id , $classwork->id])}}" class="btn rounded-pill btn-sm btn-outline-success me-1">
                                        View details
                                    </a>
                                    <form action="{{route('classrooms.classworks.destroy',[$classroom->id , $classwork->id])}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-outline-danger rounded-pill btn-sm me-1" type="submit">Delete</button>
                                    </form>
                                    <a href="{{route('classrooms.classworks.edit' , [$classroom->id , $classwork->id])}}" class="rounded-pill btn btn-sm btn-outline-dark">
                                        Edit
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @empty
                <p class="text-center fs-4 text-success">No Classworks Found.</p>
                @endforelse
            </div>

        </div>

    </div>


</x-main-layout>