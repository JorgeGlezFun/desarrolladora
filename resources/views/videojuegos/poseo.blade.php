<x-app-layout>
    <div class="w-1/2 mx-auto">
        <form method="POST" action="{{ route('videojuegos.poseoUpdate')}}">
            @csrf

            <div>
                <x-input-label for="videojuego_id" :value="'Videojuego'" />
                <div class="flex items-center mb-4">
                        <select name="videojuego_id" id="videojuego_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach ($videojuegos as $videojuego)
                            <option value="{{$videojuego->id}}">{{$videojuego->titulo}}</option>
                        @endforeach
                        </select>
                </div>
            </div>

            <div>
                <input name="opcion" type="submit" value="Lo tengo" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150" />
                <input name="opcion" type="submit" value="No lo tengo" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a href="{{ route('videojuegos.index') }}">
                    <x-secondary-button class="ms-4">
                        Volver
                    </x-secondary-button>
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
