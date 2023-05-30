<x-app-layout>

    <div class="flex justify-center flex-col items-center py-10">
        <div class="py-5">
            <h1 class="text-5xl font-bold capitalize">Linker</h1>
        </div>


        <div class="py-5">
            <h1 class="text-3xl capitalize">{{$user->name}}</h1>
        </div>
    <div class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 dark:bg-gray-800 dark:border-gray-700">
        <h5 class="mb-3 text-center  text-base font-semibold text-gray-900 md:text-xl dark:text-white">

            {{'@'.$user->username}}
        </h5>
        @if($user->links->count() == 0)

<p class="text-lg text-center font-medium text-gray-500 dark:text-white">
    No links yet
</p>

        @endif
        <ul class="my-4 space-y-3">
            @foreach($user->links as $link)
            <li>

                <a href="{{$link->url}}" target="_blank" class="flex items-center text-center text-2xl p-3 font-bold text-gray-900 rounded-lg bg-gray-200 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                    <span class="flex-1 ml-3 whitespace-nowrap">{{$link->title}}</span>
                </a>
            </li>

            @endforeach

        </ul>

    </div>
</div>
</x-app-layout>
