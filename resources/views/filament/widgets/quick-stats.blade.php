<x-filament-widgets::widget>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach($this->getStats() as $stat)
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6 hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">
                            {{ $stat['label'] }}
                        </p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-2">
                            {{ $stat['value'] }}
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            {{ $stat['description'] }}
                        </p>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 rounded-full bg-{{ $stat['color'] }}-100 dark:bg-{{ $stat['color'] }}-900 flex items-center justify-center">
                            <x-filament::icon 
                                :icon="$stat['icon']" 
                                class="w-6 h-6 text-{{ $stat['color'] }}-600 dark:text-{{ $stat['color'] }}-400" 
                            />
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-filament-widgets::widget>
