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
                        <th class="p-4 w-1/4">Categorie</th>
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

                            <!-- Selezione categorie -->
                            <td class="p-4 w-1/4">
                                @if ($list->categoryTags->isNotEmpty())
                                    @foreach ($list->categoryTags as $category)
                                        <span
                                            class="bg-blue-200 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">
                                            {{ $category->name }}
                                        </span>
                                    @endforeach
                                @else
                                    <i class="fa-solid fa-xmark"></i>
                                @endif
                            </td>


                            <td class="p-4 w-1/4 flex justify-between">
                                {{-- bottone show --}}
                                <div>
                                    <a class="hover:text-[#4484f3] "
                                        href="{{ route('admin.expenses.show', ['expense' => $list->id]) }}">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </div>
                                {{-- bottone edit --}}
                                <div>
                                    <a class="hover:text-[#4484f3] "
                                        href="{{ route('admin.expenses.edit', ['expense' => $list->id]) }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                </div>
                                {{-- bottone delete --}}
                                <form action="{{ route('admin.expenses.destroy', ['expense' => $list->id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="hover:text-[#4484f3] modal-delete"
                                        data-item-name="{{ $list->name }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @endforeach

                </tbody>
            </table>

            <!-- Paginazione -->
            <div class="min-h-40">
                {{ $expenses->links() }}
            </div>

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

    <!-- Modale per eliminare -->
    <div class="hidden fixed inset-0 z-10 overflow-y-auto bg-gray-500 bg-opacity-75 items-center justify-center"
        id="confirmDeleteModal" aria-labelledby="confirmDelete" role="dialog" aria-modal="true">
        <!-- Modal content -->
        <div
            class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
            <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div
                        class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                        <h3 class="text-base font-semibold leading-6 text-gray-900" id="confirmDelete">Conferma eliminazione
                        </h3>
                        <div class="mt-2">
                            <!-- Messaggio aggiornato per includere il nome dell'elemento -->
                            <p class="text-sm text-gray-500">Sei sicuro di voler eliminare <strong class="text-red-500"
                                    id="itemToDelete"></strong>?
                                Questa azione non può essere annullata.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                <button type="button" id="ms-modal-confirm-deletion"
                    class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">Elimina</button>
                <button type="button" id="ms-modal-cancel-deletion"
                    class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Annulla</button>
            </div>
        </div>
    </div>




    <!-- stylesheet -->
    <link rel="stylesheet" href="https://unpkg.com/@material-tailwind/html@latest/styles/material-tailwind.css" />
    <!-- Material Icons Link -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <script src="https://unpkg.com/@material-tailwind/html@latest/scripts/ripple.js"></script>


@endsection
