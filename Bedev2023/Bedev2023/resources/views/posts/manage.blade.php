@extends('layout')
@section('content')
<a href="{{url()->previous()}}" class="inline-block text-black ml-4 mb-4"
><i class="fa-solid fa-arrow-left"></i> Back
</a>
<x-card class="p-10">
    <header>
        <h1
            class="text-3xl text-center font-bold my-6 uppercase"
        >
            Manage Posts
        </h1>
    </header>

    <table class="w-full table-auto rounded-sm">
        <tbody>
            @unless ($posts->isEmpty()) {{-- unless je u biti if(!condition) --}}
            @foreach ($posts as $post)
            <tr class="border-gray-300">
                <td
                    class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                >
                    <a href="/posts/{{$post->id}}">
                        {{$post->title}}
                    </a>
                </td>
                <td
                    class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                >
                    <a
                        href="/posts/{{$post->id}}/edit"
                        class="text-blue-400 px-6 py-2 rounded-xl"
                        ><i
                            class="fa-solid fa-pen-to-square"
                        ></i>
                        Edit</a
                    >
                </td>
                <td
                    class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                >
                    <form action="/posts/{{$post->id}}" method="post">
                        @csrf
                        @method('delete')
                        <button class="text-red-500"><i class="fa-solid fa-trash"> Delete</i></button>
                    </form>
                </td>
            </tr>

            @endforeach
            @else
            <tr class="border-gray-300">
                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                    <p class="text-center">No posts Found</p>
                </td>
            </tr>

            @endunless
        </tbody>
    </table>
</x-card>
    
@endsection