<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 darke:text-gray-200 leading-tight">
            <div class="mb-5 md:mb-0">
                {{ __('Dashboard') }}
            </div>
            <a href="{{ route('view.admins.edit') }}">
                <div class="md:float-right hover:bg-slate-200 rounded-md border py-3 md:p-3 cursor-pointer" id="myBtn">
                Modifier les admins
                </div>
            </a>
            <br>
            <a href="{{route('new_project')}}">
                <x-primary-button class="mt-4">{{ __("Créer un projet") }}</x-primary-button>
            </a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white darke:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 darke:text-gray-100">
                    @if (count($projects)>0)
                    <div class="mb-6">
                        {{__('Vos projets')}}:
                    </div>
                    <div class="flex flex-wrap -mx-4">
                        @foreach ($projects as $project)
                            <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/4 px-4 mb-8 project-card">
                                <a href="{{route('view.project', $project->id)}}">
                                    <div class="bg-gray-100 rounded-lg shadow-lg p-6">
                                        <h2 class="text-lg font-medium text-gray-900 mb-4">{{$project->name}}</h2>
                                        <p class="text-gray-700">
                                            <div class="mb-6 h-5 w-full bg-neutral-200 darke:bg-neutral-600">
                                                <div class="h-5 bg-primary" style="width: {{ progress($project) }}%"> {{ progress($project) }}%</div>
                                            </div>
                                        </p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white darke:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 darke:text-gray-100">
                            {{ __("Vous n'avez aucun projet actuellement. Créez-en un!") }} <br>
                            <a href="{{ route('new_project') }}">
                                <x-primary-button class="mt-4">{{ __("Créer un projet") }}</x-primary-button>
                            </a>
                        </div>
                    </div>
                @endif
                </div>
            </div>
        </div>



        @if (session('success') === 'Project created successfully')
            <div class="bg-green-600 text-center max-w-sm mx-auto py-4 lg:px-4"  x-data="{ show: true }"
            x-show="show"
            x-transition
            x-init="setTimeout(() => show = false, 2000)"
            class="text-sm text-gray-600 darke:text-gray-400">
                <div class="p-2 items-center text-white leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                <span class="flex rounded-full  uppercase px-2 py-1 text-xs font-bold mr-3"> {{__('OK')}} </span>
                <span class="font-semibold mr-2 text-left flex-auto">{{ __('Project created successfully') }}</span>
                </div>
            </div>
        @endif


    </div>
</x-app-layout>
