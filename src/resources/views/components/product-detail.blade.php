<div class="min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 flex justify-center items-center inset-0 z-40 outline-none focus:outline-none bg-no-repeat bg-center bg-cover"
    id="modal-id">
    <div class="absolute bg-black opacity-80 inset-0 z-0"></div>
    <div class="relative min-h-screen flex flex-col items-center justify-center " wire:ignore.self>
        <div class="grid place-items-center">
            <div class="flex flex-col">
                <div class="bg-white shadow-md  rounded-3xl p-4">
                    <div class="flex-none lg:flex">
                        <div class="flex items-center justify-center h-full w-full lg:h-48 lg:w-48   lg:mb-0 mb-3">
                            @if ($car['foto'])
                                <img wire:loading.remove src="{{ Storage::url($car['foto']) }}" alt="Just a flower"
                                    class=" w-full  object-scale-down lg:object-cover  lg:h-48 rounded-2xl">
                                <svg wire:loading class="w-10 h-10 text-gray-200 dark:text-gray-600" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                    <path
                                        d="M18 0H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm4.376 10.481A1 1 0 0 1 16 15H4a1 1 0 0 1-.895-1.447l3.5-7A1 1 0 0 1 7.468 6a.965.965 0 0 1 .9.5l2.775 4.757 1.546-1.887a1 1 0 0 1 1.618.1l2.541 4a1 1 0 0 1 .028 1.011Z" />
                                </svg>
                            @endif
                        </div>
                        <div class="flex-auto ml-3 justify-evenly py-2">
                            <div class="flex flex-wrap ">
                                <div class="w-full flex-none text-xs text-blue-700 font-medium ">
                                    Shop
                                </div>
                                <h2 wire:loading.remove class="flex-auto text-lg font-medium">{{ $car['brand'] }}</h2>
                                <div wire:loading class="h-4 mt-4 bg-gray-200 rounded-full w-48 mb-4"></div>
                            </div>
                            <p class="mt-3"></p>
                            <div class="flex py-4  text-sm text-gray-500">
                                <div class="flex-1 inline-flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-400"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <p class="">Cochin,KL</p>
                                </div>
                                <div class="flex-1 inline-flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-400"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <p class="">05-25-2021</p>
                                </div>
                            </div>
                            <div class="flex p-4 pb-2 border-t border-gray-200 "></div>
                            <div class="flex space-x-3 text-sm font-medium">
                                <div class="flex-auto flex space-x-3">
                                    <button
                                        class="mb-2 md:mb-0 bg-white px-4 py-2 shadow-sm tracking-wider border text-gray-600 rounded-full hover:bg-gray-100 inline-flex items-center space-x-2 ">
                                        <span class="text-green-400 hover:text-green-500 rounded-lg">
                                            <svg aria-hidden="true" focusable="false" data-prefix="fab"
                                                data-icon="shopify" class="svg-inline--fa fa-shopify  w-5 h-5  "
                                                role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                                <path fill="currentColor"
                                                    d="M388.32,104.1a4.66,4.66,0,0,0-4.4-4c-2,0-37.23-.8-37.23-.8s-21.61-20.82-29.62-28.83V503.2L442.76,472S388.72,106.5,388.32,104.1ZM288.65,70.47a116.67,116.67,0,0,0-7.21-17.61C271,32.85,255.42,22,237,22a15,15,0,0,0-4,.4c-.4-.8-1.2-1.2-1.6-2C223.4,11.63,213,7.63,200.58,8c-24,.8-48,18-67.25,48.83-13.61,21.62-24,48.84-26.82,70.06-27.62,8.4-46.83,14.41-47.23,14.81-14,4.4-14.41,4.8-16,18-1.2,10-38,291.82-38,291.82L307.86,504V65.67a41.66,41.66,0,0,0-4.4.4S297.86,67.67,288.65,70.47ZM233.41,87.69c-16,4.8-33.63,10.4-50.84,15.61,4.8-18.82,14.41-37.63,25.62-50,4.4-4.4,10.41-9.61,17.21-12.81C232.21,54.86,233.81,74.48,233.41,87.69ZM200.58,24.44A27.49,27.49,0,0,1,215,28c-6.4,3.2-12.81,8.41-18.81,14.41-15.21,16.42-26.82,42-31.62,66.45-14.42,4.41-28.83,8.81-42,12.81C131.33,83.28,163.75,25.24,200.58,24.44ZM154.15,244.61c1.6,25.61,69.25,31.22,73.25,91.66,2.8,47.64-25.22,80.06-65.65,82.47-48.83,3.2-75.65-25.62-75.65-25.62l10.4-44s26.82,20.42,48.44,18.82c14-.8,19.22-12.41,18.81-20.42-2-33.62-57.24-31.62-60.84-86.86-3.2-46.44,27.22-93.27,94.47-97.68,26-1.6,39.23,4.81,39.23,4.81L221.4,225.39s-17.21-8-37.63-6.4C154.15,221,153.75,239.8,154.15,244.61ZM249.42,82.88c0-12-1.6-29.22-7.21-43.63,18.42,3.6,27.22,24,31.23,36.43Q262.63,78.68,249.42,82.88Z">
                                                </path>
                                            </svg>
                                        </span>
                                        <span>62 Products</span>
                                    </button>
                                </div>
                                <button
                                    class="mb-2 md:mb-0 bg-gray-900 px-5 py-2 shadow-sm tracking-wider text-white rounded-full hover:bg-gray-800"
                                    type="button" aria-label="like">Edit Shop</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
