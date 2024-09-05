@extends('layouts.admin')

@section('content')
    <!-- component -->
    <script src="https://cdn.tailwindcss.com"></script>

    <body class="bg-gray-100">
        <div class="container mx-auto py-8">
            <h1 class="text-2xl font-bold mb-6 text-center">Crea la tua lista</h1>

            {{-- Messaggio errore validazione --}}
            @if ($errors->any())
                <div class="bg-red-400">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- corpo del form --}}
            <form action="{{ route('admin.expenses.store') }}" method="POST" enctype="multipart/form-data"
                class="w-full max-w-sm mx-auto bg-white p-8 rounded-md shadow-md">
                @csrf

                {{-- name --}}
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Nome</label>
                    <input
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500"
                        type="text" id="name" name="name" placeholder="Pasta" value="{{ old('name') }}">
                </div>

                {{-- image --}}
                <main class="flex mb-5 items-center justify-center bg-gray-100 font-sans">
                    <label for="image"
                        class="mx-auto cursor-pointer flex w-full max-w-lg flex-col items-center rounded-xl border-2 border-dashed border-blue-400 bg-white p-6 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>

                        <h3 class="mt-4 text-xl font-medium text-gray-700 tracking-wide">Carica File</h3>

                        <p class="mt-2 text-gray-500 tracking-wide">Carica file SVG, PNG, JPG or GIF.
                        </p>

                        <input id="image" type="file" class="" name="image" />
                        </section>
                </main>

                <!-- Checkbox per le categorie -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Categorie</label>
                    <div class="flex flex-wrap gap-4">
                        @foreach ($categories as $category)
                            <label class="inline-flex items-center space-x-2">
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                    class="form-checkbox h-5 w-5 text-blue-600 rounded focus:ring-blue-500">
                                <span class="text-gray-700">{{ $category->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>


                <button
                    class="w-full bg-indigo-500 text-white text-sm font-bold py-2 px-4 rounded-md hover:bg-indigo-600 transition duration-300"
                    type="submit">Salva</button>
            </form>
        </div>
    </body>
@endsection
