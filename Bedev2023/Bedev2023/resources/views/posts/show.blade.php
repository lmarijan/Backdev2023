@extends('layout')
@section('content')

<a href="/" class="inline-block text-black ml-4 mb-4"
><i class="fa-solid fa-arrow-left"></i> Back
</a>
<div class="mx-4">

    <x-card class="p-10">
        <div
            class="flex flex-col items-center justify-center text-center"
        >
            <x-post-tags :tagsCsv="$post->tags"/>
            <h3 class="text-2xl mb-2 mt-2">{{$post->title}}</h3>
            <div class="text-lg my-4">
                <i class="fa-solid fa-location-dot"></i> {{$post->location}}
        </div>
        <img
            class="w-48 mr-6 mb-6"
            src="{{$post->image ? asset('storage/' . $post->image) : asset('/images/no-image.png')}}"
            alt=""
        />
        <div class="text-lg space-y-6">
            {{$post->content}}
        </div>
    </x-card>
</div>
<span class="text-sm">Created by {{$user}} {{$post->created_at}}</span>

@endsection