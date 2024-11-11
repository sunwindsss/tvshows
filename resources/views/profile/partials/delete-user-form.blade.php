<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Dzēst Savu Kontu') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Tavi resursi un dati tiks pilnībā izdzēsti. Lūgums lejupielādēt visu vajadzīgo informāciju pirms konta dzēšanas.') }}
        </p>
    </header>

    <x-danger-button x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">{{ __('Dzēst Kontu') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Vai esi pārliecināts, ka vēlies dzēst savu kontu?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Kad tavs konts tiek izdzēsts, visi tavi resursi un dati tiek pilnībā dzēsti. Ievadi savu paroli, lai apstiprinātu konta dzēšanu.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input id="password" name="password" type="password" class="mt-1 block w-3/4"
                    placeholder="{{ __('Parole') }}" />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Atcelt') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Dzēst Kontu') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
