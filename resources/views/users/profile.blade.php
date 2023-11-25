<x-page :page-headings='$page_headings'>
    <div class="grid grid-cols-2 w-3/4 mx-auto mt-20">
        <div class="px-20">
            <img src="{{$user->getImage()}}" class="border-8 border-red-100 p-2 rounded-full">
        </div>
        <div class="text-center my-auto">
            <h2 class="font-bold mb-8">
                {{$user->fullName()}}
            </h2>
            <div class="mb-5">
                <span class="underline underline-offset-2">
                    {{$user->email}}
                </span>
            </div>
            <div>
                <span class="font-bold block">
                    Created at
                </span>
                <span class="text-sm">
                    {{showDateTime($user->created_at)}}
                </span>
            </div>
            <div class="mt-6 mb-5">
                <span class="font-bold block">
                    Updated at
                </span>
                <span class="text-sm">
                    {{showDateTime($user->updated_at)}}
                </span>
            </div>
            <a href="/profile/edit" class="btn-success-sm mt-8">
                Edit profile
            </a>
            <a href="profile/edit-password" class="btn-default-sm mt-8">
                Change password
            </a>
            <a href="/profile/image" class="btn-primary-sm mt-8">
                Profile picture
            </a>
        </div>
    </div>
</x-page>