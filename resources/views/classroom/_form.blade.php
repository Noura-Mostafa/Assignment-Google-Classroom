<x-form.floating-control name="name" placeholder="Classroom Name">
    <x-slot:label>
    <label for="name">Classroom Name</label>
    </x-slot:label>
    <x-form.input name="name" value="{{$classroom->name}}" placeholder="Class name" />
</x-form.floating-control>


<x-form.floating-control name="section" placeholder="Section">
    <x-slot:label>
    <label for="section">Section</label>
    </x-slot:label>
    <x-form.input name="section" value="{{$classroom->section}}" placeholder="Section" />
</x-form.floating-control>



<x-form.floating-control name="subject" placeholder="Subject">
    <x-slot:label>
    <label for="subject">Subject</label>
    </x-slot:label>
    <x-form.input name="subject" value="{{$classroom->subject}}" placeholder="subject" />
</x-form.floating-control>


<x-form.floating-control name="room" placeholder="Room">
    <x-slot:label>
    <label for="room">Room</label>
    </x-slot:label>
    <x-form.input name="room" value="{{$classroom->room}}" placeholder="Room" />
</x-form.floating-control>


<x-form.floating-control name="cover_image" placeholder="cover Image">
    <x-slot:label>
    <label for="cover_image">Cover Image</label>
    </x-slot:label>
    <x-form.input name="cover_image" value="{{$classroom->cover_image}}" placeholder="Cover Image" type="file" />
</x-form.floating-control>


<div class="form-floating mb-3">
    <button class="btn btn-success" type="submit">{{$button_label}}</button>
</div>