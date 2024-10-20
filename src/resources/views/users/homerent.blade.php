@push('style')
    @livewireStyles
@endpush

@push('scripts')
    @livewireScripts
    {{-- @vite('resources/js/app.js') --}}
    <script>
        let isImageLoaded = false;

        const borrowBook = (bukuId, lamaPeminjaman) => {
            Livewire.dispatch('borrowBook', {
                bukuId: bukuId,
                lamaPeminjaman: lamaPeminjaman
            });
            console.log("success")
        }
        const ratingBook = (bukuId, rating) => {
            Livewire.dispatch('rating', {
                bukuId: bukuId,
                rating: rating
            });
            console.log("success")
        }
        const renderPDF = (src) => {
            const iframe = document.getElementById('pdf');
            iframe.src = src;
            console.log(iframe);
        }
        const onFrameLoad = () => {
            console.log("onFrameLoad");
            document.getElementById('pdf').addEventListener('contextmenu', function(e) {
                e.preventDefault();
            });
        }
        const setIsImageLoaded = () => {
            isImageLoaded = false;
        }
        const imageLoaded = (id_buku) => {
            if (isImageLoaded == false) {
                getComment(id_buku);
                isImageLoaded = true;
            }
        }
        const getComment = async (bookId) => {
            const comment = await document.getElementById('comment');
            comment.innerHTML = '';
            const url = window.location.origin + '/comment/' + bookId;
            const res = await fetch(url, {
                method: 'GET',
            });

            const data = await res.json();
            console.log(data);
            data.data.map((item) => {
                let stars = '';
                for (let index = 0; index < item.Rating; index++) {
                    stars += `<x-mdi-star class="w-4 h-4 text-gray-700" />`;
                }
                comment.innerHTML += `<div class="text-sm pt-1 mb-2 flex flex-start items-center justify-between">
                            <p class="font-bold ml-2">
                                <a class="cursor-pointer">${item.user.username}:</a>
                                <span class="text-gray-700 font-medium ml-1">
                                    ${item.Ulasan}
                                </span>
                            </p>
                            <div class="flex pr-4">   
                                ${
                                stars
                                }
                            </div>
                        </div>`
            })
        }

        const koleksi = (bukuId) => {
            Livewire.dispatch('koleksi', {
                bukuId: bukuId
            })
        }

        const postUlasan = async (bookId, userId, username, rating) => {
            const url = `${window.location.origin}/comment/`;
            const commentSection = document.getElementById('comment');
            const comment = document.getElementById('commentInput').value;
            document.getElementById('commentInput').value = '';
            const res = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content")
                },
                body: JSON.stringify({
                    bukuId: bookId,
                    userId: userId,
                    ulasan: comment,
                    rating: rating
                })
            });
            if (res.ok) {
                commentSection.innerHTML += `<div class="text-sm pt-1 mb-2 flex flex-start items-center">
                            <p class="font-bold ml-2">
                                <a class="cursor-pointer">${username}:</a>
                                <span class="text-gray-700 font-medium ml-1">
                                    ${comment}
                                </span>
                            </p>
                        </div>`
            }
        }

        document.addEventListener('livewire:load', function() {
            Livewire.on('refreshPage', () => {
                location.reload();
            });
        });
    </script>
@endpush


