@extends('layout')
@section('content')


<x-card class="p-10 max-w-lg mx-auto mt-24">
<header class="text-center">
    <h2 class="text-2xl font-bold uppercase mb-1">
        Edit
    </h2>
    <p class="mb-4">Edit: {{$post->title}}</p>
</header>

<form method="POST" action="/posts/{{$post->id}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-6">
        <label for="title" class="inline-block text-lg mb-2"
            >Post Title</label
        >
        <input
            type="text"
            class="border border-gray-200 rounded p-2 w-full"
            name="title"
            placeholder="Post title.."
            value="{{$post->title}}" 
        />
        @error('title')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
    </div>

    <div class="mb-6">
        <label
            for="description"
            class="inline-block text-lg mb-2"
        >
            Post Content
        </label>
        <textarea
            class="border border-gray-200 rounded p-2 w-full"
            name="content"
            rows="10"
            placeholder="What is on your mind?"
        >{{$post->content}}</textarea>
        @error('content')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
    </div>

    <div class="mb-6">
        <label
            for="location"
            class="inline-block text-lg mb-2"
            >Posted From Location</label
        >
        <input
            type="text"
            class="border border-gray-200 rounded p-2 w-full"
            name="location"
            placeholder="Your location.."
            value="{{$post->location}}" 
        />
        @error('location')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
    </div>

    <div class="mb-6">
        <label for="tags" class="inline-block text-lg mb-2">
            Tags (Comma Separated)
        </label>
        <input
            type="text"
            class="border border-gray-200 rounded p-2 w-full"
            name="tags"
            placeholder="Example: Laravel, Backend, Java, etc"
            value="{{$post->tags}}" 
        />
        @error('tags')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
    </div>
  


    <div class="mb-6">
        <label for="logo" class="inline-block text-lg mb-2">
            Post Image:
        </label>
        <input
            type="file"
            class="border border-gray-200 rounded p-2 w-full"
            name="image"
        />
        @error('image')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
    </div>

 

    <div class="mb-6">
        <button
            class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
        >
            Edit Post
        </button>
     
       <a href="{{url()->previous()}}" class="text-black ml-4"> Back </a>
    </div>
</form>
</x-card>

@endsection