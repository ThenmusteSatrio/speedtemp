<div class="min-h-screen bg-gray-50/50">
    <aside
        class="bg-gradient-to-br from-gray-800 to-gray-900 -translate-x-80 fixed inset-0 z-40 my-4 ml-4 h-[calc(100vh-32px)] w-72 rounded-xl transition-transform duration-300 xl:translate-x-0">
        <div class="relative border-b border-white/20">
            <a class="flex items-center gap-4 py-6 px-8" href="#/">
                <h6
                    class="block antialiased tracking-normal font-sans text-base font-semibold leading-relaxed text-white">
                    Perpustakaan Digital</h6>
            </a>
            <button
                class="middle none font-sans font-medium text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none w-8 max-w-[32px] h-8 max-h-[32px] rounded-lg text-xs text-white hover:bg-white/10 active:bg-white/30 absolute right-0 top-0 grid rounded-br-none rounded-tl-none xl:hidden"
                type="button">
                <span class="absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                        stroke="currentColor" aria-hidden="true" class="h-5 w-5 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </span>
            </button>
        </div>
        <div class="m-4">
            @if (Auth::guard('inspector')->user()->lvl == 'admin')
                <ul wire:ignore class="mb-4 flex flex-col gap-1">
                    <li>
                        <a aria-current="page" class="active" href="/admin/control/panel/dashboard">
                            <button
                                class="{{ request()->path() == 'admin/control/panel/dashboard' ? 'middle none font-sans font-bold center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 rounded-lg bg-gradient-to-tr from-blue-600 to-blue-400 text-white shadow-md shadow-blue-500/20 hover:shadow-lg hover:shadow-blue-500/40 active:opacity-[0.85] w-full flex items-center gap-4 px-4 capitalize' : 'middle none font-sans font-bold center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 rounded-lg text-white hover:bg-white/10 active:bg-white/30 w-full flex items-center gap-4 px-4 capitalize' }}"
                                type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    aria-hidden="true" class="w-5 h-5 text-inherit">
                                    <path
                                        d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z">
                                    </path>
                                    <path
                                        d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z">
                                    </path>
                                </svg>
                                <p
                                    class="block antialiased font-sans text-base leading-relaxed text-inherit font-medium capitalize">
                                    dashboard</p>
                            </button>
                        </a>
                    </li>

                    <li>
                        <a class="" href="/admin/control/panel/petugas">
                            <button
                                class="{{ request()->path() == 'admin/control/panel/petugas' ? 'middle none font-sans font-bold center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 rounded-lg bg-gradient-to-tr from-blue-600 to-blue-400 text-white shadow-md shadow-blue-500/20 hover:shadow-lg hover:shadow-blue-500/40 active:opacity-[0.85] w-full flex items-center gap-4 px-4 capitalize' : 'middle none font-sans font-bold center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 rounded-lg text-white hover:bg-white/10 active:bg-white/30 w-full flex items-center gap-4 px-4 capitalize' }}"
                                type="button">
                                <x-mdi-shield-account class="w-5 h-5 text-inherit" />
                                <p
                                    class="block antialiased font-sans text-base leading-relaxed text-inherit font-medium capitalize">
                                    Petugas</p>
                            </button>
                        </a>
                    </li>
                    <li>
                        <a class="" href="/admin/control/panel/cars">
                            <button
                                class="{{ request()->path() == 'admin/control/panel/cars' ? 'middle none font-sans font-bold center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 rounded-lg bg-gradient-to-tr from-blue-600 to-blue-400 text-white shadow-md shadow-blue-500/20 hover:shadow-lg hover:shadow-blue-500/40 active:opacity-[0.85] w-full flex items-center gap-4 px-4 capitalize' : 'middle none font-sans font-bold center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 rounded-lg text-white hover:bg-white/10 active:bg-white/30 w-full flex items-center gap-4 px-4 capitalize' }}"
                                type="button">
                                <x-mdi-car-multiple class="w-5 h-5 text-inherit" />
                                <p
                                    class="block antialiased font-sans text-base leading-relaxed text-inherit font-medium capitalize">
                                    Cars</p>
                            </button>
                        </a>
                    </li>
                </ul>
            @endif
            <ul class="mb-4 flex flex-col gap-1">
                <li class="mx-3.5 mt-4 mb-2">
                    <p
                        class="block antialiased font-sans text-sm leading-normal text-white font-black uppercase opacity-75">
                        auth pages</p>
                </li>
                <li>
                    <a class="" href="/logout">
                        <button
                            class="middle none font-sans font-bold center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 rounded-lg text-white hover:bg-white/10 active:bg-white/30 w-full flex items-center gap-4 px-4 capitalize"
                            type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                aria-hidden="true" class="w-5 h-5 text-inherit">
                                <path fill-rule="evenodd"
                                    d="M7.5 3.75A1.5 1.5 0 006 5.25v13.5a1.5 1.5 0 001.5 1.5h6a1.5 1.5 0 001.5-1.5V15a.75.75 0 011.5 0v3.75a3 3 0 01-3 3h-6a3 3 0 01-3-3V5.25a3 3 0 013-3h6a3 3 0 013 3V9A.75.75 0 0115 9V5.25a1.5 1.5 0 00-1.5-1.5h-6zm10.72 4.72a.75.75 0 011.06 0l3 3a.75.75 0 010 1.06l-3 3a.75.75 0 11-1.06-1.06l1.72-1.72H9a.75.75 0 010-1.5h10.94l-1.72-1.72a.75.75 0 010-1.06z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <p
                                class="block antialiased font-sans text-base leading-relaxed text-inherit font-medium capitalize">
                                Logout</p>
                        </button>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
    <div class="p-4 xl:ml-80 flex flex-col justify-between">
        <nav class="block w-full max-w-full bg-transparent text-white shadow-none rounded-xl transition-all px-0 py-1">
            <div class="flex flex-col-reverse justify-between gap-6 md:flex-row md:items-center">
                <div class="capitalize">
                    <nav aria-label="breadcrumb" class="w-max">
                        <ol
                            class="flex flex-wrap items-center w-full bg-opacity-60 rounded-md bg-transparent p-0 transition-all">
                            <li
                                class="flex items-center text-blue-gray-900 antialiased font-sans text-sm font-normal leading-normal cursor-pointer transition-colors duration-300 hover:text-light-blue-500">
                                <a href="#">
                                    <p
                                        class="block antialiased font-sans text-sm leading-normal text-blue-900 font-normal opacity-50 transition-all hover:text-blue-500 hover:opacity-100">
                                        Admin</p>
                                </a>
                                <span
                                    class="text-gray-500 text-sm antialiased font-sans font-normal leading-normal mx-2 pointer-events-none select-none">/</span>
                            </li>
                            <li
                                class="flex items-center text-blue-900 antialiased font-sans text-sm font-normal leading-normal cursor-pointer transition-colors duration-300 hover:text-blue-500">
                                <p
                                    class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-normal">
                                    {{ request()->path() == 'admin/control/panel/dashboard'
                                        ? 'dashboard'
                                        : (request()->path() == 'admin/petugas'
                                            ? 'Petugas'
                                            : 'Buku') }}
                                </p>
                            </li>
                        </ol>
                    </nav>
                    <h6
                        class="block antialiased tracking-normal font-sans text-base font-semibold leading-relaxed text-gray-900">
                        {{ request()->path() == 'admin/control/panel/dashboard'
                            ? 'dashboard'
                            : (request()->path() == 'admin/petugas'
                                ? 'Petugas'
                                : 'Buku') }}
                    </h6>
                </div>
            </div>
        </nav>
        {{ $slot }}

    </div>
</div>
