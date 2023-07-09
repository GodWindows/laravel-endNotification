<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 darke:text-gray-200 leading-tight">
            {{ __("Nouveau projet ") }}
        </h2>
    </x-slot>
    <div class="h-screen">

        <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css">
      {{--   <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script> --}}

        <style>
            [x-cloak] {
                display: none;
            }

            [type="checkbox"] {
                box-sizing: border-box;
                padding: 0;
            }

            .form-checkbox,
            .form-radio {
                -webkit-appearance: none;
                -moz-appearance: none;
                appearance: none;
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
                display: inline-block;
                vertical-align: middle;
                background-origin: border-box;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
                flex-shrink: 0;
                color: currentColor;
                background-color: #fff;
                border-color: #e2e8f0;
                border-width: 1px;
                height: 1.4em;
                width: 1.4em;
            }

            .form-checkbox {
                border-radius: 0.25rem;
            }

            .form-radio {
                border-radius: 50%;
            }

            .form-checkbox:checked {
                background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3cpath d='M5.707 7.293a1 1 0 0 0-1.414 1.414l2 2a1 1 0 0 0 1.414 0l4-4a1 1 0 0 0-1.414-1.414L7 8.586 5.707 7.293z'/%3e%3c/svg%3e");
                border-color: transparent;
                background-color: currentColor;
                background-size: 100% 100%;
                background-position: center;
                background-repeat: no-repeat;
            }

            .form-radio:checked {
                background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3ccircle cx='8' cy='8' r='3'/%3e%3c/svg%3e");
                border-color: transparent;
                background-color: currentColor;
                background-size: 100% 100%;
                background-position: center;
                background-repeat: no-repeat;
            }
        </style>

