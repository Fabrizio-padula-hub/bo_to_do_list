@extends('layouts.admin')

@section('content')
    <h1 class="text mb-6">Prova lista spesa</h1>

    <!-- component -->
    <div class="container">

        <table class="text-left w-full">
            <thead class="bg-black flex text-white w-full">
                <tr class="flex w-full mb-4">
                    <th class="p-4 w-1/4">Nome</th>
                    <th class="p-4 w-1/4">Immagine</th>
                    <th class="p-4 w-1/4">Creata</th>
                </tr>
            </thead>

            <tbody class="bg-grey-light flex flex-col items-center justify-between overflow-y-scroll w-full">
                @foreach ($expense as $list)
                    <tr class="flex w-full mb-4">
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
          
                        <td class="p-4 w-1/4">{{ $list->created_at }}</td>

                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    
@endsection
