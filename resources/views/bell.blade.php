@foreach (auth()->user()->unreadNotifications as $notification)
    <li>{{ $notification->data['message'] }}</li>
@endforeach