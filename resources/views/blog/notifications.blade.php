@auth
    @if(auth()->user()->notifications->count())
        <select name="notifications">
                <option>{{__('notifications')}}</option>
            @foreach(auth()->user()->notifications as $notification)
                <option value="">{{ $notification->content }}</option>
            @endforeach
        </select>
    @endif
@endauth
