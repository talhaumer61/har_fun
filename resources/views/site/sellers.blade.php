@include('site.components.header', ['title' => isset($seller) ? 'Seller Detail - HARFUN' : 'Sellers - HARFUN'])

    @if (isset($seller))
        @include('site.components.sellers.seller_title',['seller_name' =>  $seller['name']])
        @include('site.components.sellers.seller_profile')
    @else
        @include('site.components.sellers.search_banner')
        @include('site.components.sellers.list')
        @include('site.components.modals.sellers.filters')
    @endif
@extends('site.components.footer')