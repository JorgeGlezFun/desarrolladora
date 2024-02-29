<x-app-layout>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Titulo
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Año de publicación
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Desarrolladora
                    </th>
                </tr>
            </thead>
            <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row"
                            class="w-auto px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $videojuego->titulo }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $videojuego->anyo }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $videojuego->desarrolladora->nombre}}
                            {{-- {{ sprintf('%d:%02d', intval($videojuego->duracion / 60), $videojuego->duracion % 60) }} --}}
                        </td>
                        {{-- <td class="px-6 py-4">
                            {{$videojuego->artistas->count()}}
                        </td> --}}
                    </tr>
            </tbody>
        </table>
        <div class="flex items-center justify-end mt-4">
            <a href="{{ route('videojuegos.index') }}">
                <x-secondary-button class="ms-4">
                    Volver
                </x-secondary-button>
            </a>
        </div>
    </div>
</x-app-layout>
