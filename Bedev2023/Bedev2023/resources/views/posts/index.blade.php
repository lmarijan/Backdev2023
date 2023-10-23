@extends('layout')
@section('content')
@include('partials._search')

<div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
@if (count($posts) == 0)
    <p>No posts found</p>
@endif

@foreach ($posts as $post)
    <x-post-card :post="$post"/>
@endforeach
</div>

<div class="mt-6 p-4">
    {{ $posts->links() }}
</div>

@endsection