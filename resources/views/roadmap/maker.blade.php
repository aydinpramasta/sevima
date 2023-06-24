<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Roadmap Maker
        </h2>
        <p class="text-gray-600 leading-tight">
            Buat roadmap terkait materi yang ingin anda pelajari!
        </p>
    </x-slot>

    <div x-data="roadmapMaker()" class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="p-4 mb-6 text-sm text-blue-800 rounded-lg bg-blue-50" role="alert">
                        <span class="font-medium">Tips!</span> Setelah membuat roadmap, Anda bisa klik salah satu poin untuk mencari referensi di Google.
                    </div>

                    <form class="flex gap-4">
                        <x-text-input x-model="input"
                                      id="topic"
                                      name="topic"
                                      type="text"
                                      class="block w-full"
                                      placeholder="Masukkan materi yang ingin anda pelajari..."
                                      :value="old('topic')"
                                      autofocus />
                        <x-secondary-button x-on:click.prevent="makeRoadmap()"
                                            x-bind:disabled="loading"
                                            x-text="loading ? 'Loading...' : 'Buat Roadmap'"
                                            type="submit"
                                            class="whitespace-nowrap">Buat Roadmap</x-secondary-button>
                    </form>

                    <template x-if="error">
                        <span x-text="error" class="mt-1 text-sm text-red-600"></span>
                    </template>

                    <div class="mx-4 my-6">
                        <ul class="space-y-3">
                            <template x-for="roadmap in roadmaps">
                                <li>
                                    <a x-bind:href='`//google.com/search?q=Belajar materi ${oldInput} bagian "${roadmap}"`'
                                       x-text="roadmap"
                                       target="_blank"
                                       class="hover:underline"></a>
                                </li>
                            </template>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function roadmapMaker() {
            return {
                roadmaps: [],
                input: '',
                oldInput: '',
                loading: false,
                error: '',
                async makeRoadmap() {
                    this.oldInput = this.input;
                    this.loading = true;
                    this.error = '';

                    try {
                        const result = await axios.get(`{{ route('api.roadmap.maker') }}?topic=${this.input}`);
                        this.roadmaps = result.data.data.result;
                        console.log(this.roadmaps, this.roadmaps.length);
                    } catch (e) {
                        this.error = e.response?.data?.message ?? e.message;
                    } finally {
                        this.loading = false;
                    }
                },
            };
        }
    </script>
</x-app-layout>
