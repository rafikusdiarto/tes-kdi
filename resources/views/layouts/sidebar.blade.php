{{-- <ul class="sidebar-menu">
    @isset($dynamicMenus)
        @foreach ($dynamicMenus as $groupName => $menus)
            <!-- Header Grup Menu -->
            @if ($groupName)
                <li class="menu-header">{{ $groupName }}</li>
            @endif

            <!-- Daftar Menu di dalam Grup -->
            @foreach ($menus as $menu)
                <li class="nav-item">
                    <a href="{{ url($menu->urlmnu) }}" class="nav-link">
                        <i class="{{ $menu->icon_name }}"></i>
                        <span>{{ $menu->nmmnu }}</span>
                    </a>
                </li>
            @endforeach
        @endforeach
    @endisset
</ul> --}}

<div
    class="fixed bottom-0 z-10 h-screen ltr:border-r rtl:border-l vertical-menu rtl:right-0 ltr:left-0 top-[70px] bg-slate-50 border-gray-50 print:hidden dark:bg-zinc-800 dark:border-neutral-700">

    <div data-simplebar class="h-full">
        <!--- Sidemenu -->
        <div class="metismenu pb-10 pt-2.5" id="sidebar-menu">
            <!-- Left Menu Start -->
            {{-- <ul id="side-menu">
                <li class="px-5 py-3 text-xs font-medium text-gray-500 cursor-default leading-[18px] group-data-[sidebar-size=sm]:hidden block" data-key="t-menu">Menu</li>

                <li>
                    <a href="{{route('employee.index')}}" class="block py-2.5 px-6 text-sm font-medium text-gray-950 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                        <i data-feather="home" fill="#545a6d33"></i>
                        <span data-key="t-dashboard"> Dashboard</span>
                    </a>
                </li>



            </ul> --}}

            <ul class="side-menu">
                @isset($dynamicMenus)
                    @foreach ($dynamicMenus as $groupName => $menus)
                        <!-- Header Grup Menu -->
                        @if ($groupName)
                            <li
                                class="px-5 py-3 text-xs font-medium text-gray-500 cursor-default leading-[18px] group-data-[sidebar-size=sm]:hidden block">
                                {{ $groupName }}</li>
                        @endif

                        <!-- Daftar Menu di dalam Grup -->
                        @foreach ($menus as $menu)
                            <li>
                                <a href="{{ url($menu->urlmnu) }}"
                                    class="block py-2.5 px-6 text-sm font-medium text-gray-950 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                                    <i class="{{ $menu->icon_name }}"></i>
                                    <span>{{ $menu->nmmnu }}</span>
                                </a>
                            </li>
                        @endforeach
                    @endforeach
                @endisset
            </ul>


        </div>
        <!-- Sidebar -->
    </div>
</div>
