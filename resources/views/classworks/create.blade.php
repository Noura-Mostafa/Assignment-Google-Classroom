<x-main-layout title="Create Classswork">


    <div class="container pt-5">
        <h1>{{ $classroom->name }}</h1>
        <h3>Create Classworks</h3>
        <hr>

        <form action="{{ route('classrooms.classworks.store' , [$classroom->id , 'type' => $type]) }}" method="post">
            @csrf
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
                <x-form.textinput name="description" placeholder="Description (optional)" />
            </x-form.floating-control>

            <x-form.floating-control name="topic_id" placeholder="Classroom Name">
                <x-slot:label>
                    <label for="topic_id">Topic (optional)</label>
                </x-slot:label>
                <select name="topic_id" id="topic_id" class="form-select">
                    <option value="" disabled>No option</option>
                    @foreach ($classroom->topics as $topic)
                    <option value="{{ $topic->id }}">{{ $topic->name }}</option>
                    @endforeach
                </select>
            </x-form.floating-control>

            <button type="submit" class="btn btn-success">Create</button>

        </form>

    </div>


</x-main-layout>