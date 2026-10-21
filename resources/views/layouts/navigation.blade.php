<header class="sticky top-0 z-30 flex items-center justify-between px-6 py-4 bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 shadow-sm">
    <div class="flex items-center">
        <button id="sidebarToggle" class="text-gray-500 focus:outline-none lg:hidden hover:text-violet-600 dark:text-gray-400">
            <i class="fa fa-bars text-xl"></i>
        </button>
        <div class="ml-4 lg:hidden">
            <span class="text-xl font-bold text-gray-800 dark:text-white">Vendor Portal</span>
        </div>
    </div>

    <div class="flex items-center space-x-4">
        <div class="relative">
            <button id="profileDropdownBtn" class="flex items-center focus:outline-none hover:text-violet-600 transition-colors">
                <span class="hidden font-medium text-gray-700 md:block dark:text-gray-200">{{ Auth::user()->name }}</span>
                <i class="ml-2 fa fa-chevron-down text-sm text-gray-500"></i>
            </button>

            <div id="profileDropdown" class="absolute right-0 hidden w-48 mt-2 overflow-hidden bg-white border border-gray-200 rounded-md shadow-lg dark:bg-gray-800 dark:border-gray-700">
                <div class="border-t border-gray-200 dark:border-gray-700"></div>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="block w-full px-4 py-2 text-sm text-left text-red-600 hover:bg-gray-100 dark:text-red-400 dark:hover:bg-gray-700">
                        <i class="fa fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
