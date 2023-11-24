<x-layout>
    <x-container>
        <x-page-headings :page-headings="$pageHeadings['main']" :page-subheadings="$pageHeadings['sub']" />
        {{$slot}}
    </x-container>
</x-layout>
