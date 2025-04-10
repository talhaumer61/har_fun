@include('site.components.header', ['title' => isset($job) ? 'Job Detail - HARFUN' : 'Jobs - HARFUN'])

@if (isset($job))
    {{-- Single Job Detail View --}}
    @include('site.components.jobs.job_title', ['job_title' => $job->job_title])
    @include('site.components.jobs.detail', ['job' => $job]) 
@else
    {{-- All Jobs or Category-wise Jobs View --}}
    @include('site.components.jobs.search_banner')

    @if($jobs->count())
        @include('site.components.jobs.list', ['jobs' => $jobs])
    @else
        <div class="text-center m-5 rounded bg-light">
            <h4 class="py-5 text-danger">No jobs found for this category.</h4>
        </div>
    @endif

    @include('site.components.modals.jobs.filters')
@endif

@extends('site.components.footer')
