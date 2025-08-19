<div x-data="{ show: false, message: '', type: 'success' }"
    x-on:notify.window="message = $event.detail.message; type = $event.detail.type; show = true; setTimeout(() => show = false, 2500)"
    x-show="show" x-transition class="z-50 fixed bottom-6 right-6 max-w-xs p-4 rounded shadow text-white"
    :class="{
        'bg-green-100 text-green-800 border border-green-300': type === 'success',
        'bg-red-100 text-red-800 border border-red-300': type === 'error',
        'bg-yellow-100 text-yellow-800 border border-yellow-300': type === 'warning',
        'bg-blue-100 text-blue-800 border border-blue-300': type === 'info',
        'bg-gray-100 text-gray-800 border border-gray-300': !['success', 'error', 'warning', 'info'].includes(type)
    }"
    style="display: none;">
    <span class="text-md"
        :class="{
            'text-green-800': type === 'success',
            'text-red-800': type === 'error',
            'text-yellow-800': type === 'warning',
            'text-blue-800': type === 'info',
            'text-gray-800': !['success', 'error', 'warning', 'info'].includes(type)
        }"
        x-text="message"></span>
</div>
<?php /**PATH /var/www/html/resources/views/livewire/notification-banner.blade.php ENDPATH**/ ?>