@push('style')
    @livewireStyles
@endpush

@push('scripts')
    @livewireScripts
    <script src="https://cdn.datatables.net/v/dt/jq-3.7.0/dt-2.1.8/datatables.min.js"></script>
    <script>
        let table = $('#table').DataTable();

        Livewire.on('reload', function() {
            $(document).ready(function() {
                table = $('#table').DataTable()
            });
        })
        Livewire.on('update', function() {
            Livewire.dispatch('getAllCars', {})
        })

        function deleteItem(nopol) {
            Livewire.dispatch("delete", {
                nopol: nopol
            });
            Livewire.dispatch('getAllCars', {})
        }

        function getUpdateData(nopol) {
            Livewire.dispatch('getUpdateData', {
                nopol: nopol
            })
        }
    </script>
@endpush

<x-panel>
    <div class="w-full h-full" >
        <div class="flex items-center space-x-4">
            @include('livewire.add-car')
        </div>
        @if (session('error'))
            <div class="text-red-500">
                {{ session('error') }}
            </div>
        @endif
        <div class="drop-shadow overflow-x-scroll bg-white rounded-lg w-full px-10 py-5">
            <table id="table" class="display bg-white">
                <thead>
                    <tr>
                        <th>No. Pol</th>
                        <th>Brand</th>
                        <th>Type</th>
                        <th>Tahun</th>
                        <th>Harga</th>
                        <th>Foto</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody wire:loading.remove >
                    @foreach ($cars as $car)
                        <tr>
                            <td>{{ $car->nopol }}</td>
                            <td>{{ $car->brand }}</td>
                            <td>{{ $car->type }}</td>
                            <td>{{ $car->tahun }}</td>
                            <td>{{ $car->harga }}</td>
                            <td>
                                <img src="{{ Storage::url($car->foto) }}" alt="" class="w-[5rem] h-auto">
                            </td>
                            <td>{{ $car->status }}</td>
                            <td class="">
                                <div class="flex items-center space-x-2">
                                    <button onclick="deleteItem({{ $car->nopol }})"
                                        class="px-4 py-2 text-sm border-transparent  hover:border-red-500 bg-red-500 text-white font-bold rounded-sm transition hover:bg-white border-2 border-transparent hover:border-red-500">
                                        <x-mdi-trash-can-outline class="w-5 h-5 text-white hover:text-red-500 " />
                                    </button>
                                    <button onclick="getUpdateData({{ $car->nopol }})"
                                        class="px-4 py-2 text-sm border-transparent  hover:border-blue-500 bg-blue-500 text-white font-bold rounded-sm transition hover:bg-white border-2 border-transparent hover:border-blue-500">
                                        <x-mdi-pencil class="w-5 h-5 text-white hover:text-blue-500 " />
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-panel>