<form id="myForm" method="post" action="{{route('project.add')}}" class="mt-6 space-y-6">
    @csrf
    <div>
        <div class="max-w-3xl mx-auto px-4 py-2">
            <div>
                <div class="pb-2">
                    <div class="flex flex-col  space-y-4 mx-auto sm:px-6 lg:px-8 max-w-4xl mt-2 px-6">
                        <div style="display : none"  id="step-1">
                            <div>
                                <x-input-label for="name" :value="__('Nom du projet :')"  class="font-bold mb-3 text-gray-700 block"/>
                                <x-text-input id="name" name="name" type="text" class="w-full px-4 py-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium"
                                placeholder="Entrer le nom du projet..." required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>
                            <div>
                                <x-input-label for="email" :value="__('Email du client :')" class="font-bold mb-3 mt-10 text-gray-700 block"/>
                                <x-text-input id="email" name="email" type="email" class="w-full px-4 py-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium"
                                placeholder="Entrer l'adresse email du client..." required />
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                            </div>
                        </div>
                        <div style="display : none"  id="step-2">
                            <div>
                                <x-input-label for="start_date" :value="__('Date du début de projet')" class="font-bold mb-1 text-gray-700 block"/>
                                <x-text-input id="start_date" type="date" name="start_date" :value="old('start_date')" required min="{{ date('Y-m-d') }}" class="w-full mb-10 px-4 py-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium"/>
                                <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                            </div>

                            <div>
                                <div>
                                    <x-input-label for="time" :value="__('Durée du projet')" class="font-bold mb-1 text-gray-700 block"/>
                                    <x-text-input id="time" type="number" name="time" :value="old('time')" min="0" required class="w-full px-4 py-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium"/>
                                    <x-input-error :messages="$errors->get('time')" class="mt-2" />
                                </div>

                                <div class="flex mt-2">
                                    <label
                                        class="flex justify-start items-center text-truncate rounded-lg bg-white pl-4 pr-6 py-3 shadow-sm mr-4">
                                        <div class="text-teal-600 mr-3">
                                            <input type="radio" required name="dmy" value="day" class="form-radio focus:outline-none focus:shadow-outline" @input="updateFrequencyMax" />
                                        </div>
                                        <div class="select-none text-gray-700">Jours</div>
                                    </label>

                                    <label
                                        class="flex justify-start items-center text-truncate rounded-lg bg-white pl-4 pr-6 py-3 shadow-sm mr-4">
                                        <div class="text-teal-600 mr-3">
                                            <input type="radio" required name="dmy" value="month" class="form-radio focus:outline-none focus:shadow-outline" @input="updateFrequencyMax"/>
                                        </div>
                                        <div class="select-none text-gray-700">Mois</div>
                                    </label>

                                    <label
                                        class="flex justify-start items-center text-truncate rounded-lg bg-white pl-4 pr-6 py-3 shadow-sm">
                                        <div class="text-teal-600 mr-3">
                                            <input type="radio" required name="dmy" value="year" class="form-radio focus:outline-none focus:shadow-outline" @input="updateFrequencyMax"/>
                                        </div>
                                        <div class="select-none text-gray-700">Années</div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div style="display : none"  id="step-3">
                            <div>
                                <div>
                                    <x-input-label for="freq_time" :value="__('Fréquence de rappel')" class="font-bold mb-1 text-gray-700 block"/>
                                    <x-text-input id="freq_time" type="number" name="freq_time" :value="old('freq_time')"  required min="0" class="w-full px-4 py-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium"/>
                                    <x-input-error :messages="$errors->get('freq_time')" class="mt-2" />
                                </div>
                                <div class="flex mt-2">
                                    <label
                                        class="flex justify-start items-center text-truncate rounded-lg bg-white pl-4 pr-6 py-3 shadow-sm mr-4">
                                        <div class="text-teal-600 mr-3">
                                            <input type="radio" required name="freq_dmy" value="day" class="form-radio focus:outline-none focus:shadow-outline" @input="updateFrequencyMax"/>
                                        </div>
                                        <div class="select-none text-gray-700">Jours</div>
                                    </label>

                                    <label
                                        class="flex justify-start items-center text-truncate rounded-lg bg-white pl-4 pr-6 py-3 shadow-sm mr-4">
                                        <div class="text-teal-600 mr-3">
                                            <input type="radio" required name="freq_dmy" value="month" class="form-radio focus:outline-none focus:shadow-outline" @input="updateFrequencyMax"/>
                                        </div>
                                        <div class="select-none text-gray-700">Mois</div>
                                    </label>

                                    <label
                                        class="flex justify-start items-center text-truncate rounded-lg bg-white pl-4 pr-6 py-3 shadow-sm">
                                        <div class="text-teal-600 mr-3">
                                            <input type="radio" required name="freq_dmy" value="year" class="form-radio focus:outline-none focus:shadow-outline" @input="updateFrequencyMax"/>
                                        </div>
                                        <div class="select-none text-gray-700">Années</div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div style="display : none"  id="step-4">
                            <div class="relative mb-3" data-te-input-wrapper-init>
                                <textarea
                                    class="peer block min-h-[auto] w-full rounded border-0 px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none darke:text-neutral-200 darke:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                                    id="exampleFormControlTextarea1"
                                    rows="3"
                                    name="warning_message"
                                    placeholder="Your message" required></textarea>
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
                                    placeholder="Your message" required></textarea>
                                <label
                                    for="exampleFormControlTextarea1"
                                    class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none darke:text-neutral-200 darke:peer-focus:text-primary"
                                    >Message de signalement de fin</label
                                >
                            </div>

                            <div class="flex items-center gap-4 pt-5">
                                <x-primary-button class="mx-auto">{{ __("Créer") }}</x-primary-button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Bottom Navigation -->
            <div class="mt-10 bottom-0 left-0 right-0 py-5shadow-md">
                <div class="max-w-3xl mx-auto px-4">
                    <div class="flex justify-between">
                        <div class="w-1/2">
                            <button type="button" onclick="previous_()" id="previous" class="w-32 focus:outline-none border border-transparent py-2 px-5 rounded-lg shadow-sm text-center text-white bg-blue-500 hover:bg-blue-600 font-medium">{{__("Précédent")}}</button>
                        </div>

                        <div class="w-1/2 text-right">
                            <button type="button" onclick="next_()" id="next" class="w-32 focus:outline-none border border-transparent py-2 px-5 rounded-lg shadow-sm text-center text-white bg-blue-500 hover:bg-blue-600 font-medium">{{__("Suivant")}}</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Bottom Navigation -->
        </div>
    </div>
</form>

</x-app-layout>
<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.js" integrity="sha512-Y+cHVeYzi7pamIOGBwYHrynWWTKImI9G78i53+azDb1uPmU1Dz9/r2BLxGXWgOC7FhwAGsy3/9YpNYaoBy7Kzg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.css" integrity="sha512-8D+M+7Y6jVsEa7RD6Kv/Z7EImSpNpQllgaEIQAtqHcI0H6F4iZknRj0Nx1DCdB+TwBaS+702BGWYC0Ze2hpExQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="{{asset('js/new-project.js')}}"></script>


