@include('site.components.header_links', ['title' => 'Account Settings - HARFUN'])

@include('site.' . get_logintypes(session('user')->login) . '.sidebar')
@include('site.components.account_settings.change_pass')

@include('site.components.footer_links')