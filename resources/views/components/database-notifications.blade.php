<div class="btn-group">
    <a class="nav-link notifications" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="far fa-bell" aria-hidden="true"></i>
        <span class="badge">{{Sentinel::getUser()->unreadNotifications->count()}}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-right">
        <!-- Dropdown header -->
        <h6 class="dropdown-header">
            You have <strong class="text-primary">{{Sentinel::getUser()->unreadNotifications->count()}}</strong> notifications.
            @if (Sentinel::getUser()->unreadNotifications->count())
                <a class="text-primary" href="{{ route('databasenotifications.markasread') }}">Mark All as Read</a>
            @endif
        </h6>
        <!-- List group -->
        <div class="list-group list-group-flush">
            @foreach (Sentinel::getUser()->unreadNotifications as $notification)
            <a href="{{ url($notification->data['actionURL']) }}" class="list-group-item">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-1">{{$notification->data['greeting']}}</h5>
                    <div class="text-right text-muted">
                        <small>
                        @if (is_null($notification->read_at))
                            <i class="fa fa-check text-primary" aria-hidden="true"></i>
                        @else
                            <i class="fa fa-check text-danger" aria-hidden="true"></i>
                        @endif
                        </small>
                        <small>{{$notification->created_at->diffForHumans()}}</small>
                    </div>
                </div>
                <p class="text-sm mb-0">{{$notification->data['data']}}</p>
            </a>
            @endforeach
        </div>
        <!-- View all -->
        <!-- <div class="dropdown-divider"></div>
        <a href="#!" class="dropdown-item text-center text-primary">View all</a> -->
    </div>
</div>
