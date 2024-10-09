@props(['id' => null, 'maxWidth' => null])

<x-basic-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-6 py-4 bg-gray-100 dark:bg-gray-800">
        <div class="text-md font-medium text-gray-900 dark:text-white">
            {{ $title }}
        </div>

        <div class="mt-4 text-sm text-gray-600 dark:text-gray-400">
            {{ $content }}
        </div>
    </div>

    <div class="flex flex-row justify-end space-x-3 px-6 pb-6 bg-gray-100 dark:bg-gray-800 text-end">
        {{ $footer }}
    </div>
</x-basic-modal>
