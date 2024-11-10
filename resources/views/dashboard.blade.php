<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-4xl text-center text-gray-800 leading-tight">
            {{ __('Piesakies TV šoviem!') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- TV Show Blocks -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach ($tvshows as $tvshow)
                    <div class="bg-gray-100 rounded-lg overflow-hidden shadow-sm">
                        <div class="relative">
                            <img src="{{ asset('storage/' . $tvshow->banner) }}" alt="{{ $tvshow->name }}"
                                class="w-full h-48 object-cover">
                            <div
                                class="absolute top-2 left-2 bg-[#ff0000] text-white px-2 py-1 text-sm rounded flex items-center">
                                <x-icons.bell class="w-4 h-4 mr-1" />
                                Vēl {{ $tvshow->days_left }} dienas
                            </div>
                        </div>
                        <div class="p-4 flex flex-col justify-between h-42">
                            <div class="mb-4">
                                <p class="text-black text-xl leading-snug line-clamp-3">{{ $tvshow->description }}
                                </p>
                            </div>
                            <div class="flex items-center justify-between">
                                <button
                                    class="bg-[#ff0000] text-white px-4 py-2 rounded-sm hover:bg-[#d30000]">Pieteikties!</button>
                                <div class="flex items-center text-black text-sm pr-5">
                                    <x-icons.calendar class="w-4 h-4 mr-1" />
                                    {{ $tvshow->formatted_start_date }} - {{ $tvshow->formatted_end_date }}
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
