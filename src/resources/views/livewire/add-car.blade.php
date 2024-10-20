<div class="" x-data="{ modalCar: @entangle('modalCar') }">
    <button wire:click.prevent="showTambahMobil" @click="modalCar = true"
        class="px-5 py-2 my-4 rounded-sm text-white font-bold transition text-sm bg-teal-500 relative z-10 duration-200 hover:bg-white hover:text-black border-2 border-transparent hover:border-teal-500">
        Tambah Mobil
    </button>
    <div x-show="modalCar" class="absolute bg-black opacity-80 inset-0 z-40"></div>
    <div class="absolute top-0 z-50 left-0 right-0 z-50 overflow-y-scroll shadow-lg h-screen" id="addBuku"
        x-show="modalCar">
        <x-mdi-window-close class="h-5 w-5 absolute top-5 right-5 cursor-pointer hover:text-red-500 z-50 text-white"
            x-on:click="modalCar = !modalCar" wire:click="clearData" />
        <div class="flex items-center justify-center p-12" x-data="{ open: false }">
            <div x-show="open"
                class="fixed h-full mx-10 w-full  grid place-items-center bg-transparent overflow-hidden shadow-none z-30 drop-shadow-xl h-full rounded-lg"
                x-show="openModal">
                <div role="status">
                    <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
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
            </div>
            <div wire:ignore.self class="mx-auto w-full max-w-[550px] bg-white">
                <form class="py-6 px-9" id="formtambahbuku"
                    @if ($updateCar) wire:submit.prevent="update({{ $nopol }})"
                @else
                wire:submit.prevent="store" @endif
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-5 flex justify-between w-full space-x-10">
                        <div>
                            <label for="nopol" class="mb-3 block text-base font-medium text-[#07074D]">
                                No. Pol
                            </label>
                            <input type="text" wire:model="nopol" name="nopol" id="nopol" placeholder="156xx"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                            @error('nopol')
                                <p class="text-red-500 font-mono text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="brand" class="mb-3 block text-base font-medium text-[#07074D]">
                                Brand
                            </label>
                            <input type="text" name="brand" wire:model="brand" id="brand" placeholder="BMW"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                            @error('brand')
                                <p class="text-red-500 font-mono text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-5 grid grid-cols-2 gap-10">
                        <div class="">
                            <label for="type" class="mb-3 block text-base font-medium text-[#07074D]">
                                Type
                            </label>
                            <input type="text" name="type" id="type" wire:model="type" placeholder="GT 630i"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                            @error('type')
                                <p class="text-red-500 font-mono text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="">
                            <label for="tahun" class="mb-3 block text-base font-medium text-[#07074D]">
                                Tahun
                            </label>
                            <input type="date" wire:model="tahun" name="tahun" id="tahun"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                            @error('tahun')
                                <p class="text-red-500 font-mono text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-5">
                        <label for="harga" class="mb-3 block text-base font-medium text-[#07074D]">
                            Harga
                        </label>
                        <input type="number" wire:model="harga" name="harga" id="harga" placeholder="2500000"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                        @error('harga')
                            <p class="text-red-500 font-mono text-xs">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="status" class="mb-3 block text-base font-medium text-[#07074D]">
                            Status
                        </label>
                        <select name="status" id="" wire:model.change="status"
                        wire:change="reloadCars"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                            <option value="">Please select option</option>
                            <option value="tidak tersedia" @if ($status == 'tidak tersedia') selected @endif>Tidak
                                Tersedia</option>
                            <option value="tersedia" @if ($status == 'tersedia') selected @endif>Tersedia</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 font-mono text-xs">{{ $message }}</p>
                        @enderror
                    </div>
                    <div wire:loading
                        class="px-3 py-1 mb-2 text-xs font-medium leading-none text-center text-blue-800 bg-blue-200 rounded-full animate-pulse dark:bg-blue-900 dark:text-blue-200">
                        loading...</div>

                    <div class="mb-6 pt-4">
                        <label class="mb-5 block text-xl font-semibold text-[#07074D]">
                            Upload Foto
                        </label>


                        <div class="mb-8">
                            <input type="file" wire:change="reloadCars" name="foto" wire:model="foto" id="foto" class="sr-only" />
                            <label for="foto"
                                class="relative cursor-pointer flex min-h-[200px] items-center justify-center rounded-md border border-dashed border-[#e0e0e0] p-12 text-center">
                                @if ($foto == null)
                                    <div wire.loadig.class="hidden">
                                        <span class="mb-2 block text-xl font-semibold text-[#07074D]">
                                            Drop files here
                                        </span>
                                        <span class="mb-2 block text-base font-medium text-[#6B7280]">
                                            Or
                                        </span>
                                        <span
                                            class="inline-flex rounded border border-[#e0e0e0] py-2 px-7 text-base font-medium text-[#07074D]">
                                            Browse
                                        </span>

                                    </div>
                                @elseif ($foto == $savedImage)
                                    <img src="{{ Storage::url($foto) }}" alt="" class="w-full">
                                @else
                                    <img src="{{ $foto->temporaryUrl() }}" alt="" class="w-full">
                                @endif

                            </label>
                        </div>
                    </div>


                    <div>
                        <button type="submit" @if ($foto == null) disabled @endif
                            class="hover:shadow-form w-full rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
