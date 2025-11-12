@include('site.components.header', ['title' => isset($user) && isset($profile) ? 'Worker Detail - HARFUN' : 'Sellers - HARFUN'])

    @if (isset($user) && isset($profile))
        @include('site.components.sellers.seller_title',['seller_name' =>  $user['name']])
        @include('site.components.sellers.seller_profile')
    @else
        @include('site.components.sellers.search_banner')

        <!-- The section wrapper stays here -->
        <section id="sellersContainer" class="candidates-profile bg-color pt-90 lg-pt-70 pb-160 xl-pb-150 lg-pb-80">
            @include('site.components.sellers.list') 
            <!-- This loads sellers initially -->
        </section>

        @include('site.components.modals.sellers.filters')

    @endif
@extends('site.components.footer')