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
                                    <form action="/dashboard/pemesanan/{{ $pemesanan->id }}" class="space-y-4" method="POST">
                                        @method('put')
                                        @csrf
                                        <div>
                                            <div>
                                                <label for="HeadlineAct"
                                                    class="sr-only"> Pilih Kamar </label>

                                                <select name="kamar_id" id="HeadlineAct"
                                                    class="w-full rounded-lg border-gray-200 p-3 text-sm">
                                                    <option value="" selected>Pilih Kamar</option>
                                                    @foreach ($kamar as $data)
                                                        @if($data->id == $pemesanan->kamar_id)
                                                            <option value="{{ $data->id }}" selected>{{ $data->name }} dengan tipe {{ $data->tipe }}</option>
                                                        @else
                                                            <option value="{{ $data->id }}">{{ $data->name }} dengan tipe {{ $data->tipe }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div>
                                            <label class="sr-only" for="tanggal_pesan">Tanggal Pesan</label>
                                            <input class="w-full rounded-lg border-gray-200 p-3 text-sm"
                                                placeholder="Tanggal Pesan" type="date" id="tanggal_pesan" name="tangal_pesan"
                                                value="{{ $pemesanan->tangal_pesan }}" />
                                        </div>
                                        <div>
                                            <label class="sr-only" for="tanggal_masuk">Tanggal Masuk</label>
                                            <input class="w-full rounded-lg border-gray-200 p-3 text-sm"
                                                placeholder="Tanggal Masuk" type="date" id="tanggl_masuk" name="tanggl_masuk"
                                                value="{{ $pemesanan->tanggl_masuk }}" />
                                        </div>
                                        <div>
                                            <label class="sr-only" for="status_pembayaran">Status Pembayaran</label>
                                            <input class="w-full rounded-lg border-gray-200 p-3 text-sm"
                                                placeholder="Status Pembayaran" type="text" id="status_pembayaran" name="status_pembayaran"
                                                value="{{ $pemesanan->status_pembayaran }}" readonly/>
                                        </div>
                                        <div class="mt-4">
                                            <button type="submit"
                                                class="inline-block w-full rounded-lg bg-black px-5 py-3 font-medium text-white sm:w-auto">
                                                Update
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
