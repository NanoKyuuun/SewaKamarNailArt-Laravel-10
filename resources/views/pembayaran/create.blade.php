<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <section class="bg-gray-100">
                        <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8">
                            <div>

                                <div class="rounded-lg bg-white p-8 shadow-lg lg:col-span-3 lg:p-12">
                                    <form action="/dashboard/pembayaran/{{ $pembayaran->id }}" class="space-y-4" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div>
                                            <label class="sr-only" for="name">Nama</label>
                                            <input class="w-full rounded-lg border-gray-200 p-3 text-sm"
                                                placeholder="Nama" type="text" id="name"
                                                value="{{ auth()->user()->name }}"  readonly/>
                                        </div>
                                        <div>
                                            <label class="sr-only" for="tipe">Id Pesanan</label>
                                            <input class="w-full rounded-lg border-gray-200 p-3 text-sm"
                                                placeholder="Tipe" type="text" id="tipe" name="pemesanan_id"
                                                value="{{ $pembayaran->id }}" readonly/>
                                        </div>
                                        <div>
                                            <label class="sr-only" for="tipe">Tanggal Pembayaran</label>
                                            <input class="w-full rounded-lg border-gray-200 p-3 text-sm"
                                                placeholder="Tanggal Pembayaran" type="date" id="tipe" name="tanggal_pembayaran"
                                                value="" />
                                        </div>
                                        <div>
                                            <label class="sr-only" for="tipe">bank</label>
                                            <select name="bank" id="" class="w-full rounded-lg border-gray-200 p-3 text-sm">
                                                <option value="bni">BNI - 123123</option>
                                                <option value="bri">BRI - 123123</option>
                                                <option value="mandiri">Mandiri - 123123</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label class="sr-only" for="tipe">No rekening</label>
                                            <input class="w-full rounded-lg border-gray-200 p-3 text-sm"
                                                placeholder="No rekening" type="text" id="tipe" name="no_rekening"
                                                value="" />
                                        </div>
                                        <div>
                                            <label class="sr-only" for="tipe">harga pembayaran</label>
                                            <input class="w-full rounded-lg border-gray-200 p-3 text-sm"
                                                placeholder="Tipe" type="text" id="tipe" name="harga_pembayaran"
                                                value="{{ $pembayaran->kamar->harga }}"  readonly/>
                                        </div>
                                        <div>
                                            <label class="" for="tipe">Bukti Pembayaran</label>
                                            <input class="w-full rounded-lg border-gray-200 p-3 text-sm"
                                                placeholder="Bukti Pembayaran" type="file" id="bukti_pembayaran" name="bukti_pembayaran"
                                                style="max-height: 200px" onchange="previewImage(event)"/>
                                                <img id="preview" src="#" alt="Preview" style="max-height: 200px; display: none"/>
                                                <script>
                                                    function previewImage(event) {
                                                        var reader = new FileReader();
                                                        reader.onload = function() {
                                                            var output = document.getElementById('preview');
                                                            output.style.display = 'block';
                                                            output.src = reader.result;
                                                        }
                                                        reader.readAsDataURL(event.target.files[0]);
                                                    }
                                                </script>
                                        </div>
                                        <div class="mt-4">
                                            <button type="submit"
                                                class="inline-block w-full rounded-lg bg-black px-5 py-3 font-medium text-white sm:w-auto">
                                                Send Enquiry
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
