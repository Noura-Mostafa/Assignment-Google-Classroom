<x-main-layout title="Create Classswork">


    <div class="container pt-5 d-flex flex-column align-items-center">

        <div style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('classrooms.show' , $classroom->id)}}" class="text-decoration-none text-dark fs-4">{{ $classroom->name }}</a></li>
                <li class="breadcrumb-item active fs-4" aria-current="page">Create Classworks</li>
            </ol>
        </div>
        <hr class="text-success">

        <form class="w-75" action="{{ route('classrooms.classworks.store' , [$classroom->id , 'type' => $type]) }}" method="post">
            @csrf

            <div class="row">
                <div class="col-lg-8">
                    <x-form.floating-control name="title" placeholder="Classroom Name">
                        <x-slot:label>
                            <label for="title">Title</label>
                        </x-slot:label>
                        <x-form.input name="title" placeholder="Title" />
                    </x-form.floating-control>

                    <x-form.floating-control name="description" placeholder="Description (optional)">
                        <x-slot:label>
                            <label for="description">Description (optional)</label>
                        </x-slot:label>
                        <x-form.textarea name="description" placeholder="Description (optional)" />
                    </x-form.floating-control>

                </div>

                <div class="col-lg-4">
                    <div class="dropdown mb-3">
                        <button class="btn btn-outline-success dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Students
                        </button>
                        <ul class="dropdown-menu">
                            <li class="p-2">
                                <a class="dropdown-item" href="#">
                                    @foreach($classroom->students as $student)
                                    <div class="form-check">
                                        <input class="form-check-input" name="students[]" type="checkbox" value="{{$student->id}}" id="std-{{$student->id}}" checked>
                                        <label class="form-check-label" for="std-{{$student->id}}">
                                            {{$student->name}}
                                        </label>
                                    </div>
                                    @endforeach
                                </a>
                            </li>
                        </ul>
                    </div>


                    <x-form.floating-control name="topic_id" placeholder="Classroom Name">
                        <x-slot:label>
                            <label for="topic_id">Topic (optional)</label>
                        </x-slot:label>
                        <select name="topic_id" id="topic_id" class="form-select">
                            <option value="">No topic</option>
                            @foreach ($classroom->topics as $topic)
                            <option value="{{ $topic->id }}">{{ $topic->name }}</option>
                            @endforeach
                        </select>
                    </x-form.floating-control>


                </div>

            </div>
            <button type="submit" class="btn btn-success rounded-pill">Create {{$type}}</button>


        </form>

    </div>

</x-main-layout>