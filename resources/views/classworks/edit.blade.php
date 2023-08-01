<x-main-layout title="Edit Classswork">


    <div class="container pt-5">
        <h1>{{ $classroom->name }}</h1>
        <h3>Edit Classworks</h3>
        <hr>

        <form action="{{ route('classrooms.classworks.update' , [$classroom->id , $classwork->id]) }}" method="post">
            @csrf
            @method('put')
            
            <x-form.floating-control name="title" value="{{$classwork->title}}">
                <x-slot:label>
                    <label for="title">Title</label>
                </x-slot:label>
                <x-form.input name="title" placeholder="Title" value="{{$classwork->title}}"/>
            </x-form.floating-control>

            <x-form.floating-control name="description" placeholder="Description (optional)">
                <x-slot:label>
                    <label for="description">Description (optional)</label>
                </x-slot:label>
                <x-form.textinput name="description" placeholder="Description (optional)" value="{{$classwork->description}}"/>
            </x-form.floating-control>

            <x-form.floating-control name="topic_id">
                <x-slot:label>
                    <label for="topic_id">Topic (optional)</label>
                </x-slot:label>
                <select name="topic_id" id="topic_id" class="form-select">
                    @foreach ($classroom->topics as $topic)
                    <option value="{{ $topic->id }}">{{ $topic->name }}</option>
                    @endforeach
                </select>
            </x-form.floating-control>

            <button type="submit" class="btn btn-success">Update</button>

        </form>

    </div>


</x-main-layout>