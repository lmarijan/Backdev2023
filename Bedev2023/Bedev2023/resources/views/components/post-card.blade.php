@props(['post'])

<x-card class="p-6">
    <div class="flex">
        <img
            class="hidden w-48 mr-6 md:block"
            src="{{$post->image ? asset('storage/' . $post->image) : asset('/images/no-image.png')}}"
            alt=""
        />
        <div>
            <div class="text-xl font-bold mb-4">{{$post->title}}</div>
            <p>
                <a href="/posts/{{$post->id}}">{{$post->content}}</a>
            </p>
            <div class="text-lg mt-4 mb-4">
                <i class="fa-solid fa-location-dot"></i> {{$post->location}}
            </div>
            <x-post-tags :tagsCsv="$post->tags"/>
        </div>
    </div>
</x-card>