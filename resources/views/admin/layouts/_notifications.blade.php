
<li class="dropdown notifications-menu">
    <a href="#dropdownshow" class="dropdown-toggle" data-toggle="dropdown">
        <i class="livicon" data-name="bell" data-loop="true" data-color="#e9573f"
           data-hovercolor="#e9573f" data-size="28"></i>
        <span class="label bg-warning">{{Sentinel::getUser()->unreadNotifications->count()}}</span>
    </a>
    <ul class=" notifications dropdown-menu drop_notify" >
        <li class="dropdown-title">You have {{Sentinel::getUser()->unreadNotifications->count()}} notifications</li>
        <li>
            <!-- inner menu: contains the actual data -->
            <ul class=" menu remove_hovereffect">
                @foreach (Sentinel::getUser()->unreadNotifications as $notification)
                <li class="dropdown-item">
                    <i class="livicon bg-aqua" data-n="hand-right" data-s="20" data-c="white"
                       data-hc="white"></i>
                    <a href="{{ url($notification->data['actionURL']) }}">{{$notification->data['data']}}</a>
                    <small class="float-right">
                        <span class="livicon p-2" data-n="timer" data-s="10"></span>
                        {{$notification->created_at->diffForHumans()}}
                    </small>
                </li>
                @endforeach
            </ul>
        </li>
        <li class="footer">
            <a href="#">View all</a>
        </li>
    </ul>
</li>
