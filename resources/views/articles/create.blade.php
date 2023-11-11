<x-layout>
    <x-container>
        <h1>Create a new article</h1>
        <form action="/articles/store" method="POST">
            @csrf
            {{-- Title --}}
            <div class="form-element">
                <label for="title">Title</label>
                <input type="text" name="title" placeholder="Article title">
                @error('title')
                    <p class="form-error">
                        {{$message}}
                    </p>
                @enderror
            </div>

            {{-- Caption --}}
            <div class="form-element">
                <label for="caption">Caption</label>
                <input type="text" name="caption" placeholder="Article caption">
                @error('caption')
                    <p class="form-error">
                        {{$message}}
                    </p>
                @enderror
            </div>

            {{-- Body --}}
            <div class="form-element">
                <label for="body">Body</label>
                <textarea name="body" id="body" rows="5" placeholder="Main article body"></textarea>
                @error('body')
                    <p class="form-error">
                        {{$message}}
                    </p>
                @enderror
            </div>

            {{-- Status --}}
            <div class="form-element">
                <label for="status">Status</label>
                <select name="status" id="status">
                    <option value="private">Private</option>
                    <option value="public">Public</option>
                </select>
                @error('status')
                    <p class="form-error">
                        {{$message}}
                    </p>
                @enderror
            </div>

            <div class="btn-row">
                <button type="submit" class="btn btn-green">Create article</button>
                <a href="{{ url()->previous() }}" class="btn-gray">Cancel</a>
            </div>

        </form>
    </x-container>
</x-layout>