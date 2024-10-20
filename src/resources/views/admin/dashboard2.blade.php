@push('style')
    @livewireStyles
@endpush

@push('scripts')
    @livewireScripts
@endpush

<x-layouts.panel>
    <div class="mt-12">
        <div class="mb-12 grid gap-y-10 gap-x-6 md:grid-cols-2 xl:grid-cols-4">
            <div class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 shadow-md">
                <div
                    class="bg-clip-border mx-4 rounded-xl overflow-hidden bg-gradient-to-tr from-blue-600 to-blue-400 text-white shadow-blue-500/40 shadow-lg absolute -mt-4 grid h-16 w-16 place-items-center">
                    <x-mdi-library-shelves class="w-6 h-6 text-white" />
                </div>
                <div class="p-4 text-right">
                    <p class="block antialiased font-sans text-sm leading-normal font-normal text-blue-gray-600">
                        Total Keseluruhan Buku</p>
                    <h4
                        class="block antialiased tracking-normal font-sans text-2xl font-semibold leading-snug text-blue-gray-900">
                        {{ $totalBuku }}</h4>
                </div>
                <div class="border-t border-blue-gray-50 p-4">
                    <p class="block antialiased font-sans text-base leading-relaxed font-normal text-blue-gray-600">
                        <strong class="text-green-500">+55%</strong>&nbsp;than last week
                    </p>
                </div>
            </div>
            <div class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 shadow-md">
                <div
                    class="bg-clip-border mx-4 rounded-xl overflow-hidden bg-gradient-to-tr from-pink-600 to-pink-400 text-white shadow-pink-500/40 shadow-lg absolute -mt-4 grid h-16 w-16 place-items-center">
                    <x-mdi-book-multiple class="w-6 h-6 text-white" />
                </div>
                <div class="p-4 text-right">
                    <p class="block antialiased font-sans text-sm leading-normal font-normal text-blue-gray-600">
                        Jumlah Kategori Buku</p>
                    <h4
                        class="block antialiased tracking-normal font-sans text-2xl font-semibold leading-snug text-blue-gray-900">
                        {{ $totalKategori }}</h4>
                </div>
                <div class="border-t border-blue-gray-50 p-4">
                    <p class="block antialiased font-sans text-base leading-relaxed font-normal text-blue-gray-600">
                        <strong class="text-green-500">+3%</strong>&nbsp;than last month
                    </p>
                </div>
            </div>
            <div class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 shadow-md">
                <div
                    class="bg-clip-border mx-4 rounded-xl overflow-hidden bg-gradient-to-tr from-green-600 to-green-400 text-white shadow-green-500/40 shadow-lg absolute -mt-4 grid h-16 w-16 place-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"
                        class="w-6 h-6 text-white">
                        <path
                            d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z">
                        </path>
                    </svg>
                </div>
                <div class="p-4 text-right">
                    <p class="block antialiased font-sans text-sm leading-normal font-normal text-blue-gray-600">
                        Jumlah Akun Pengguna</p>
                    <h4
                        class="block antialiased tracking-normal font-sans text-2xl font-semibold leading-snug text-blue-gray-900">
                        {{ $totalUsers }}</h4>
                </div>
                <div class="border-t border-blue-gray-50 p-4">
                    <p class="block antialiased font-sans text-base leading-relaxed font-normal text-blue-gray-600">
                        <strong class="text-red-500">-2%</strong>&nbsp;than yesterday
                    </p>
                </div>
            </div>
            <div class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 shadow-md">
                <div
                    class="bg-clip-border mx-4 rounded-xl overflow-hidden bg-gradient-to-tr from-orange-600 to-orange-400 text-white shadow-orange-500/40 shadow-lg absolute -mt-4 grid h-16 w-16 place-items-center">
                    <x-mdi-library class="w-6 h-6 text-white" />
                </div>
                <div class="p-4 text-right">
                    <p class="block antialiased font-sans text-sm leading-normal font-normal text-blue-gray-600">
                        Total Jumlah Peminjaman</p>
                    <h4
                        class="block antialiased tracking-normal font-sans text-2xl font-semibold leading-snug text-blue-gray-900">
                        {{ $totalJumlahPeminjaman }}</h4>
                </div>
                <div class="border-t border-blue-gray-50 p-4">
                    <p class="block antialiased font-sans text-base leading-relaxed font-normal text-blue-gray-600">
                        <strong class="text-green-500">+5%</strong>&nbsp;than yesterday
                    </p>
                </div>
            </div>
        </div>

        <div class="mb-4 w-full grid grid-cols-2 gap-4">
            <div class="">
                {!! $peminjamanChart->container() !!}
            </div>
            <div class="">

                <div id="pieChart"></div>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        var options = {
            title: {
                text: "Buku dengan Peminjaman Terbanyak",
                align: 'left',
                margin: 10,
                offsetX: 0,
                offsetY: 0,
                floating: false,
                style: {
                    fontSize: '14px',
                    fontWeight: 'bold',
                    fontFamily: undefined,
                    color: '#263238'
                },
            },
            subtitle: {
                text: "Total Buku",
                align: 'left',
                margin: 80,
                offsetX: 0,
                offsetY: 0,
                floating: false,
                style: {
                    fontSize: '12px',
                    fontWeight: 'normal',
                    fontFamily: undefined,
                    color: '#9699a2'
                },
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '65%'
                    }
                }
            },
            chart: {
                type: 'pie',
                toolbar: {
                    show: true,
                    offsetX: 0,
                    offsetY: 0,
                    tools: {
                        download: true,
                        selection: true,
                        zoom: true,
                        zoomin: true,
                        zoomout: true,
                        pan: true,
                        reset: true | '<img src="/static/icons/reset.png" width="20">',
                        customIcons: []
                    },
                    // export: {
                    //     csv: {
                    //         filename: undefined,
                    //         columnDelimiter: ',',
                    //         headerCategory: 'category',
                    //         headerValue: 'value',
                    //         categoryFormatter(x) {
                    //             return new Date(x).toDateString()
                    //         }
                    //         valueFormatter(y) {
                    //             return y
                    //         }
                    //     },
                    //     svg: {
                    //         filename: undefined,
                    //     },
                    //     png: {
                    //         filename: undefined,
                    //     }
                    // },
                    autoSelected: 'zoom'
                },
                zoom: {
                    enabled: true,
                    type: 'x',
                    autoScaleYaxis: false,
                    zoomedArea: {
                        fill: {
                            color: '#90CAF9',
                            opacity: 0.4
                        },
                        stroke: {
                            color: '#0D47A1',
                            opacity: 0.4,
                            width: 1
                        }
                    }
                }
            },
            series: @json($arrayOfBook),
            labels: @json($arrayTitle),
            xaxis: {
                categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998, 1999]
            }
        }

        var chart = new ApexCharts(document.getElementById("pieChart"), options);

        chart.render();
    </script>
    <script src="{{ $peminjamanChart->cdn() }}"></script>
    {{ $peminjamanChart->script() }}
</x-layouts.panel>
