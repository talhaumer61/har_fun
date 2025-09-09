@include('site.components.header', ['title' => isset($user) && isset($profile) ? 'Worker Detail - HARFUN' : 'Sellers - HARFUN'])

    @if (isset($user) && isset($profile))
        @include('site.components.sellers.seller_title',['seller_name' =>  $user['name']])
        @include('site.components.sellers.seller_profile')
    @else
        @include('site.components.sellers.search_banner')
        @include('site.components.sellers.list')
        @include('site.components.modals.sellers.filters')
    @endif
@extends('site.components.footer')