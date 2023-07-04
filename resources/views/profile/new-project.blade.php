<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 darke:text-gray-200 leading-tight">
            {{ __("Nouveau projet ") }}
        </h2>
    </x-slot>


    <!-- component -->
    <!-- This is an example component -->
    <div class="h-screen">

        <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css">
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>

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

<form method="post" action="{{route('project.create')}}" class="mt-6 space-y-6">
    @csrf
    <div x-data="app()" x-cloak>
        <div class="max-w-3xl mx-auto px-4 py-10">

            <div x-show.transition="step === 'complete'">
                <div class="bg-white rounded-lg p-10 flex items-center shadow justify-between">
                    <div>
                        <svg class="mb-4 h-20 w-20 text-green-500 mx-auto" viewBox="0 0 20 20" fill="currentColor">  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>

                        <h2 class="text-2xl mb-4 text-gray-800 text-center font-bold">Registration Success</h2>

                        <div class="text-gray-600 mb-8">
                            Thank you. We have sent you an email to demo@demo.test. Please click the link in the message to activate your account.
                        </div>

                        <button
                            {{-- @click="step = 1" --}}
                            href="{{route('dashboard')}}"
                            class="w-40 block mx-auto focus:outline-none py-2 px-5 rounded-lg shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100 font-medium border"
                        >Back to home</button>
                    </div>
                </div>
            </div>

            <div x-show.transition="step != 'complete'">
                <!-- Top Navigation -->
                <div class="border-b-2 py-4">
                    <div class="uppercase tracking-wide text-xs font-bold text-gray-500 mb-1 leading-tight" x-text="`Step: ${step} of 4`"></div>
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div class="flex-1">
                            <div x-show="step === 1">
                                <div class="text-lg font-bold text-gray-700 leading-tight">Your Profile</div>
                            </div>

                            <div x-show="step === 2">
                                <div class="text-lg font-bold text-gray-700 leading-tight">Your Password</div>
                            </div>

                            <div x-show="step === 3">
                                <div class="text-lg font-bold text-gray-700 leading-tight">Tell me about yourself</div>
                            </div>

                            <div x-show="step === 4">
                                <div class="text-lg font-bold text-gray-700 leading-tight">Tell me about yourself</div>
                            </div>
                        </div>

                        <div class="flex items-center md:w-64">
                            <div class="w-full bg-white rounded-full mr-2">
                                <div class="rounded-full bg-green-500 text-xs leading-none h-2 text-center text-white" :style="'width: '+ parseInt(step / 4 * 100) +'%'"></div>
                            </div>
                            <div class="text-xs w-10 text-gray-600" x-text="parseInt(step / 4 * 100) +'%'"></div>
                        </div>
                    </div>
                </div>
                <!-- /Top Navigation -->

                <!-- Step Content -->
                <div class="py-10">
                            <div class="flex flex-col  space-y-4 mx-auto sm:px-6 lg:px-8 max-w-4xl mt-6 px-6">



                                <div x-show.transition.in="step === 1" x-ref="step1">

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


                                <div x-show.transition.in="step === 2" x-ref="step2">

                                                                {{-- <div class="mt-5">
                                        {{ __("Date de fin du projet") }} :
                                    </div>
                                    <div class="relative mb-3" data-te-datepicker-init data-te-input-wrapper-init>
                                        <input type="text" name="end_date" class="peer block min-h-[auto] w-full rounded border-0 px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" placeholder="Select a date" />
                                        <label for="floatingInput" class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary">
                                            Choisissez une date
                                        </label>
                                    </div>
                                    <x-input-error class="mt-2" :messages="$errors->get('end_date')" /> --}}

                                        <div>
                                            <x-input-label for="start_date" :value="__('Date du début de projet')" class="font-bold mb-1 text-gray-700 block"/>
                                            <x-text-input id="start_date" type="date" name="start_date" :value="old('start_date')" required min="{{ date('Y-m-d') }}" class="w-full mb-10 px-4 py-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium"/>
                                            <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                                        </div>

                                        <div>
                                            <div>
                                                <x-input-label for="time" :value="__('Durée du projet')" class="font-bold mb-1 text-gray-700 block"/>
                                                <x-text-input id="time" type="number" name="time" :value="old('time')"  required class="w-full px-4 py-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium"/>
                                                <x-input-error :messages="$errors->get('time')" class="mt-2" />
                                            </div>

                                            <div class="flex mt-2">
                                                <label
                                                    class="flex justify-start items-center text-truncate rounded-lg bg-white pl-4 pr-6 py-3 shadow-sm mr-4">
                                                    <div class="text-teal-600 mr-3">
                                                        <input type="radio" x-model="dmy" value="day" class="form-radio focus:outline-none focus:shadow-outline" @input="updateFrequencyMax" />
                                                    </div>
                                                    <div class="select-none text-gray-700">Jours</div>
                                                </label>

                                                <label
                                                    class="flex justify-start items-center text-truncate rounded-lg bg-white pl-4 pr-6 py-3 shadow-sm mr-4">
                                                    <div class="text-teal-600 mr-3">
                                                        <input type="radio" x-model="dmy" value="month" class="form-radio focus:outline-none focus:shadow-outline" @input="updateFrequencyMax"/>
                                                    </div>
                                                    <div class="select-none text-gray-700">Mois</div>
                                                </label>

                                                <label
                                                    class="flex justify-start items-center text-truncate rounded-lg bg-white pl-4 pr-6 py-3 shadow-sm">
                                                    <div class="text-teal-600 mr-3">
                                                        <input type="radio" x-model="dmy" value="year" class="form-radio focus:outline-none focus:shadow-outline" @input="updateFrequencyMax"/>
                                                    </div>
                                                    <div class="select-none text-gray-700">Années</div>
                                                </label>
                                            </div>
                                        </div>
                                            {{-- <div>
                                                <select name="dmy" id="dmy" class="flex mt-5">
                                                    <option>Selectionner</option>
                                                    <option value="day">Jours</option>
                                                    <option value="month">Mois</option>
                                                    <option value="year">Années</option>
                                                </select>
                                            </div> --}}

                                </div>


                                <div x-show.transition.in="step === 3" x-ref="step3">

                                    <div>
                                        <div>
                                            <x-input-label for="freq_time" :value="__('Frequence de rappel')" class="font-bold mb-1 text-gray-700 block"/>
                                            <x-text-input id="freq_time" type="number" name="freq_time" :value="old('freq_time')"  required min="0" max=0 class="w-full px-4 py-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium"/>
                                            <x-input-error :messages="$errors->get('freq_time')" class="mt-2" />
                                        </div>

                                        <div class="flex mt-2">
                                            <label
                                                class="flex justify-start items-center text-truncate rounded-lg bg-white pl-4 pr-6 py-3 shadow-sm mr-4">
                                                <div class="text-teal-600 mr-3">
                                                    <input type="radio" x-model="freq_dmy" value="day" class="form-radio focus:outline-none focus:shadow-outline" @input="updateFrequencyMax"/>
                                                </div>
                                                <div class="select-none text-gray-700">Jours</div>
                                            </label>

                                            <label
                                                class="flex justify-start items-center text-truncate rounded-lg bg-white pl-4 pr-6 py-3 shadow-sm mr-4">
                                                <div class="text-teal-600 mr-3">
                                                    <input type="radio" x-model="freq_dmy" value="month" class="form-radio focus:outline-none focus:shadow-outline" @input="updateFrequencyMax"/>
                                                </div>
                                                <div class="select-none text-gray-700">Mois</div>
                                            </label>

                                            <label
                                                class="flex justify-start items-center text-truncate rounded-lg bg-white pl-4 pr-6 py-3 shadow-sm">
                                                <div class="text-teal-600 mr-3">
                                                    <input type="radio" x-model="freq_dmy" value="year" class="form-radio focus:outline-none focus:shadow-outline" @input="updateFrequencyMax"/>
                                                </div>
                                                <div class="select-none text-gray-700">Années</div>
                                            </label>
                                        </div>

                                        {{-- <div>
                                            <select name="r-dmy" id="r-dmy" class="flex mt-5">
                                                <option>Selectionner</option>
                                                <option value="day">Jours</option>
                                                <option value="month">Mois</option>
                                                <option value="year">Années</option>
                                            </select>
                                        </div> --}}
                                    </div>

                                </div>

                                <div x-show.transition.in="step === 4" x-ref="step4">

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
                        <!-- / Step Content -->
                    </div>
                </div>

                <!-- Bottom Navigation -->
                <div class="fixed bottom-0 left-0 right-0 py-5 bg-white shadow-md" x-show="step != 'complete'">
                    <div class="max-w-3xl mx-auto px-4">
                        <div class="flex justify-between">
                            <div class="w-1/2">
                                <button
                                    x-show="step > 1"
                                    @click="step--"
                                    class="w-32 focus:outline-none py-2 px-5 rounded-lg shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100 font-medium border"
                                >Previous</button>
                            </div>

                            <div class="w-1/2 text-right">
                                <button
                                    x-show="step < 4"
                                    @click="step++"
                                    class="w-32 focus:outline-none border border-transparent py-2 px-5 rounded-lg shadow-sm text-center text-white bg-blue-500 hover:bg-blue-600 font-medium"
                                >Next</button>

                                <button
                                    @click="step = 'complete'"
                                    type="submit"
                                    x-show="step === 4"
                                    class="w-32 focus:outline-none border border-transparent py-2 px-5 rounded-lg shadow-sm text-center text-white bg-blue-500 hover:bg-blue-600 font-medium"
                                >Complete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

</x-app-layout>

<script>
    function app() {
        return {
            step: 1,
            dmy: '',
            freq_dmy: '',
            updateFrequencyMax() {
                const duration = parseInt(document.getElementById('time').value);
                let maxFrequency;


                if (this.dmy === 'year') {
                    if (this.freq_dmy === 'day') {
                        maxFrequency = duration * 365;
                    } else if (this.freq_dmy === 'month') {
                        maxFrequency = duration * 12;
                    } else if (this.freq_dmy === 'year'){
                        maxFrequency = duration;
                    }
                } else if (this.dmy === 'month') {
                    if (this.freq_dmy === 'day') {
                        maxFrequency = duration * 30;
                    } else {
                        maxFrequency = duration;
                    }
                } else {
                    maxFrequency = 0;
                }

                console.log(maxFrequency);

                document.getElementById('freq_time').setAttribute('max', maxFrequency);
            },
            goToStep(step) {
                this.step = step;
            },
        };
    }

    function validateStep(step) {
        const fields = document.querySelectorAll(`[x-ref="${step}"] input[required]`);

        for (let i = 0; i < fields.length; i++) {
            if (!fields[i].value) {
            return false;
            }
        }

        return true;
    }

</script>



