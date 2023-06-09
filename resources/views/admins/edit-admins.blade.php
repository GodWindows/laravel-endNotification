<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 darke:text-gray-200 leading-tight">
            <div class="mb-5 md:mb-0">
                {{ __('Modifier les admins') }}
            </div>
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white darke:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mx-auto">
                <div class="p-6 text-gray-900 darke:text-gray-100">
                    <ul class="max-w-md divide-y divide-gray-200 flex flex-col mx-auto backdrop:">
                        @foreach ($admins as $admin)
                            <li class="pb-4 pt-4">
                                <div class="flex flex-row items-center justify-items-center space-x-4">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                            {{$admin->email}}
                                        </p>
                                        <p class="text-sm text-gray-500 truncate">
                                            @if ($admin->is_super_admin==1)
                                                Super Admin
                                            @else
                                                Admin
                                            @endif
                                        </p>
                                    </div>
                                    <x-primary-button class="myBtn"  id="{{$admin->id}}">{{ __("Supprimer") }}</x-primary-button>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    <hr>

                    <div class="mx-auto flex flex-col gap-6 w-fit my-6">
                        <form action="{{route('admins.add')}}" method="post">
                        @csrf
                            <input type="text" value="0" hidden name="is_super_admin">
                            <input type="email" name="email" required class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <x-primary-button>{{ __("Nouvel Admin") }}</x-primary-button>
                        </form>

                        <form action="{{route('admins.add')}}" method="post">
                        @csrf
                            <input type="text" value="1" hidden name="is_super_admin">
                            <input type="email" name="email" required class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <x-primary-button>{{ __("Nouveau Super Admin") }}</x-primary-button>
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
                                    <x-primary-button>{{ __("Oui") }}</x-primary-button>
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
        var btns = document.getElementsByClassName("myBtn");

        Array.from(btns).forEach( function (btn) {
            btn.onclick = function() {
                modal.style.display = "block";
                link = document.getElementById("link");
                link.href = "{{ config('app.url') }}"+"/delete-admins/"+btn.id;
            }
        });
    </script>
</x-app-layout>
