<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Chirps') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form action="{{route ('chirps.store')}}" method="POST">
                        @csrf
                        <textarea class="bg-transparent block w-full rounded-md border-gray-300 bg-white shadow-sm" name="message" style="background-color: transparent;" placeholder="{{__('what do you mind?')}}">{{old ('message')}}</textarea>
                        @error('message')
                        <div class="text-red-500 mt-3">{{ $message }}</div>
                        @enderror
                        <x-input-error :messages="$errors->get('message')" />
                        <x-primary-button class="mt-4">Chirps</x-primary-button>
                    </form>
                </div>
            </div>
            <div class="mt-6 bg-white dark:bg-gray-800 shadow-sm rounded-lg divide-y dark:divide-gray-900">

                @foreach ($chirps as $chirp)
                <div class="p-6 flex space-x-2">
                    <svg class="h-6 w-6 text-gray-600 dark:text-gray-400 -scalex-100" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                    </svg>
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-gray-800 dark:text-gray-200">
                                    {{ $chirp -> user ->name}}
                                </span>
                                <small class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ $chirp -> created_at-> format('j M Y, g: i a') }}</small>
                                @if ($chirp->created_at != $chirp->updated_at)
                                <small class="ml-2 text-sm text-gray-600 dark:text-gray-400"> &middot; {{ __('edited') }}</small>
                                @endif
                            </div>
                        </div>
                        <p class="mt-4 text-lg text-gray-900 dark:text-gray-100">{{ $chirp-> message }}</p>

                    </div>

                    @can('update', $chirp)
                    <x-dropdown>
                        <x-slot name="trigger">
                            <button><svg class="h-6 w-6 text-gray-500 dark:text-gray-200 xmlns=" http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route ('chirps.edit', $chirp)">
                                {{__('Edit Chirp')}}
                            </x-dropdown-link>
                            <form method="POST" action="{{route ('chirps.destroy', $chirp) }}">
                                @csrf @method('DELETE')
                                <x-dropdown-link :href="route ('chirps.destroy', $chirp)" onclick="event.preventDefault(); this.closest('form').submit(); ">
                                    {{__('Delete Chirp')}}
                                </x-dropdown-link>
                            </form>
                            
                        </x-slot>
                    </x-dropdown>
                    @endcan
                </div>

                @endforeach

            </div>
        </div>
    </div>
</x-app-layout>