<section class="w-full h-full bg-cover flex flex-col justify-between overflow-x-hidden min-h-screen"
    style="background-image: url('https://images.unsplash.com/photo-1635322966219-b75ed372eb01?q=80&w=2070&h=1080&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'); background-size: cover; background-position: center; background-attachment: fixed"
    x-data="{ openModal: false, book: {}, openTambahKategori: false, openModalRating: @entangle('openModalRating'), save: false, cartModal: false, isOpen: false, koleksi: false, comment: '' }">
    @if ($fileUrl != '')
        <div id="pdf">
            <object class="z-50 w-screen absolute h-screen" type="application/pdf"
                data="{{ Storage::url('public/' . $fileUrl) }}#zoom=85&scrollbar=0&toolbar=0&navpanes=0" id="pdf_content"
                style="pointer-events: none;">
                <p>Insert your error message here, if the PDF cannot be displayed.</p>
            </object>
        </div>
    @else
        <header class="">
            <div class="backdrop-blur-xl">
                <nav class="border-gray-200">
                    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                        <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
                            <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo" />
                            <span
                                class="self-center font-mono text-2xl font-semibold whitespace-nowrap text-gray-300 hover:text-gray-400">Flowbite</span>
                        </a>
                        <div class="flex md:order-2 z-50">
                            <button type="button" data-collapse-toggle="navbar-search" aria-controls="navbar-search"
                                aria-expanded="false"
                                class="md:hidden cursor-pointer text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5 me-1">
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                                <span class="sr-only">Search</span>
                            </button>
                            <div class="relative hidden md:block cursor-pointer">
                                <div wire:click="search"
                                    class="absolute inset-y-0 start-0 flex items-center ps-3 cursor-pointer">
                                    <div role="status" wire:loading>
                                        <svg aria-hidden="true"
                                            class="w-4 h-4 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                                            viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                fill="currentColor" />
                                            <path
                                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                fill="currentFill" />
                                        </svg>
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    <svg wire:loading.remove
                                        class="w-4 h-4 text-gray-500 dark:text-gray-400 cursor-pointer"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>
                                    <span class="sr-only">Search icon</span>
                                </div>
                                <input type="text" id="search-navbar" wire:model="inputSearch"
                                    wire:keydown.enter="search" {{-- wire:change="updatedSearch" --}}
                                    class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg  focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Search...">
                            </div>

                            <button data-collapse-toggle="navbar-search" type="button"
                                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                                aria-controls="navbar-search" aria-expanded="false">
                                <span class="sr-only">Open main menu</span>
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 17 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                                </svg>
                            </button>
                            <div class="absolute pt-1 right-10">
                                <a href="/logout" class="text-gray-200">Logout</a>
                            </div>
                        </div>
                        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1"
                            id="navbar-search">
                            <div class="relative mt-3 md:hidden">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>
                                </div>
                                {{-- <input type="text" id="search-navbar"
                                    class="w-full border rounded-md pl-10 pr-4 py-2 focus:border-blue-500 focus:outline-none focus:shadow-outline"
                                    placeholder="Search..."> --}}
                            </div>
                            <ul
                                class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 ">
                                <li wire:click="getBukuPinjaman" @click="koleksi = !koleksi">
                                    <p
                                        class="block font-mono cursor-pointer py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">
                                        Koleksi</p>
                                </li>
                                <li wire:click="getBukuPinjaman" @click="cartModal = !cartModal">
                                    <p
                                        class="block font-mono cursor-pointer py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">
                                        Dipinjam</p>
                                </li>
                            </ul>
                        </div>

                    </div>
                </nav>

                {{-- <div class="container mx-auto px-6 py-3 pb-10">
                    <div class="flex items-center justify-between">

                        <div class="w-full text-gray-500 hover:text-gray-400 text-xl font-semibold">
                            Perpustakaan Digital
                        </div>
                        <div class=" w-full space-x-3">
                            <button wire:click="getBukuPinjaman" @click="koleksi = !koleksi"
                                class="text-gray-500 hover:text-gray-400 focus:outline-none mx-4 sm:mx-0">
                                Koleksi
                            </button>
                            <button wire:click="getBukuPinjaman" @click="cartModal = !cartModal"
                                class="text-gray-500 hover:text-gray-400 focus:outline-none mx-4 sm:mx-0">
                                Dipinjam
                            </button>
                        </div>
                        <div>
                            <a href="/logout" class="text-gray-200">Logout</a>
                        </div>
                    </div>
                    <nav :class="isOpen ? '' : 'hidden'" class="sm:flex sm:justify-center sm:items-center mt-4">
                    </nav>
                    <div class="relative mt-6 max-w-lg mx-auto">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                            <svg class="h-5 w-5 text-gray-500" viewBox="0 0 24 24" fill="none">
                                <path
                                    d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </span>

                        <input
                            class="w-full border rounded-md pl-10 pr-4 py-2 focus:border-blue-500 focus:outline-none focus:shadow-outline"
                            type="text" placeholder="Search">
                    </div>
                </div> --}}
            </div>
        </header>
        <main class="mb-8">
            {{-- buku pinjaman --}}
            <div :class="cartModal ? 'translate-x-0 ease-out' : 'translate-x-full ease-in'"
                class="fixed z-50 right-0 top-0 max-w-xs w-full h-full px-6 py-4 transition duration-1000 transform overflow-y-auto backdrop-filter backdrop-blur-xl border-l-2 border-gray-300">
                <div class="flex items-center justify-between">
                    <h3 class="text-2xl font-medium text-gray-700">Buku Pinjaman</h3>
                    <button @click="cartModal = !cartModal" class="text-gray-600 focus:outline-none">
                        <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <hr class="my-3">
                @if ($bukupinjaman->count() > 0)
                    @foreach ($bukupinjaman as $item)
                        {{-- Card Pinjam --}}
                        @if ($item->buku)
                            <div
                                class="items-center mb-2 hover:bg-gray-100 cursor-pointer justify-center w-full rounded-xl group sm:flex shadow-xl space-x-6 bg-white bg-opacity-50  hover:rounded-2xl">
                                <img class="block w-20 h-20 rounded-lg" alt="art cover" loading="lazy"
                                    src='{{ Storage::url('public/' . $item->buku->thumbnail) }}' />
                                <div class="sm:w-8/12 pl-0">
                                    <div class="space-y-1">
                                        <div class="space-y-2">
                                            <h4 class="text-md font-semibold text-cyan-900 text-justify">
                                                {{ $item->buku->judul }}
                                            </h4>
                                        </div>

                                        <div class="flex items-center space-x-4 justify-between mb-2">
                                            <div class="flex flex-row space-x-1">
                                                <div x-on:click="openModal = true, book = {{ json_encode($item->buku) }}"
                                                    wire:click="updateValue('{{ $item->buku->thumbnail }}', '{{ $item->buku->id_buku }}')"
                                                    class="bg-blue-500 shadow-lg shadow- shadow-blue-600 text-white cursor-pointer px-2 py-0.5 text-center justify-center items-center rounded-xl flex space-x-2 flex-row">
                                                    <x-mdi-comment-text-outline class="text-white h-3 w-3 " />
                                                </div>
                                                <div wire:click="readingBook({{ $item->buku->id_buku }})"
                                                    class="bg-orange-500 text-xs shadow-lg shadow- shadow-orange-600 text-white cursor-pointer px-2 text-center justify-center items-center py-0.5 rounded-xl flex space-x-2 flex-row">
                                                    Read

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
            {{-- buku koleksi --}}
            <div :class="koleksi ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
                class="fixed left-0 top-0 max-w-xs w-full h-full px-6 py-4 transition duration-300 transform overflow-y-auto backdrop-filter backdrop-blur-xl border-l-2 border-gray-300">
                <div class="flex items-center justify-between">
                    <h3 class="text-2xl font-medium text-gray-700">Koleksi</h3>
                    <button @click="koleksi = !koleksi" class="text-gray-600 focus:outline-none">
                        <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <hr class="my-3">
                @if ($bukuKoleksi->count() > 0)
                    @foreach ($bukuKoleksi as $item)
                        {{-- Card Koleksi --}}
                        @if ($item->buku)
                            <div x-on:click="openModal = true, save = true, book = {{ json_encode($item->buku) }}"
                                wire:click="updateValue('{{ $item->buku->thumbnail }}', '{{ $item->buku->id_buku }}')"
                                class="items-center hover:bg-gray-100 cursor-pointer justify-center w-full rounded-xl group sm:flex shadow-xl space-x-6 bg-white bg-opacity-50  hover:rounded-2xl">
                                <img class="block w-20 h-20 rounded-lg" alt="art cover" loading="lazy"
                                    src='{{ Storage::url('public/' . $item->buku->thumbnail) }}' />
                                <div class="sm:w-8/12 pl-0">
                                    <div class="space-y-1">
                                        <div class="space-y-2">
                                            <h4 class="text-md font-semibold text-cyan-900 text-justify">
                                                {{ $item->buku->judul }}
                                            </h4>
                                        </div>

                                        <div class="flex items-center space-x-4 justify-between mb-2">
                                            <div class="flex flex-row space-x-1">
                                                <div x-on:click="openTambahKategori = true"
                                                    wire:click.prevent="updateValue('{{ $item->thumnail }}', '{{ $item->id_buku }}')"
                                                    class="bg-pink-500 shadow-lg shadow- shadow-pink-600 text-white cursor-pointer px-2 text-center justify-center items-center py-0.5 rounded-xl flex space-x-2 flex-row">
                                                    <p class="text-xs">Borrow</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
            {{-- modal request lama pinjam --}}
            <div x-show="openTambahKategori" data-dialog-backdrop="sign-in-modal" data-dialog-backdrop-close="true"
                class="absolute backdrop-blur-sm drop-shadow-md  z-50 left-0 right-0 z-10 overflow-y-scroll h-screen">
                <div data-dialog="sign-in-modal"
                    class="relative mx-auto w-full max-w-[24rem] rounded-lg overflow-hidden shadow-sm">
                    <div class="relative flex flex-col bg-white" x-data="{ lamaPeminjaman: '' }">
                        <div class="flex flex-col gap-4 p-6">
                            <div class="w-full max-w-sm min-w-[200px]">
                                <label class="block mb-2 text-sm text-slate-600">
                                    Lama Peminjaman ( Hari )
                                </label>
                                <input type="text" x-model="lamaPeminjaman"
                                    class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                                    placeholder="4 " />
                            </div>
                        </div>
                        <div class="p-6 pt-0" x-show="lamaPeminjaman != ''">
                            <button @click="borrowBook('{{ $id_buku }}', lamaPeminjaman)"
                                class="w-full rounded-md bg-slate-800 py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                type="button">
                                Borrow A Book
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div x-show="openModalRating" data-dialog-backdrop="sign-in-modal" data-dialog-backdrop-close="true"
                class="absolute top-0 drop-shadow-md min-w-full grid place-items-center z-50  min-h-screen">
                <div data-dialog="sign-in-modal"
                    class="relative mx-auto w-full max-w-[24rem] rounded-lg overflow-hidden shadow-sm">
                    <div class="relative flex flex-col bg-white" x-data="{ rating: 0 }">
                        <div class="flex flex-col gap-4 p-6">
                            <div class="absolute right-3 top-2">
                                <x-mdi-window-close class="h-5 w-5 cursor-pointer"
                                    x-on:click="openModalRating = false" />
                            </div>
                            <div class="w-full max-w-sm min-w-[200px]">
                                <label class="block mb-2 text-sm text-slate-600">
                                    Beri Rating
                                </label>
                                <input type="range" x-model.number="rating" min="1" max="5"
                                    step="1"
                                    class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                                    placeholder="4 " />
                                <div x-show="rating != 0" class="flex items-center">
                                    <template x-for="i in rating">
                                        <x-mdi-star class="w-7 h-7 text-gray-700" />
                                    </template>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <textarea id="commentInput" wire:model="comment" x-model="comment"
                                    class="w-full h-[5rem] border border-slate-200 px-2 py-2 resize-none outline-none appearance-none"
                                    aria-label="Agrega un comentario..." placeholder="Agrega un comentario..." autocomplete="off" autocorrect="off"></textarea>
                                {{-- <button
                                    onclick="postUlasan({{ $id_buku }}, {{ Auth::guard('')->user()->id }}, '{{ Auth::user()->username }}')"
                                    class="hover:mb-2 bg-blue-700 hover:bg-blue-600  h-[36px] text-white py-2 px-4 focus:outline-none border-none text-blue-600">Send</button> --}}
                            </div>
                        </div>
                        <div class="p-6 pt-0" x-show="rating != 0 && comment !=''">
                            <button
                                @click="postUlasan('{{ $id_buku }}', {{ Auth::guard('')->user()->id }}, '{{ Auth::user()->username }}', rating)"
                                x-on:click="openModalRating = false"
                                class="w-full rounded-md bg-slate-800 py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                type="button">
                                Kirim
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container mx-[7rem] px-6">
                <div class="mt-5 font-mono">
                    <h3 class="text-gray-300 hover:text-gray-400 text-2xl font-medium">More Book</h3>
                    <div class="my-4 w-full flex justify-start items-center space-x-3">
                        <button wire:click="getBukuByKategori"
                            class="px-5 py-2 rounded-3xl text-white font-semibold font-mono text-sm backdrop-brightness-125 bg-white/30 hover:bg-white/50">
                            <p class=" ">
                                All
                            </p>
                        </button>
                        @if ($kategori)
                            @foreach ($kategori as $item)
                                <button wire:click="getBukuByKategori({{ $item->KategoriId }})"
                                    class="px-5 py-2 rounded-3xl text-white font-semibold font-mono text-sm backdrop-brightness-125 bg-white/30 hover:bg-white/50">
                                    <p class=" ">
                                        {{ $item->NamaKategori }}
                                    </p>
                                </button>
                            @endforeach
                        @endif
                    </div>
                    {{-- <div class="absolute inset-x-0 top-0 z-10 p-4">
                        <button
                            class="p-2 rounded-full bg-blue-600 text-white -mb-4 hover:bg-orange-500 focus:outline-none focus:bg-blue-500">
                            <div x-on:click="openTambahKategori = true"
                                wire:click.prevent="updateValue('{{ $item->thumnail }}', '{{ $item->id_buku }}')">
                                <x-mdi-book-plus-multiple-outline class="w-5 h-5 text-white" />
                            </div>
                        </button>
                    </div> --}}
                    <div class="flex flex-wrap gap-8 mt-8" wire:loading.class="justify-center items-center">
                        <div role="status" wire:loading>
                            <svg aria-hidden="true"
                                class="w-10 h-10 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                            </svg>
                            <span class="sr-only">Loading...</span>
                        </div>
                        @foreach ($buku as $item)
                            <div wire:loading.class="hidden"
                                class="overflow-hidden rounded-2xl has-shadow relative w-[250px] h-[280px] hover:scale-105 transition duration-300">
                                <div>
                                    <img src="{{ Storage::url('public/' . $item->thumbnail) }}"
                                        class="w-[250px] h-[280px] object-cover" alt="" />
                                </div>
                                <div
                                    class="absolute inset-x-0 bottom-0 pb-5 z-20 p-4 text-white bg-gradient-to-t from-black flex justify-between items-center">
                                    <div class="w-[120px]">
                                        <h3 class="text-md font-semibold truncate">
                                            {{ $item->judul }}</h3>
                                        <div class="opacity-80">
                                            <p class="text-xs  ">
                                                {{ $item->penulis }}
                                            </p>
                                        </div>
                                    </div>
                                    <button x-on:click="openModal = true, book = {{ json_encode($item) }}"
                                        wire:click="updateValue('{{ $item->thumbnail }}', '{{ $item->id_buku }}')"
                                        class="p-2 rounded-full bg-orange-600 text-white -mb-4 hover:bg-blue-500 focus:outline-none focus:bg-orange-500">
                                        <div>
                                            <x-mdi-comment-text-outline class="w-5 h-5 text-white" />
                                        </div>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            {{-- <div class="container mx-auto px-6">
                <div class="mt-5">
                    <h3 class="text-gray-600 text-2xl font-medium">More Book</h3>
                    <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">
                        @foreach ($buku as $item)
                        
                            <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden">
                                <div class="flex items-end justify-end h-56 w-full bg-cover"
                                    style="background-image: url('{{ Storage::url('public/' . $item->thumbnail) }}')">
                                    <button
                                        class="p-2 rounded-full bg-blue-600 text-white mx-5 -mb-4 hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                                        <div x-on:click="openModal = true, book = {{ json_encode($item) }}"
                                            wire:click="updateValue('{{ $item->thumbnail }}', '{{ $item->id_buku }}')">
                                            <x-mdi-comment-text-outline class="w-5 h-5 text-white" />
                                        </div>
                                    </button>
                                </div>
                                <div class="flex items-center justify-between px-5">
                                    <div class="py-3">
                                        <h3 class="text-gray-700 uppercase">{{ $item->judul }}</h3>
                                        <span class="text-gray-500 mt-2">{{ $item->penulis }}</span>
                                    </div>
                                    <button x-on:click="openTambahKategori = true"
                                        wire:click.prevent="updateValue('{{ $item->thumnail }}', '{{ $item->id_buku }}')"
                                        class="ml-3 flex items-center px-3 py-2 text-gray-800 hover:text-white hover:bg-pink-600 border border-gray-300 text-sm uppercase font-medium rounded hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                                        <span>Borrow</span>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div> --}}
            <div wire:key="modal"
                class="fixed top-0 left-0 h-full mx-10  grid place-items-center bg-transparent overflow-hidden shadow-none z-30 drop-shadow-xl"
                x-show="openModal">
                <div class="grid grid-cols-3 w-full min-w-full bg-white rounded-lg ">

                    <div class="col-span-2 w-[100%] h-[35rem] flex items-center justify-center overflow-hidden">
                        <div class="w-[959px] h-[540px] flex items-center justify-center">
                            @if ($thumbnail != '')
                                <img onload="imageLoaded({{ $id_buku }})" class="w-full max-w-full min-w-full"
                                    src="{{ Storage::url('public/' . $thumbnail) }}" alt="Description"
                                    style="object-fit: cover">
                            @else
                                <svg class="w-10 h-10 text-gray-200 dark:text-gray-600" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                    <path
                                        d="M18 0H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm4.376 10.481A1 1 0 0 1 16 15H4a1 1 0 0 1-.895-1.447l3.5-7A1 1 0 0 1 7.468 6a.965.965 0 0 1 .9.5l2.775 4.757 1.546-1.887a1 1 0 0 1 1.618.1l2.541 4a1 1 0 0 1 .028 1.011Z" />
                                </svg>
                            @endif
                        </div>
                    </div>

                    <div class="col-span-1 relative pl-4">
                        <header class="border-b border-grey-400 flex justify-between items-center pr-5">
                            <div wire:click.prevent="checkIsAlreadyGiveRating({{ $id_buku }})"
                                {{-- @click="openModalRating = !openModalRating" --}}
                                class="block cursor-pointer py-4 flex items-center text-sm outline-none focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                <p
                                    class="text-blue-700 hover:text-blue-500 text-md font-semibold font-sans cursor-pointer">
                                    Berikan ulasan</p>
                            </div>
                            <x-mdi-close class="w-5 h-5 cursor-pointer" x-on:click="openModal = false, save = false"
                                wire:click="deleteJudul" />
                        </header>
                        <div id="comment" wire:ignore>


                        </div>

                        <div class="absolute bottom-0 left-0 right-0 pl-4">
                            <div class="pt-4">
                                <div class="flex items-center justify-between pr-4">
                                    <div class="mb-2" {{-- wire:click="koleksi({{ $id_buku }})" --}} onclick="koleksi({{ $id_buku }})"
                                        x-on:click="save = !save">
                                        <div class="flex items-center">
                                            <x-mdi-bookmark class="w-7 h-7 text-gray-700 cursor-pointer"
                                                x-show="save" />
                                            <x-mdi-bookmark-outline class="w-7 h-7 text-gray-700 cursor-pointer"
                                                x-show="!save" />
                                        </div>
                                        <span class="text-gray-600 text-sm font-bold">save</span>
                                    </div>
                                    <div class="mb-2">
                                        <div class="flex items-center">
                                            <x-mdi-star-half-full class="w-7 h-7 text-gray-700 cursor-pointer" />
                                        </div>
                                        <span class="text-gray-600 text-sm font-bold">3.5</span>
                                    </div>
                                </div>
                                <p x-text="book.judul"></p>
                                <span class="block text-xs text-gray-600" x-text="book.penulis"></span>
                            </div>

                            <div class="pt-4 pb-1 pr-3 ">
                                <button x-on:click="openTambahKategori = true"
                                    wire:click.prevent="updateValue('{{ $item->thumnail }}', '{{ $item->id_buku }}')"
                                    class="text-white bg-orange-600 hover:bg-orange-700 font-bold py-2 w-full rounded">
                                    Borrow A Book
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </main>

        <footer class="backdrop-blur-xl grid place-items-end">
            <div class="container mx-auto px-6 py-3 flex justify-between items-center">
                <a href="#" class="text-xl font-bold text-gray-500 hover:text-gray-400">Brand</a>
                <p class="py-2 text-gray-500 sm:py-0">All rights reserved</p>
            </div>
        </footer>

    @endif

</section>
