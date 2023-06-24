<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Roadmap Maker
        </h2>
        <p class="text-gray-600 leading-tight">
            Buat roadmap terkait materi yang ingin anda pelajari!
        </p>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex gap-4">
                        <x-text-input id="search" name="search" type="text" class="block w-full" placeholder="Cari materi yang ingin anda pelajari..." :value="old('search')" autofocus />
                        <x-secondary-button>Cari</x-secondary-button>
                    </div>
                    <x-input-error class="mt-2" :messages="$errors->get('search')" />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
