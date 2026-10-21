<aside id="sidebar" class="absolute inset-y-0 left-0 z-40 w-64 px-4 py-4 transition-transform duration-300 ease-in-out transform -translate-x-full bg-white border-r border-gray-200 lg:static lg:translate-x-0 lg:flex-shrink-0 dark:bg-gray-800 dark:border-gray-700">

    <div class="flex items-center justify-center mb-8 h-12">
        <span class="text-2xl font-bold text-violet-600 dark:text-violet-400 tracking-wide">Vendor Portal</span>
    </div>

    <nav class="space-y-2 overflow-y-auto h-[calc(100vh-100px)]">
        @isset($dynamicMenus)
            @foreach ($dynamicMenus as $groupName => $menus)

                @if ($groupName)
                    <h3 class="px-3 pt-5 pb-2 text-xs font-bold text-gray-400 uppercase tracking-wider dark:text-gray-500">
                        {{ $groupName }}
                    </h3>
                @endif

                <ul class="space-y-1">
                    @foreach ($menus as $menu)
                        <li>
                            <a href="{{ url($menu->urlmnu) }}" class="flex items-center px-3 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-violet-50 hover:text-violet-600 transition-colors dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white">
                                <div class="w-6 text-center mr-2">
                                    <i class="{{ $menu->icon_name }} text-lg"></i>
                                </div>
                                <span>{{ $menu->nmmnu }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>

            @endforeach
        @endisset
    </nav>
</aside>
