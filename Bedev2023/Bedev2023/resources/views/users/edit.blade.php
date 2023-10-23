@extends('layout')
@section('content')
<x-card class="p-10 rounded max-w-lg mx-auto mt-24">
<header class="text-center">
    <h2 class="text-2xl font-bold uppercase mb-1">
        User Edit
    </h2>
</header>

<form action="/users/{{$user->id}}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-6">
        <label for="name" class="inline-block text-lg mb-2">
            Name
        </label>
        <input
            type="text"
            class="border border-gray-200 rounded p-2 w-full"
            name="name"
            value="{{$user->name}}"
        />
        @error('name')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
    </div>

    <div class="mb-6">
        <label for="email" class="inline-block text-lg mb-2"
            >Email</label
        >
        <input
            type="email"
            class="border border-gray-200 rounded p-2 w-full"
            name="email"
            value="{{$user->email}}"
        />
        @error('email')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
    </div>


    @if (auth()->user()->role_id == 1) {{-- input za biranje uloga moze vidjeti samo admin --}}
    <div class="mb-6">
        <label for="role_id" class="inline-block text-lg mb-2"
            >Role</label
        >
        <select name="role_id" class="border border-gray-200 rounded p-2 w-full">  {{-- select je postavljen na postojecu ulogu korisnika --}}
            @if ($user->role_id == 1)
            <option value="1" selected>administrator</option>
            <option value="2">editor</option>
            @else
            <option value="1">administrator</option>
            <option value="2" selected>editor</option> 
            @endif
        </select>
    </div>
    @endif
 
    <div class="mb-6">
        <button
            type="submit"
            class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
        >
            Edit User
        </button>
        <a href="{{url()->previous()}}" class="text-black ml-4"> Back </a>
    </div>

</form>
</x-card>
@endsection