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
                    @if (session('error') === 'frequency greater than duration')
                        <div class="bg-red-600 text-center max-w-sm mx-auto py-4 lg:px-4 mb-10"  x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 20000)"
                        class="text-sm text-gray-600 darke:text-gray-400">
                            <div class="p-2 items-center text-white leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                            <span class="flex rounded-full  uppercase px-2 py-1 text-xs font-bold mr-3"> {{__('!!')}} </span>
                            <span class="font-semibold mr-2 text-left flex-auto">{{ __("La fréquence de rappel ne peut pas être supérieure à la durée du projet") }}</span>
                            </div>
                        </div>
                    @endif

                    <div class="mt-6 space-y-6">
                        <div class="flex items-center gap-4">
                            <x-primary-button class="mt-4 bg-red-800" id="myBtn">{{ __("Supprimer ce projet") }}</x-primary-button>
                        </div>
                    </div>
                    <div>
                        <form method="post" action="{{route('project.edit')}}" class="mt-6 space-y-1">
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
                                <div>
                                    <x-input-label for="start_date" :value="__('Date du début de projet')" class="font-bold mb-1 text-gray-700 block"/>
                                    <x-text-input id="start_date" type="date" name="start_date" value="{{$project->start_date}}" required class="w-full mb-10 px-4 py-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium"/>
                                    <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                                </div>

                                <div>
                                    <div>
                                        <x-input-label for="time" :value="__('Durée du projet')" class="font-bold mb-1 text-gray-700 block"/>
                                        <x-text-input id="time" type="number" name="time" value="{{(($project->duration)/($project->duration_dmy))}}" min="0" required class="w-full px-4 py-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium"/>
                                        <x-input-error :messages="$errors->get('time')" class="mt-2" />
                                    </div>

                                    <div class="flex mt-2">
                                        <label
                                            class="flex justify-start items-center text-truncate rounded-lg bg-white pl-4 pr-6 py-3 shadow-sm mr-4">
                                            <div class="text-teal-600 mr-3">
                                                <input @if ($project->duration_dmy==1)
                                                    checked
                                                @endif type="radio" required name="dmy" value="day" class="form-radio focus:outline-none focus:shadow-outline"  />
                                            </div>
                                            <div class="select-none text-gray-700">Jours</div>
                                        </label>

                                        <label
                                            class="flex justify-start items-center text-truncate rounded-lg bg-white pl-4 pr-6 py-3 shadow-sm mr-4">
                                            <div class="text-teal-600 mr-3">
                                                <input @if ($project->duration_dmy==30)
                                                checked
                                            @endif type="radio" required name="dmy" value="month" class="form-radio focus:outline-none focus:shadow-outline" />
                                            </div>
                                            <div class="select-none text-gray-700">Mois</div>
                                        </label>

                                        <label
                                            class="flex justify-start items-center text-truncate rounded-lg bg-white pl-4 pr-6 py-3 shadow-sm">
                                            <div class="text-teal-600 mr-3">
                                                <input @if ($project->duration_dmy==365)
                                                checked
                                            @endif type="radio" required name="dmy" value="year" class="form-radio focus:outline-none focus:shadow-outline" />
                                            </div>
                                            <div class="select-none text-gray-700">Années</div>
                                        </label>
                                    </div>
                                    <x-input-error :messages="$errors->get('dmy')" class="mt-2" />
                                </div>

                                <div>
                                    <div>
                                        <x-input-label for="freq_time" :value="__('Fréquence de rappel')" class="font-bold mb-1 text-gray-700 block"/>
                                        <x-text-input id="freq_time" type="number" name="freq_time" value="{{(($project->frequency)/($project->frequency_dmy))}}" min="0" required class="w-full px-4 py-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium"/>
                                        <x-input-error :messages="$errors->get('freq_time')" class="mt-2" />
                                    </div>

                                    <div class="flex mt-2">
                                        <label
                                            class="flex justify-start items-center text-truncate rounded-lg bg-white pl-4 pr-6 py-3 shadow-sm mr-4">
                                            <div class="text-teal-600 mr-3">
                                                <input @if ($project->frequency_dmy==1)
                                                    checked
                                                @endif type="radio" required name="freq_dmy" value="day" class="form-radio focus:outline-none focus:shadow-outline"  />
                                            </div>
                                            <div class="select-none text-gray-700">Jours</div>
                                        </label>

                                        <label
                                            class="flex justify-start items-center text-truncate rounded-lg bg-white pl-4 pr-6 py-3 shadow-sm mr-4">
                                            <div class="text-teal-600 mr-3">
                                                <input @if ($project->frequency_dmy==30)
                                                checked
                                            @endif type="radio" required name="freq_dmy" value="month" class="form-radio focus:outline-none focus:shadow-outline" />
                                            </div>
                                            <div class="select-none text-gray-700">Mois</div>
                                        </label>

                                        <label
                                            class="flex justify-start items-center text-truncate rounded-lg bg-white pl-4 pr-6 py-3 shadow-sm">
                                            <div class="text-teal-600 mr-3">
                                                <input @if ($project->frequency_dmy==365)
                                                checked
                                            @endif type="radio" required name="freq_dmy" value="year" class="form-radio focus:outline-none focus:shadow-outline" />
                                            </div>
                                            <div class="select-none text-gray-700">Années</div>
                                        </label>
                                    </div>
                                    <x-input-error :messages="$errors->get('freq_dmy')" class="mt-2" />
                                </div>
                                <x-input-error class="mt-2" :messages="$errors->get('end_date')" />
                                <div class="relative mb-3" data-te-input-wrapper-init>
                                    <textarea
                                        class="peer block min-h-[auto] w-full rounded border-0 px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none darke:text-neutral-200 darke:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                                        id="exampleFormControlTextarea1"
                                        rows="3"
                                        name="reminder_message"
                                        placeholder="Your message" required> {{ $project->reminder_message }}</textarea>
                                    <label
                                        for="exampleFormControlTextarea1"
                                        class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none darke:text-neutral-200 darke:peer-focus:text-primary"
                                        >Message de rappel </label
                                    >
                                </div>
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
    <script>

    </script>
</x-app-layout>
