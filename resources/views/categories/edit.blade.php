<x-layout>
    <x-container>
        <h1>Edit category</h1>
        <h2>Update the information for this category.</h2>
        <x-card-form-medium>
            <form action="/categories/{{$category->hex}}/update" method="POST">
                @csrf
                {{-- Name --}}
                <div class="form-element">
                    <label for="name">Name</label>
                    <input type="text" name="name" placeholder="Category name" value="{{old('name') ?: $category->name}}">
                    @error('name')
                        <p class="form-error">
                            {{$message}}
                        </p>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="form-element">
                    <label for="description">Description</label>
                    <textarea name="description" rows="4" placeholder="Category description">{{old('description') ?: $category->description}}</textarea>
                    @error('description')
                        <p class="form-error">
                            {{$message}}
                        </p>
                    @enderror
                </div>

                {{-- Status --}}
                <div class="form-element">
                    <label for="status">Status</label>
                    <select name="status" id="status">
                        <option value="private" {{old('status') ? (old('status') === 'private' ? 'selected' : null) : ($category->status === 'private' ? 'selected' : null)}} {{$category->status === 'private' ? 'selected' : null}}>Private</option>
                        <option value="public" {{old('status') ? (old('status') === 'public' ? 'selected' : null) : ($category->status === 'public' ? 'selected' : null)}} {{$category->status === 'public' ? 'selected' : null}}>Public</option>
                    </select>
                    @error('status')
                        <p class="form-error">
                            {{$message}}
                        </p>
                    @enderror
                </div>

                <div class="btn-row">
                    <button type="submit" class="btn btn-success">Create category</button>
                    <a href="{{ url()->previous() }}" class="btn-danger">Cancel</a>
                </div>
            </form>
        </x-card-form-medium>
    </x-container>
</x-layout>