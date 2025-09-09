@php
    $pageTitle = ($action === 'proposals' && $href)
        ? 'Job Proposals - HARFUN'
        : 'My Jobs - HARFUN';
@endphp

@include('site.components.header_links', ['title' => $pageTitle])

@include('site.customer.sidebar')

@if ($action === 'proposals' && $href)
    @include('site.customer.my_jobs.proposals')
@else
    @include('site.customer.my_jobs.list')
@endif

@include('site.components.footer_links')
