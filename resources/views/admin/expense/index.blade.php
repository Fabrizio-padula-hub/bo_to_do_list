@extends('layouts.admin')

@section('content')
    <!-- component -->
    <div class="container">

        {{-- se la collezione $expenses è popolata allora mi stampi la tabella --}}
        @if ($expenses->count() > 0)
            <table class="text-left w-full">
                <thead class="bg-black flex text-white w-full rounded-lg mb-5 shadow-lg">
                    <tr class="flex w-full mb-4">
                        <th class="p-4 w-1/4">Nome</th>
                        <th class="p-4 w-1/4">Immagine</th>
                        <th class="p-4 w-1/4">Creata (G/M/A)</th>
                        <th class="p-4 w-1/4">Azioni</th>
                    </tr>
                </thead>

                <tbody class="bg-grey-light flex flex-col items-center justify-between w-full">
                    @foreach ($expenses as $list)
                        <tr class="flex w-full mb-4 shadow-inner rounded-lg">
                            <td class="p-4 w-1/4">{{ $list->name }}</td>

                            {{-- se l'immagine è presente mi stampi --}}
                            @if ($list->image)
                                <td class="p-4 w-1/4">
                                    <i class="fa-solid fa-image"></i>
                                </td>
                            @else
                                {{-- altrimenti --}}
                                <td class="p-4 w-1/4">
                                    <i class="fa-solid fa-ban"></i>
                                </td>
                            @endif

                            <td class="p-4 w-1/4">{{ $list->created_at->format('d/m/Y') }}</td>

                            <td class="p-4 w-1/4 flex justify-between">
                                <div>
                                    <a class="hover:text-[#4484f3] "
                                        href="{{ route('admin.expenses.show', ['expense' => $list->id]) }}">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </div>
                                <div>
                                    <a class="hover:text-[#4484f3] "
                                        href="{{ route('admin.expenses.edit', ['expense' => $list->id]) }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                </div>
                                <form action="{{ route('admin.expenses.destroy', ['expense' => $list->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="hover:text-[#4484f3] "
                                        href="{{ route('admin.expenses.edit', ['expense' => $list->id]) }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @endforeach

                </tbody>
            </table>

            {{-- altrimenti mi stampi il mssaggio --}}
        @else
            <!-- component -->

            <div class="relative flex min-h-screen flex-col justify-center overflow-hidden">
                <div class="absolute inset-0 bg-center"></div>
                <div
                    class="group relative m-0 flex h-72 w-96 rounded-xl shadow-xl ring-gray-900/5 sm:mx-auto sm:max-w-lg hover:scale-100">
                    <div
                        class="z-10 h-full w-full overflow-hidden rounded-xl border opacity-80 transition duration-300 ease-in-out group-hover:opacity-100 dark:border-gray-700 dark:opacity-70">
                        <img src="https://images.unsplash.com/photo-1506187334569-7596f62cf93f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=3149&q=80"
                            class="animate-fade-in block h-full w-full scale-100 transform object-cover object-center opacity-100 transition duration-300 group-hover:scale-110"
                            alt="" />
                    </div>
                    <a href="{{ route('admin.expenses.create') }}">
                        <div class="absolute inset-0 flex items-center justify-center z-20">
                            <div class="text-center">
                                <h1 class="text-xl font-bold text-white shadow-xl">Non ci sono elementi nella tua lista.
                                </h1>
                                <h2 class="text-sm font-light text-gray-100 shadow-xl"></h2>
                                <div
                                    class="bg-slate-200 rounded-lg min-h-11 flex justify-center items-center hover:bg-[#4988f5] hover:text-w ease-in duration-300">
                                    Inizia ad aggiungere
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @endif

    </div>

@endsection
