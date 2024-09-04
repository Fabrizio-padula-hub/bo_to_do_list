@extends('layouts.admin')

@section('content')
    <!-- component -->
    <script src="https://cdn.tailwindcss.com"></script>

    <body class="bg-gray-100">
        <div class="container mx-auto py-8">
            <h1 class="text-2xl font-bold mb-6 text-center">
                Modifica l'elemento: {{ $expense->name }}
            </h1>
            <form action="{{ route('admin.expenses.update', ['expense'=> $expense->id]) }}" method="POST"
            class="w-full max-w-sm mx-auto bg-white p-8 rounded-md shadow-md">
            @csrf
            @method('PUT')

                {{-- name --}}
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Nome</label>
                    <input
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500"
                        type="text" id="name" name="name" value="{{ $expense->name }}">
                </div>

                {{-- image --}}
                
                
                
                <button
                    class="w-full bg-indigo-500 text-white text-sm font-bold py-2 px-4 rounded-md hover:bg-indigo-600 transition duration-300"
                    type="submit">Modifica</button>
            </form>
        </div>
    </body>
@endsection