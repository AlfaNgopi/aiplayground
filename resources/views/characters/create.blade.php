<x-layouts.app>
    <div class="mb-6 flex items-center text-sm">
        <a href="{{ route('dashboard') }}" class="text-blue-600 dark:text-blue-400 hover:underline">{{ __('Dashboard') }}</a>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-2 text-gray-400" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <a href="{{ route('characters.index') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Characters</a>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-2 text-gray-400" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <span class="text-gray-500 dark:text-gray-400">{{ $title ?? __('Create') }}</span>
    </div>

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Create Characters</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-1">{{ $subheading ?? __('Fill in the details below') }}</p>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
        @if ($errors->any())
        <div class="bg-red-50 dark:bg-red-900 text-red-700 dark:text-red-300 p-4">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif


        <div class="p-6">
            <form action="{{ route('characters.store') }}" method="POST" class="max-w-2xl" enctype="multipart/form-data">
                @csrf
                @method('POST')

                <!-- 'character_name',
                'character_avatar',
                'character_concept',
                'ai_model',
                'system_prompt',
                'is_proactive',
                'proactive_intensity',
                'last_proactive_time',
                'quiet_start',
                'quiet_end',
                -->


                <div class="mb-4">
                    <x-forms.input label="Character Name" name="character_name"  value="{{ old('character_name') }}" required />
                </div>

                <div class="mb-4">
                    <x-forms.file label="Character Avatar" name="character_avatar"  value="{{ old('character_avatar') }}" />
                </div>

                <div class="mb-4">
                    <x-forms.file label="Character Concept" name="character_concept" value="{{ old('character_concept') }}" />
                </div>

                <div class="mb-4">
                    <x-forms.select label="AI Model" name="ai_model" :options="$aiModels" value="{{ old('ai_model') }}" required />
                </div>

                <div class="mb-4">
                    <x-forms.textarea label="System Prompt" name="system_prompt" value="{{ old('system_prompt') }}" />
                </div>

                <div class="mb-4">
                    <x-forms.checkbox label="Is Proactive" name="is_proactive" value="true" />
                </div>

                <div class="mb-4">
                    <x-forms.input label="Proactive Intensity" name="proactive_intensity" type="number" value="{{ old('proactive_intensity') }}" />
                </div>

                <div class="mb-4">
                    <x-forms.input label="Last Proactive Time" name="last_proactive_time" type="datetime-local" value="{{ old('last_proactive_time') }}" />
                </div>

                <div class="mb-4">
                    <x-forms.input label="Quiet Start" name="quiet_start" type="time" value="{{ old('quiet_start') }}" />
                </div>

                <div class="mb-4">
                    <x-forms.input label="Quiet End" name="quiet_end" type="time" value="{{ old('quiet_end') }}" />
                </div>





                <div class="flex gap-3">
                    <x-button type="primary">{{ __('Create') }}</x-button>
                    <a href="{{ route('characters.index') }}" class="text-white font-medium py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 transition-colors flex items-center justify-center cursor-pointer bg-gray-600 hover:bg-gray-700 focus:ring-gray-500 dark:bg-gray-500 dark:hover:bg-gray-600">
                        {{ __('Batal') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>