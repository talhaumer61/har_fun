@include('site.components.header_links', ['title' => 'Dashboard - HARFUN'])

@if (isset($admin['type']) && $admin['type'] == 'customer')
    @include('site.customer.sidebar')
    @include('site.customer.dashboard.customer_dashboard')
@elseif (isset($admin['type']) && $admin['type'] == 'seller')
    @include('site.seller.sidebar')
    @include('site.seller.dashboard.seller_dashboard')
@endif

@include('site.components.footer_links')