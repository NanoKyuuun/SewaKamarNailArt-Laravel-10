<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kamar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session()->has('success'))
                        <div class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-200" role="alert"
                            id="alert">
                            <div class="ms-3 text-sm font-medium">
                                {{ session('success') }}
                            </div>
                            <button type="button"
                                class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8"
                                onclick="closeAlert()" aria-label="Close">
                                <span class="sr-only">Close</span>
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                            </button>
                        </div>
                    @endif

                    <script>
                        function closeAlert() {
                            var alert = document.getElementById('alert');
                            alert.style.display = 'none';
                        }
                    </script>
                    <table class="w-full text-sm text-left rtl:text-right">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                            <tr>
                                <th scope="col" class="px-6 py-3">No</th>
                                <th scope="col" class="px-6 py-3">Pesanan Id</th>
                                <th scope="col" class="px-6 py-3">Tanggal Pembayaran</th>
                                <th scope="col" class="px-6 py-3">Bank</th>
                                <th scope="col" class="px-6 py-3">No rekening</th>
                                <th scope="col" class="px-6 py-3">Bukti Pembayaran</th>
                                <th scope="col" class="px-6 py-3">Harga Pembayaran</th>
                                <th scope="col" class="px-6 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pembayaran as $data)
                                @if ($data->pembayaran)
                                    <tr class="bg-white border-b ">
                                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                        <td class="px-6 py-4">{{ $data->id }}</td>
                                        <td class="px-6 py-4">{{ $data->pembayaran->tanggal_pembayaran }}</td>
                                        <td class="px-6 py-4">{{ $data->pembayaran->bank }}</td>
                                        <td class="px-6 py-4">{{ $data->pembayaran->no_rekening }}</td>
                                        <td class="px-6 py-4">
                                            <img src="{{ asset('storage/public/bukti_pembayaran/' . $data->pembayaran->bukti_pembayaran) }}"
                                                alt="Bukti Pembayaran" class="h-16 w-16 object-cover">
                                        </td>
                                        <td class="px-6 py-4">{{ $data->pembayaran->harga_pembayaran }}</td>
                                        <td class="px-6 py-4">
                                            <div class="flex">
                                                @if (auth()->user()->hasRole('admin'))
                                                    <a href="/dashboard/pembayaran/{{ $data->pembayaran->id }}/edit" class="mr-2">
                                                        <button type="submit"
                                                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-wides">Edit</button>
                                                    </a>

                                                    <!-- Tag <form> -->
                                                    <form action="/dashboard/pembayaran/{{ $data->pembayaran->id }}" method="POST">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit"
                                                            class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-wides">Delete</button>
                                                    </form>
                                                @endif
                                                <!-- Tag <a> -->
                                                    <a href="/dashboard/pembayaran/{{ $data->id }}/pdf" target="_blank" class="mr-2">
                                                        <button type="submit"
                                                            class="inline-flex items-center px-4 py-2 mx-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-wides">Download Bukti</button>
                                                    </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
