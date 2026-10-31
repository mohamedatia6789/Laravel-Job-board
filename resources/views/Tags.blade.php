<x-layout title="{{ $title }}">
    @foreach ($tags as $tag)
        <h1>{{$tag -> name}}</h1>
        @foreach ($tag->post as $tag )
            {{$tag->body}};
        @endforeach
    @endforeach
</x-layout>