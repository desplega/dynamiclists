<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upload list') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action={{ route('dashboard') }} enctype="multipart/form-data">
                        <div class="mt-4">
                            <x-input-label for="csvfile" :value="__('CSV List')" />

                            <input class="mt-1 w-full" name="csvfile" type="file" id="csvfile">
                            <x-input-error :messages="$errors->get('csvfile')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button type="reset" class="ml-3">
                                {{ __('Reset') }}
                            </x-primary-button>
                            <x-primary-button class="ml-3">
                                {{ __('Upload') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
