<div x-data="{ show: false, message: '', type: 'success' }"
    x-on:notify.window="message = $event.detail.message; type = $event.detail.type; show = true; setTimeout(() => show = false, 10000)"
    x-show="show" x-transition
    class="z-50 fixed bottom-6 right-6 removing:translate-x-5 removing:opacity-0 transition duration-300 ease-in-out"
    :class="{
        'bg-green-100 text-green-800 border border-green-300': type === 'success',
        'bg-red-100 text-red-800 border border-red-300': type === 'error',
        'bg-yellow-100 text-yellow-800 border border-yellow-300': type === 'warning',
        'bg-blue-100 text-blue-800 border border-blue-300': type === 'info',
        'bg-gray-100 text-gray-800 border border-gray-300': !['success', 'error', 'warning', 'info'].includes(type),
    }"
    style="display: none;" role="alert" id="dismiss-alert1">
    <div class="relative flex items-start max-w-xs py-4 px-2 rounded shadow">
        <span class="text-md mt-3"
            :class="{
                'text-green-800': type === 'success',
                'text-red-800': type === 'error',
                'text-yellow-800': type === 'warning',
                'text-blue-800': type === 'info',
                'text-gray-800': !['success', 'error', 'warning', 'info'].includes(type)
            }"
            x-text="message"></span>

        <button
            class="absolute top-1 right-1 btn btn-sm h-auto p-[0.50rem] bg-transparent border-none shadow-none rounded-full hover:bg-slate-400/20"
            data-remove-element="#dismiss-alert1" aria-label="Close Button">
            <span class="icon-[tabler--x] size-4 bg-slate-400"></span>
        </button>
    </div>
</div>
<?php /**PATH C:\laragon\www\practicasisus\resources\views/livewire/notification-banner.blade.php ENDPATH**/ ?>