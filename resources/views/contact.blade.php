<x-page :page-headings="$page_headings">
    <x-card-form-medium>
        <form action="/contact" method="POST" class="grid grid-cols-2">
            @csrf
            {{-- Name --}}
            <div class="form-element mr-3">
                <label for="name">Your name</label>
                <input type="text" name="name" placeholder="Enter your name" value="{{old('name')}}">
                <x-form-error element="name" />
            </div>
            {{-- Email --}}
            <div class="form-element ml-3">
                <label for="email">Your email</label>
                <input type="email" name="email" placeholder="Enter your email" value="{{old('email')}}">
                <x-form-error element="email" />
            </div>
            {{-- Subject --}}
            <div class="form-element col-span-2">
                <label for="subject">Subject</label>
                <input type="text" name="subject" placeholder="Message subject" value="{{old('subject')}}">
                <x-form-error element="subject" />
            </div>
            {{-- Message --}}
            <div class="form-element col-span-2">
                <label for="message">Message</label>
                <textarea name="message" rows="4" placeholder="Write your message">{{old('message')}}</textarea>
                <x-form-error element="message" />
            </div>
            {{-- Submit --}}
            <div class="btn-row col-span-2">
                <button type="submit" class="btn btn-success">Send message</button>
                <a href="/" class="btn-danger">Cancel</a>
            </div>
        </form>
    </x-card-form-medium>
</x-page>