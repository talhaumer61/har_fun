@include('site.components.header', ['title' => isset($job) ? 'Job Detail - HARFUN' : 'Jobs - HARFUN'])

@if (isset($job))
    @include('site.components.jobs.job_title',['job_title' => $job['title']])
    @include('site.components.jobs.detail')
@else
    @include('site.components.jobs.search_banner')
    @include('site.components.jobs.list')
    @include('site.components.modals.jobs.filters')
@endif

@extends('site.components.footer')