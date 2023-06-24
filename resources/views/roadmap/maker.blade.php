<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Roadmap Maker
        </h2>
        <p class="text-gray-600 leading-tight">
            Generate roadmap terkait materi yang ingin Anda pelajari dengan didukung oleh teknologi AI.
        </p>
    </x-slot>

    <div x-data="roadmapMaker()" class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="p-4 mb-6 text-sm text-blue-800 rounded-lg bg-blue-50" role="alert">
                        <span class="font-medium">Tips!</span> Setelah AI men-generate roadmap, Anda bisa klik salah
                        satu poin
                        untuk mencari referensi di Google.
                    </div>

                    <form class="flex gap-4">
                        <x-text-input x-model="input"
                                      id="topic"
                                      name="topic"
                                      type="text"
                                      class="block w-full"
                                      placeholder="Masukkan materi yang ingin anda pelajari..."
                                      :value="old('topic')"
                                      autofocus/>
                        <x-secondary-button x-on:click.prevent="makeRoadmap()"
                                            x-bind:disabled="loading"
                                            x-text="loading ? 'Loading...' : 'Generate Roadmap'"
                                            type="submit"
                                            class="whitespace-nowrap">Generate Roadmap
                        </x-secondary-button>
                    </form>

                    <template x-if="error">
                        <span x-text="error" class="mt-1 text-sm text-red-600"></span>
                    </template>

                    <template x-if="loading">
                        <h3 class="mt-6 text-lg text-center">Mohon tunggu sebentar...</h3>
                    </template>

                    <div x-cloak x-show="roadmaps.length > 0" class="mx-4 my-6 grid place-items-center">
                        <ul>
                            <template x-for="(roadmap, index) in roadmaps">
                                <li>
                                    <div x-show="index > 0" class="w-[2px] h-[35px] bg-black ml-[9px]"></div>

                                    <div class="flex gap-4">
                                        <svg class="w-[20px]" viewBox="0 0 100 100" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_17_12)">
                                                <circle cx="50" cy="50" r="45" stroke="black" stroke-width="10"/>
                                                <circle cx="50" cy="50" r="25" fill="black"/>
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_17_12">
                                                    <rect width="100" height="100" fill="white"/>
                                                </clipPath>
                                            </defs>
                                        </svg>

                                        <a x-bind:href='`//google.com/search?q=${oldInput} ${roadmap}`'
                                           x-text="roadmap"
                                           target="_blank"
                                           class="hover:underline"></a>
                                    </div>
                                </li>
                            </template>
                        </ul>

                        <x-primary-button @click.prevent="redirectToCreatePlanner()" class="ml-auto mt-8">Buat Plan
                            dengan Roadmap Ini
                        </x-primary-button>
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
                    } catch (e) {
                        this.error = e.response?.data?.message ?? e.message;
                    } finally {
                        this.loading = false;
                    }
                },
                redirectToCreatePlanner() {
                    const baseUrl = `{{ route('roadmap.planner.create') }}?topic=${this.oldInput}&`
                    let payload = '';
                    this.roadmaps.forEach((roadmap, index) => {
                        payload += `chapters[${index}][id]=${Math.random() * 1000000}&`
                        payload += `chapters[${index}][chapter]=${roadmap}&`
                        payload += `chapters[${index}][planned_hours]=0&`
                    });
                    window.location.href = baseUrl + payload;
                },
            };
        }
    </script>
</x-app-layout>
