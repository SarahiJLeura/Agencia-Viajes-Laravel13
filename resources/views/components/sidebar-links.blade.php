@auth
    @if(auth()->user()->isAdmin())
        <x-admin-links />
    @else
        <x-user-links />
    @endif
@endauth