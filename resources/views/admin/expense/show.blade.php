@extends('layouts.admin')

@section('content')
    <!-- component -->
    <div class="relative flex w-full max-w-[26rem] flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-lg">
        @if ($expense->image)
            <div
                class="relative mx-4 mt-4 overflow-hidden rounded-xl bg-blue-gray-500 bg-clip-border text-white shadow-lg shadow-blue-gray-500/40">
                <img class="w-full" src="{{ $expense->image }}"
                    alt="ui/ux review check" />
            </div>
        @else
            <div>
                <strong>Nessuna Immagine</strong>
            </div>
        @endif
        
        <div class="p-6">
            <div class="mb-3 flex items-center justify-between">
                <h5 class="block font-sans text-xl font-medium leading-snug tracking-normal text-blue-gray-900 antialiased">
                   <strong>Elemento:</strong> {{ $expense->name }}
                </h5>
            </div>
           
            
        </div>
        {{-- <div class="p-6 pt-3">
            <button
                class="block w-full select-none rounded-lg bg-pink-500 py-3.5 px-7 text-center align-middle font-sans text-sm font-bold uppercase text-white shadow-md shadow-pink-500/20 transition-all hover:shadow-lg hover:shadow-pink-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                type="button" data-ripple-light="true">
                Reserve
            </button>
        </div> --}}
    </div>


    <!-- stylesheet -->
    <link rel="stylesheet" href="https://unpkg.com/@material-tailwind/html@latest/styles/material-tailwind.css" />

    <!-- from cdn -->
    <script src="https://unpkg.com/@material-tailwind/html@latest/scripts/ripple.js"></script>
@endsection
