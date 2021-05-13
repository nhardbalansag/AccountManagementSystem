@extends('layouts.app')

@section('content')

    <div class="wrapper">
        @include('Content.Includes.CMS.navbar')
        @include('Content.Includes.CMS.main-side-bar')
        <div class="content-wrapper">
            @yield('home-contents')
        </div>
        @include('Content.Includes.CMS.footer')
    </div>

@endsection
