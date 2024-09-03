<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        Benvenuto {{ $user->name }}
                    </div>
                    <a aria-current="page" class="active" href="{{ route('admin.expenses.index') }}">
                        <button
                            class="p-6 middle none font-sans font-bold center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs rounded-lg bg-gradient-to-tr from-blue-600 to-blue-400 text-white shadow-md shadow-blue-500/20 hover:shadow-lg hover:shadow-blue-500/40 active:opacity-[0.85] w-full flex items-center gap-4 capitalize"
                            type="button">
                            <p
                                class="block antialiased font-sans text-base leading-relaxed text-inherit font-medium capitalize">
                                Vai alle tue liste</p>
                        </button>
                    </a>
                    

                </div>
            </div>

        </h2>

    </x-slot>

</x-app-layout>
