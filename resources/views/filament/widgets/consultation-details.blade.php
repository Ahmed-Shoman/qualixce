<div class="space-y-4 p-4">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="space-y-2">
            <div class="flex items-center gap-2">
                <x-filament::icon icon="heroicon-o-user" class="w-5 h-5 text-primary-500" />
                <span class="font-semibold text-gray-700 dark:text-gray-300">{{ __('Name') }}:</span>
            </div>
            <p class="text-gray-900 dark:text-gray-100 ml-7">{{ $record->name }}</p>
        </div>

        <div class="space-y-2">
            <div class="flex items-center gap-2">
                <x-filament::icon icon="heroicon-o-envelope" class="w-5 h-5 text-info-500" />
                <span class="font-semibold text-gray-700 dark:text-gray-300">{{ __('Email') }}:</span>
            </div>
            <p class="text-gray-900 dark:text-gray-100 ml-7">
                <a href="mailto:{{ $record->email }}" class="text-primary-600 hover:underline">
                    {{ $record->email }}
                </a>
            </p>
        </div>

        <div class="space-y-2">
            <div class="flex items-center gap-2">
                <x-filament::icon icon="heroicon-o-phone" class="w-5 h-5 text-success-500" />
                <span class="font-semibold text-gray-700 dark:text-gray-300">{{ __('Mobile Phone') }}:</span>
            </div>
            <p class="text-gray-900 dark:text-gray-100 ml-7">
                <a href="tel:{{ $record->mobile_phone }}" class="text-primary-600 hover:underline">
                    {{ $record->mobile_phone }}
                </a>
            </p>
        </div>

        <div class="space-y-2">
            <div class="flex items-center gap-2">
                <x-filament::icon icon="heroicon-o-clock" class="w-5 h-5 text-warning-500" />
                <span class="font-semibold text-gray-700 dark:text-gray-300">{{ __('Requested At') }}:</span>
            </div>
            <p class="text-gray-900 dark:text-gray-100 ml-7">{{ $record->created_at->format('d M Y, H:i A') }}</p>
        </div>
    </div>

    <div class="space-y-2 pt-4 border-t border-gray-200 dark:border-gray-700">
        <div class="flex items-center gap-2">
            <x-filament::icon icon="heroicon-o-chat-bubble-left-right" class="w-5 h-5 text-primary-500" />
            <span class="font-semibold text-gray-700 dark:text-gray-300">{{ __('Message') }}:</span>
        </div>
        <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4 ml-7">
            <p class="text-gray-900 dark:text-gray-100 whitespace-pre-wrap">{{ $record->message }}</p>
        </div>
    </div>
</div>
