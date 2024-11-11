<x-app-layout>
    <x-slot name="header">
        <h2 class="font-medium text-5xl text-center text-gray-800 leading-tight">
            {{ __('Piesakies TV šoviem!') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- TV Show Blocks -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                @foreach ($tvshows as $tvshow)
                    <div class="bg-gray-100 rounded-md overflow-hidden shadow-sm flex flex-col">
                        <div class="relative pt-3 px-3">
                            <img src="{{ asset('storage/' . $tvshow->banner) }}" alt="{{ $tvshow->name }}"
                                class="w-full h-48 object-cover">
                            <div
                                class="absolute top-5 left-5 bg-[#ff0000] text-white px-2 py-1 text-sm rounded flex items-center">
                                <x-icons.bell class="w-3 h-3 mr-1" />
                                Vēl {{ $tvshow->days_left }} dienas
                            </div>
                        </div>
                        <div class="p-3 flex flex-col flex-1">
                            <div class="mb-4 flex-grow">
                                <p class="text-black text-lg leading-snug line-clamp-3">
                                    {{ $tvshow->description }}
                                </p>
                            </div>
                            <div class="flex items-center gap-6">
                                <button
                                    class="bg-[#ff0000] text-white px-4 py-2 rounded-sm hover:bg-[#d30000] text-lg shadow-md hover:shadow-lg transition duration-300">Pieteikties!</button>
                                <div class="flex items-center text-black text-sm">
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

    <!-- Add TV Show Modal -->
    <x-modal name="add-tv-show" :show="$errors->addTvShow->isNotEmpty()" focusable>
        <form method="POST" action="{{ route('tvshows.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Pievienot TV Šovu') }}
                </h2>
                <div class="mt-4">
                    <x-input-label for="name" :value="__('Nosaukums')" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required
                        autofocus value="{{ old('name') }}" />
                    <x-input-error :messages="$errors->addTvShow->get('name')" class="mt-2" />
                </div>
                <div class="mt-4">
                    <x-input-label for="description" :value="__('Apraksts')" />
                    <textarea id="description" name="description" rows="4" class="mt-1 block w-full border-gray-300 rounded-md"
                        required>{{ old('description') }}</textarea>
                    <x-input-error :messages="$errors->addTvShow->get('description')" class="mt-2" />
                </div>
                <div class="mt-4">
                    <x-input-label for="banner" :value="__('Attēls (jpg/jpeg/png)')" />
                    <input id="banner" name="banner" type="file" accept="image/*" required
                        class="mt-1 block w-full text-sm text-gray-500
                           file:mr-4 file:py-2 file:px-4
                           file:rounded-md file:border-0
                           file:text-sm file:font-semibold
                           file:bg-gray-100 file:text-gray-700
                           hover:file:bg-gray-200" />
                    <x-input-error :messages="$errors->addTvShow->get('banner')" class="mt-2" />
                </div>
                <div class="mt-4">
                    <x-input-label for="start_date" :value="__('Pieteikšanās no (datums)')" />
                    <x-text-input id="start_date" name="start_date" type="date" class="mt-1 block w-full" required
                        value="{{ old('start_date') }}" />
                    <x-input-error :messages="$errors->addTvShow->get('start_date')" class="mt-2" />
                </div>
                <div class="mt-4">
                    <x-input-label for="end_date" :value="__('Pieteikšanās līdz (datums)')" />
                    <x-text-input id="end_date" name="end_date" type="date" class="mt-1 block w-full" required
                        value="{{ old('end_date') }}" />
                    <x-input-error :messages="$errors->addTvShow->get('end_date')" class="mt-2" />
                </div>
                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close-modal', 'add-tv-show')">
                        {{ __('Atcelt') }}
                    </x-secondary-button>
                    <x-primary-button class="ml-3">
                        {{ __('Saglabāt') }}
                    </x-primary-button>
                </div>
            </div>
        </form>
    </x-modal>

    <!-- Delete TV Show Modal -->
    <x-modal name="delete-tv-show" :show="false" focusable>
        <form method="POST" action="#" id="delete-tvshow-form">
            @csrf
            @method('DELETE')
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Dzēst TV Šovu') }}
                </h2>
                <div class="mt-4">
                    <x-input-label for="tvshow_id" :value="__('Izvēlies TV šovu, kuru dzēst')" />
                    <select id="tvshow_id" name="tvshow_id" class="mt-1 block w-full border-gray-300 rounded-md"
                        required>
                        @foreach ($allTvShows as $tvshow)
                            <option value="{{ $tvshow->id }}">{{ $tvshow->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('tvshow_id')" class="mt-2" />
                </div>
                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close-modal', 'delete-tv-show')">
                        {{ __('Atcelt') }}
                    </x-secondary-button>
                    <x-danger-button class="ml-3" onclick="event.preventDefault(); deleteTvShow();">
                        {{ __('Saglabāt') }}
                    </x-danger-button>
                </div>
            </div>
        </form>
    </x-modal>

    <script>
        function deleteTvShow() {
            let tvshowId = document.getElementById('tvshow_id').value;
            let form = document.getElementById('delete-tvshow-form');
            form.action = '{{ url('tvshows') }}/' + tvshowId;
            form.submit();
        }
    </script>

    <x-footer />
</x-app-layout>
