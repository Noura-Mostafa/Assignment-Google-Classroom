<li class="nav-item dropdown">
    <a class="nav-link fs-6 dropdown-toggle text-secondary" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        @if ($unreadCount)
       <span class="badge bg-success">{{$unreadCount}}</span>
        @endif 
        <i class="fas fa-bell"></i>
    </a>
    <ul class="dropdown-menu p-1">
        @forelse($notifications as $notification)
        <li>
            <a class="dropdown-item" href="{{$notification->data['link']}}?nid={{$notification->id}}">
            @if ($notification->unread()) <b>*</b>@endif           

            <small>{{$notification->data['body']}}</small>
            <br>
            <small class="text-muted">{{$notification->created_at->diffForHumans()}}</small>
        </a>
   
    @empty
    <small class="text-muted text-center">No Notifications</small>
    @endforelse
    <a href="{{route('notifications')}}" class="text-center text-muted text-sm">{{__('see all')}}</a>
    </li>
    </ul>
</li>