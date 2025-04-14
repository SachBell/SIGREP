<div class="w-full flex justify-end items-center py-3 md:py-0">
    @unless ($breadcrumbs->isEmpty())
        <nav class="container mx-auto">
            <ol class="p-4 rounded flex flex-wrap text-lg text-gray-800">
                @foreach ($breadcrumbs as $breadcrumb)
                    @if ($breadcrumb->url && !$loop->last)
                        <li>
                            <a href="{{ $breadcrumb->url }}"
                                class="text-blue-600 hover:text-blue-900 hover:underline focus:text-blue-900 focus:underline">
                                {{ $breadcrumb->title }}
                            </a>
                        </li>
                    @else
                        <li class="text-gray-800">
                            {{ $breadcrumb->title }}
                        </li>
                    @endif

                    @unless ($loop->last)
                        <li class="text-gray-500 px-2">
                            /
                        </li>
                    @endif
                    @endforeach
                </ol>
            </nav>
    @endunless
    <button type="button" class="btn btn-lg btn-text max-md:btn-square md:hidden" aria-haspopup="dialog"
        aria-expanded="false" aria-controls="multilevel-with-separator" data-overlay="#multilevel-with-separator">
        <span class="icon-[tabler--menu-2] size-7 text-gray-800"></span>
    </button>
</div>
