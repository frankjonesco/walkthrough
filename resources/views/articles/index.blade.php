<x-layout>
    <x-container>
        <h1>News articles</h1>
        @if(isset($h2))
            <h2>{!!$h2!!}</h2>                
        @else
            <h2>View the news articles on the site.</h2>
        @endif
        <x-articles-grid :articles="$articles" />
    </x-container>
</x-layout>