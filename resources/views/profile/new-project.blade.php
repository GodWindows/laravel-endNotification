<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 darke:text-gray-200 leading-tight">
            {{ __("Nouveau projet ") }}
        </h2>
    </x-slot>
    <form method="post" action="{{route('project.add')}}" class="mt-6 space-y-6">
        @csrf
        <div class="flex flex-col  space-y-4 mx-auto sm:px-6 lg:px-8 max-w-4xl mt-6 px-6">
            <div>
                <x-input-label for="name" :value="__('Nommez le projet :')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required autofocus />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>
            <div>
                <x-input-label for="email" :value="__('Email du client :')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" required />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>
            <div class="mt-5">
                {{ __("Durée du projet") }} :
            </div>
            <div class="flex flex-col md:flex-row gap-3">
                <div class="relative mb-3" data-te-input-wrapper-init>
                    <input
                    name="number"
                      type="number"
                      class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none darke:text-neutral-200 darke:placeholder:text-neutral-200 darke:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                      id="exampleFormControlInput1"
                      value="10"
                      required />
                </div>
                <select data-te-select-init name="time" >
                    <option value="1">Semaine(s)</option>
                    <option value="2" selected>Mois</option>
                    <option value="3">Année(s)</option>
                </select>
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('number')" />
            <x-input-error class="mt-2" :messages="$errors->get('time')" />
            <div class="relative mb-3" data-te-input-wrapper-init>
                <textarea
                    class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none darke:text-neutral-200 darke:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
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
                    class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none darke:text-neutral-200 darke:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
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
    </form>


</x-app-layout>
