<x-layout>
    <x-container>
        <h1>Create a new article</h1>
        <h2>Enter the information for this article.</h2>
        
        <x-card-form-medium>
            
            <form action="/articles/store" method="POST">
                @csrf
                {{-- Title --}}
                <div class="form-element">
                    <label for="title">Title</label>
                    <input type="text" name="title" placeholder="Article title" value="{{old('title')}}">
                    @error('title')
                        <p class="form-error">
                            {{$message}}
                        </p>
                    @enderror
                </div>

                {{-- Caption --}}
                <div class="form-element">
                    <label for="caption">Caption</label>
                    <input type="text" name="caption" placeholder="Article caption" value="{{old('caption')}}">
                    @error('caption')
                        <p class="form-error">
                            {{$message}}
                        </p>
                    @enderror
                </div>

                {{-- Body --}}
                <div class="form-element">
                    <label for="body">Body</label>
                    <textarea name="body" id="body" rows="5" placeholder="Main article body">{{old('body')}}</textarea>
                    @error('body')
                        <p class="form-error">
                            {{$message}}
                        </p>
                    @enderror
                </div>

                {{-- Category ID --}}
                <div class="form-element">
                    <label for="category_id">Category</label>
                    <select name="category_id" id="category_id">
                        <option value="{{null}}" selected>No category</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="form-error">
                            {{$message}}
                        </p>
                    @enderror
                </div>

                {{-- Tags --}}
                <div class="form-element">
                    <label for="tags">Tags</label>
                    <input type="text" name="tags" placeholder="Meta tags">
                    @error('tags')
                        <p class="form-error">
                            {{$message}}
                        </p>
                    @enderror
                </div>

                {{-- Status --}}
                <div class="form-element">
                    <label for="status">Status</label>
                    <select name="status" id="status">
                        <option value="private" {{old('status') === 'private' ? 'selected' : null}}>Private</option>
                        <option value="public" {{old('status') === 'public' ? 'selected' : null}}>Public</option>
                    </select>
                    @error('status')
                        <p class="form-error">
                            {{$message}}
                        </p>
                    @enderror
                </div>

                <div class="btn-row">
                    <button type="submit" class="btn btn-success">Create article</button>
                    <a href="{{ url()->previous() }}" class="btn-danger">Cancel</a>
                </div>

            </form>
        </x-card-form>
    </x-container>
</x-layout>