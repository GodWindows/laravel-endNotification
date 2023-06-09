<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 darke:text-gray-200 leading-tight">

            <span class="text-red-500 mt-4">
                {{ __('Projet ') }}
                {{ $project->name }}
            </span>
        </h2>
    </x-slot>

    <div class="py-12 mx-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white darke:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 darke:text-gray-100 max-w-7xl mx-auto">
                    @if (session('success') === 'Project updated successfully')
                        <div class="bg-green-600 text-center max-w-sm mx-auto py-4 lg:px-4 mb-10"  x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 3000)"
                        class="text-sm text-gray-600 darke:text-gray-400">
                            <div class="p-2 items-center text-white leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                            <span class="flex rounded-full  uppercase px-2 py-1 text-xs font-bold mr-3"> {{__('OK')}} </span>
                            <span class="font-semibold mr-2 text-left flex-auto">{{ __("Projet modifié avec succès.") }}</span>
                            </div>
                        </div>
                    @endif

                    <div class="mt-6 space-y-6">
                        <div class="flex items-center gap-4">
                            <x-primary-button class="mt-4 bg-red-800" id="myBtn">{{ __("Supprimer ce projet") }}</x-primary-button>
                        </div>
                    </div>
                    <div>
                        <form method="post" action="{{route('project.update')}}" class="mt-6 space-y-1">
                            @csrf
                            <input type="text" value="{{$project->id}}" name="id" hidden>
                            <div class="flex flex-col  space-y-4 mt-6">
                                <input type="text" value="{{ $project->id }}" hidden disabled name="id">
                                <div>
                                    <x-input-label for="name" :value="__('Nom du projet')" />
                                    <input id="name" name="name" value="{{ $project->name }}" type="text"  class="mt-1 block w-full border-gray-300 darke:border-gray-700 darke:bg-gray-900 darke:text-gray-300 focus:border-indigo-500 darke:focus:border-indigo-600 focus:ring-indigo-500 darke:focus:ring-indigo-600 rounded-md shadow-sm" required autofocus autocomplete="none" />
                                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                </div>

                                <div>
                                    <x-input-label for="email" :value="__('Email du client :')" />
                                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"  value="{{ $project->email }}" required />
                                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
                                </div>
                                <div class="mt-5">
                                    {{ __("Date de fin du projet") }} :
                                </div>
                                <div class="relative mb-3" data-te-datepicker-init data-te-input-wrapper-init>
                                    <input type="text"  value="{{ reverseConvertDate($project->end_date) }}" name="end_date" class="peer block min-h-[auto] w-full rounded border-0 px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" placeholder="Select a date" />
                                    <label for="floatingInput" class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary">
                                        Choisissez une date
                                    </label>
                                </div>
                                <x-input-error class="mt-2" :messages="$errors->get('end_date')" />
                                <div class="relative mb-3" data-te-input-wrapper-init>
                                    <textarea
                                        class="peer block min-h-[auto] w-full rounded border-0 px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none darke:text-neutral-200 darke:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                                        id="exampleFormControlTextarea1"
                                        rows="3"
                                        name="warning_message"
                                        placeholder="Your message" required> {{ $project->warning_message }}</textarea>
                                    <label
                                        for="exampleFormControlTextarea1"
                                        class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none darke:text-neutral-200 darke:peer-focus:text-primary"
                                        >Message d'avertissement </label
                                    >
                                    </div>
                                    <div class="relative mb-3" data-te-input-wrapper-init>
                                    <textarea
                                        class="peer block min-h-[auto] w-full rounded border-0 px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none darke:text-neutral-200 darke:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                                        id="exampleFormControlTextarea1"
                                        rows="3"
                                        name="end_message"
                                        placeholder="Your message" required> {{ $project->end_message }}</textarea>
                                    <label
                                        for="exampleFormControlTextarea1"
                                        class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none darke:text-neutral-200 darke:peer-focus:text-primary"
                                        >Message de signalement de fin</label
                                    >
                                    </div>

                                <div class="flex items-center gap-4 pt-5">
                                    <x-primary-button class="mx-auto">{{ __("Modifier") }}</x-primary-button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- The Modal -->
                    <div id="myModal" class="modal">
                        <!-- Modal content -->
                        <div class="modal-content-dev w-4/5 md:w-1/2">
                            <span class="close">&times;</span>
                            <div class=" flex flex-col gap-6 mx-auto">
                                <span>Êtes vous sûr(e)?</span>
                                <a href="" class="mx-auto" id="link">
                                    <a href="{{route('project.delete', $project->id)}}">
                                        <x-primary-button>{{ __("Oui") }}</x-primary-button>
                                    </a>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href=" {{ asset('css/modal.css') }} ">
    <script src=" {{ asset('js/modal.js') }} "></script>
</x-app-layout>
