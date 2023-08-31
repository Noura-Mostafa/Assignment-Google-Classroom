<li class="nav-item dropdown">
    <a class="nav-link fs-6 dropdown-toggle text-secondary" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        @if ($unreadCount)
       <span class="badge bg-success">{{$unreadCount}}</span>
        @endif 
        Notifications
    </a>
    <ul class="dropdown-menu">
        @forelse($notifications as $notification)
        <li class="p-2">
            <a class="dropdown-item" href="{{$notification->data['link']}}?nid={{$notification->id}}">
            @if ($notification->unread()) <b>*</b>
            @endif           
            {{$notification->data['body']}}
            <br>
            <small class="text-muted">{{$notification->created_at->diffForHumans()}}</small>
        </a>
   
    @empty
    <p class="text-success text-center">No Notifications</p>
    @endforelse
    <a href="{{route('notifications')}}" class="text-success">{{__('see all notifications')}}</a>
    </li>
    </ul>
</li>