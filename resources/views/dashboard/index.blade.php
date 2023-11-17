<x-layout>
    <x-container>
        <h1>Dashboard</h1>
        <h2>Manage the different areas of the {{config('app.name')}} project</h2>
        <div class="grid grid-cols-3 gap-6 border-t border-t-200 pt-8 px-3">
            <div class="flex justify-center items-center">
                <a href="/dashboard/articles" class="bg-blue-300 p-20 py-6 rounded-xl border-[0.4rem] border-blue-400 shadow-lg text-center text-white transition-all duration-300 ease-in-out hover:-translate-y-2 hover:shadow-xl">
                    <i class="fa-regular fa-newspaper text-8xl"></i>
                    <span class="block pt-6 font-bold text-xl font-roboto">News articles</span>
                </a>
            </div>
            <div class="flex justify-center items-center">
                <a href="/dashboard/categories" class="bg-pink-300 p-20 py-6 rounded-xl border-[0.4rem] border-pink-400 shadow-lg text-center text-white transition-all duration-300 ease-in-out hover:-translate-y-2 hover:shadow-xl">
                    <i class="fa-regular fa-folder text-8xl"></i>
                    <span class="block pt-6 font-bold font-roboto">News categories</span>
                </a>
            </div>
            <div class="flex justify-center items-center">
                <a href="/profile" class="bg-purple-300 p-20 py-6 rounded-xl border-[0.4rem] border-purple-400 shadow-lg text-center text-white transition-all duration-300 ease-in-out hover:-translate-y-2 hover:shadow-xl">
                    <i class="fa-regular fa-user text-8xl"></i>
                    <span class="block pt-6 font-bold font-roboto">Profile</span>
                </a>
            </div>
        </div>
    </x-container>    
</x-layout>