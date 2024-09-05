@extends('layouts.admin')

@section('content')
    {{-- messaggio flash --}}
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- component -->
    <div class="relative flex w-full max-w-[26rem] flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-lg">

        <div>
            @if ($expense->image)
                <!-- Mostra l'immagine dal database -->
                <div
                    class="relative mx-4 mt-4 overflow-hidden rounded-xl bg-blue-gray-500 bg-clip-border text-white shadow-lg shadow-blue-gray-500/40">
                    <img class="w-full" src="{{ asset('storage/' . $expense->image) }}" alt="{{ $expense->name }}">
                </div>
            @else
                <!-- Mostra il testo -->
                <strong>Nessuna Immagine</strong>
            @endif
        </div>

        <div class="p-6">
            <div class="mb-3 flex items-center justify-between">
                <h5 class="block font-sans text-xl font-medium leading-snug tracking-normal text-blue-gray-900 antialiased">
                    <strong>Elemento:</strong> {{ $expense->name }}
                </h5>
            </div>

            <!-- visualizzza le categorie associate -->
            <div class="mt-4">
                <h6 class="block font-sans text-lg font-medium leading-snug tracking-normal text-blue-gray-900 antialiased">
                    <strong>Categorie associate:</strong>
                </h6>
                @if ($categories->isEmpty())
                    <p class="text-gray-500">Nessuna categoria associata.</p>
                @else
                    <ul class="list-disc pl-5">
                        @foreach ($categories as $category)
                            <li class="text-gray-700">{{ $category->name }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>

        </div>
        <div class="p-6 pt-3 flex">
            <!-- Bottone Modifica -->
            <a href="{{ route('admin.expenses.edit', ['expense' => $expense->id]) }}">
                <button
                    class="mr-3 middle mt-4 none center rounded-lg bg-pink-500 py-3 px-6 font-sans text-xs font-bold uppercase text-white shadow-md shadow-pink-500/20 transition-all hover:shadow-lg hover:shadow-pink-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                    data-ripple-light="true">
                    Modifica
                </button>
            </a>
            <!-- Bottone Elimina -->

        </div>
    </div>







    <!-- stylesheet -->
    <link rel="stylesheet" href="https://unpkg.com/@material-tailwind/html@latest/styles/material-tailwind.css" />

    <!-- Ripple Effect from cdn -->
    <script src="https://unpkg.com/@material-tailwind/html@latest/scripts/ripple.js"></script>
    <!-- from cdn -->
    <script src="https://unpkg.com/@material-tailwind/html@latest/scripts/ripple.js"></script>
@endsection
