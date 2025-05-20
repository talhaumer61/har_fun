@include('site.components.header_links', ['title' => 'Account Settings - HARFUN'])

@include('site.' . get_logintypes(session('user')->login_type) . '.sidebar')
@include('site.components.account_settings.info')

@include('site.components.footer_links')