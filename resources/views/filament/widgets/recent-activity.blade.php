<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            <div class="flex items-center gap-2">
                <x-filament::icon icon="heroicon-o-clock" class="w-5 h-5 text-primary-500" />
                <span>{{ __('Recent Activity') }}</span>
            </div>
        </x-slot>

        <div class="space-y-3">
            @forelse($this->getRecentActivities() as $activity)
                <div class="flex items-start gap-3 p-3 rounded-lg bg-gray-50 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 rounded-full bg-{{ $activity['color'] }}-100 dark:bg-{{ $activity['color'] }}-900 flex items-center justify-center">
                            <x-filament::icon 
                                :icon="$activity['icon']" 
                                class="w-5 h-5 text-{{ $activity['color'] }}-600 dark:text-{{ $activity['color'] }}-400" 
                            />
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 dark:text-gray-100">
                            {{ $activity['title'] }}
                        </p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 truncate">
                            {{ $activity['description'] }}
                        </p>
                        <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">
                            {{ $activity['time']->diffForHumans() }}
                        </p>
                    </div>
                </div>
            @empty
                <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                    <x-filament::icon icon="heroicon-o-inbox" class="w-12 h-12 mx-auto mb-2 opacity-50" />
                    <p>{{ __('No recent activity') }}</p>
                </div>
            @endforelse
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
