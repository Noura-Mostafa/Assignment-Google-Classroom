<x-main-layout title="{{__('Notifications')}}">

    <div class="container p-5 w-50 m-auto">
        <h2 class="text-center mb-2">{{__('Notifications')}}</h2>

        @foreach($notifications as $notification)
        <div class="p-4 bg-success-subtle mb-2">
            <h6>
                <a class="text-decoration-none text-dark" href="{{$notification->data['link']}}?nid={{$notification->id}}">
                    @if ($notification->unread()) <b>*</b>
                    @endif
                    {{$notification->data['body']}}
                    <br>
                    <small class="text-muted">{{$notification->created_at->diffForHumans()}}</small>
                </a>
            </h6>
        </div>
        @endforeach
    </div>

</x-main-layout>