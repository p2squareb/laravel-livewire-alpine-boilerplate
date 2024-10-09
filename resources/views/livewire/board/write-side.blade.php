<div>
    <div class="p-3 mb-3 bg-white border border-gray-200 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <div class="flow-root">
            <h3 class="text-lg font-semibold dark:text-white">최신글</h3>
            <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($latestWrites as $write)
                    <li wire:key="{{ $write->id }}" class="py-2">
                        <div class="flex items-center space-x-1">
                            <div class="flex-1 min-w-0">
                                <a href="{{ route('write.read', ['tableId' => $write->table_id, 'writeId' => $write->id]) }}" wire:navigate class="block text-sm text-gray-900 truncate dark:text-white">
                                    {{ $write->subject }}
                                </a>
                            </div>
                            <div class="inline-flex items-center text-xs text-gray-900 dark:text-white">
                                {{ substr($write->created_at, 5, 11) }}
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="border border-gray-200 rounded-md shadow-sm dark:border-gray-700">
        <img class="h-auto" src="https://flowbite.com/docs/images/examples/image-1@2x.jpg" alt="image description">
    </div>
</div>

