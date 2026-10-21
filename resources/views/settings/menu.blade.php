@extends('layouts.app')

@section('content')
<div class="page-content dark:bg-zinc-700">
    @if(session('success'))
    <div class="grid grid-cols-1 pb-6">
        <div class="relative flex items-center px-5 py-2 text-white bg-green-500 border border-green-200 rounded alert-dismissible">
            <p>{{ session('success') }}</p>
            <button class="text-lg text-white alert-close ltr:ml-auto rtl:mr-auto"><i class="mdi mdi-close"></i></button>
        </div>
    </div>
    @endif

    @if(session('error') || $errors->any())
    <div class="grid grid-cols-1 pb-6">
        <div class="relative flex items-center px-5 py-2 text-white bg-red-500 border border-red-200 rounded alert-dismissible">
            <p>{{ session('error') }}</p>
            @if($errors->any())
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <button class="text-lg text-white alert-close ltr:ml-auto rtl:mr-auto"><i class="mdi mdi-close"></i></button>
        </div>
    </div>
    @endif


    <div class="container-fluid px-[0.625rem]">

        <div class="grid grid-cols-1 pb-6">
            <div class="md:flex items-center justify-between px-[2px]">
                <h4 class="text-[18px] font-medium text-gray-800 mb-sm-0 grow dark:text-gray-100 mb-2 md:mb-0">Menus</h4>
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 ltr:md:space-x-3 rtl:md:space-x-0">
                        <li class="inline-flex items-center">
                            <a href="#" class="inline-flex items-center text-sm text-gray-800 hover:text-gray-900 dark:text-zinc-100 dark:hover:text-white">
                                Settings
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center rtl:mr-2">
                               <i class="font-semibold text-gray-600 align-middle far fa-angle-right text-13 rtl:rotate-180 dark:text-zinc-100"></i>
                                <a href="#" class="text-sm font-medium text-gray-500 ltr:ml-2 rtl:mr-2 hover:text-gray-900 ltr:md:ml-2 rtl:md:mr-2 dark:text-gray-100 dark:hover:text-white">Menu</a>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12">
                <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                    <div class="card-body border-b border-gray-100 dark:border-zinc-600 flex justify-between align-items-center">
                        <button id="addData" class="text-white btn bg-violet-500 border-violet-500 hover:bg-violet-600 hover:border-violet-600 focus:bg-violet-600 focus:border-violet-600 focus:ring focus:ring-violet-500/30 active:bg-violet-600 active:border-violet-600">
                            Add Data
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="relative overflow-x-auto w-full">
                            <table class="text-sm text-left text-gray-500 w-full">
                                <thead class="text-sm text-gray-700 dark:text-gray-100">
                                    <tr>
                                        <th scope="col" class="py-2">
                                            Name
                                        </th>
                                        <th scope="col" class="py-2">
                                            URL
                                        </th>
                                        <th scope="col" class="py-2">
                                            Sort
                                        </th>
                                        <th scope="col" class="py-2">
                                            Group
                                        </th>
                                        <th scope="col" class="py-2 text-center">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($menu as $item)
                                        <tr class="border-b border-gray-100 dark:border-zinc-600">
                                            <td class="py-2">{{ $item->nmmnu }}</td>
                                            <td class="py-2">{{ $item->urlmnu }}</td>
                                            <td class="py-2">{{ $item->ordmnu }}</td>
                                            <td class="py-2">{{ $item->grpmnu }}</td>
                                            <td class="py-2 text-center">
                                                <form action="{{ route('settings.menu.destroy', $item->idmnu) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this menu?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-white btn bg-red-500 border-red-500 hover:bg-red-600 hover:border-red-600 focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-500/30 active:bg-red-600 active:border-red-600">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- Footer Start -->
        <footer class="absolute bottom-0 left-0 right-0 px-5 py-5 bg-white border-t footer border-gray-50 dark:bg-zinc-700 dark:border-zinc-600 dark:text-gray-200">
            <div class="grid grid-cols-2 text-gray-500 dark:text-zinc-100">
                <div class="grow">
                    &copy;
                    <script>
                        document.write(new Date().getFullYear());
                    </script>
                </div>
            </div>
        </footer>
        <!-- end Footer -->

        <div class="relative z-50 hidden modal" id="modalAdd" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="fixed inset-0 z-50 overflow-y-auto">
                <div class="absolute inset-0 transition-opacity bg-black bg-opacity-50 modal-overlay"></div>
                <div class="p-4 mx-auto animate-translate sm:max-w-lg">
                    <div class="relative overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl dark:bg-zinc-600">
                        <div class="bg-white dark:bg-zinc-700">
                            <button type="button" class="absolute top-3 right-2.5 text-gray-400 border-transparent hover:bg-gray-50/50 hover:text-gray-900 dark:text-gray-100 rounded-lg text-sm px-2 py-1 ltr:ml-auto rtl:mr-auto inline-flex items-center dark:hover:bg-zinc-600" data-tw-dismiss="modal">
                                <i class="text-xl text-gray-500 mdi mdi-close dark:text-zinc-100/60"></i>
                            </button>
                            <div class="p-5">
                                <h3 class="mb-4 text-xl font-medium text-gray-700 dark:text-gray-100">Add Menu</h3>
                                <form class="space-y-4" action="{{ route('settings.menu.store') }}" method="POST">
                                    @csrf
                                    <div>
                                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">Name</label>
                                        <input type="text" name="nmmnu" id="nmmnu" class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100" placeholder="Enter menu name" required>
                                    </div>
                                    <div>
                                        <label for="url" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">URL</label>
                                        <input type="text" name="urlmnu" id="urlmnu" placeholder="Enter URL" class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100" required>
                                    </div>
                                    <div>
                                        <label for="sort" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">Sort Order</label>
                                        <input type="number" name="ordmnu" id="ordmnu" placeholder="Enter sort order" class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100" required>
                                    </div>
                                    {{-- <div>
                                        <label for="group" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">Select2</label>
                                        <select name="grpmnu" multiple id="grpmnu" class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
                                            <option value="">Select Group</option>
                                            <option value="1">Large select</option>
                                            <option value="2">Small select</option>
                                        </select>
                                    </div> --}}

                                    <div>
                                        <label class="block mb-2 font-medium text-gray-700 dark:text-zinc-100">Group Menu</label>
                                        <select name="grpmnu" class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
                                            <option value="">Select Group</option>
                                            @foreach ($group_menu as $item)
                                                <option value="{{ $item->valprm }}">{{ $item->dscprm }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mt-6">
                                        <button type="submit" class="w-full text-white bg-green-600 border-transparent btn">Save Menu</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('#grpmnu').select2({
            placeholder: "Select Group Menu",
            width: '100%',
        });

        $("#addData").click(function() {
            $("#modalAdd").removeClass("hidden");
        });


    });
</script>
@endsection
