@include('site.components.header_links', ['title' => 'Messages - HARFUN'])

@if (session('user')->login_type == 2)
    @include('site.customer.sidebar')  
@else
    @include('site.seller.sidebar')
@endif
@include('site.components.messages.my_messages')

@include('site.components.footer_links')