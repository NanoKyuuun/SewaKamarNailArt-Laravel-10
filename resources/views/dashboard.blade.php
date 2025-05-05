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
                            <div class="grid grid-cols-1 gap-x-16 gap-y-8 lg:grid-cols-5">
                                <div class="lg:col-span-2 lg:py-12">
                                    <p class="max-w-xl text-lg">
                                        At the same time, the fact that we are wholly owned and totally independent from
                                        manufacturer and other group control gives you confidence that we will only
                                        recommend what
                                        is right for you.
                                    </p>

                                    <div class="mt-8">
                                        <a href="#" class="text-2xl font-bold text-pink-600"> 0151 475 4450 </a>

                                        <address class="mt-2 not-italic">282 Kevin Brook, Imogeneborough, CA 58517
                                        </address>
                                    </div>
                                </div>

                                <div class="rounded-lg bg-white p-8 shadow-lg lg:col-span-3 lg:p-12">
                                    <form action="/dashboard/pemesanan" class="space-y-4" method="POST">
                                        @csrf
                                        <div>
                                            <div>
                                                <label for="HeadlineAct"
                                                    class=""> Pilih Kamar </label>

                                                <select name="kamar_id" id="HeadlineAct"
                                                    class="w-full rounded-lg border-gray-200 p-3 text-sm">
                                                    <option value="" selected>Please select Kamar</option>
                                                    @foreach ($kamar as $data)
                                                        <option value="{{ $data->id }}">{{ $data->name }}dengan tipe {{ $data->tipe }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div>
                                            <label class="" for="tanggal_pesan">Tanggal Pesan</label>
                                            <input class="w-full rounded-lg border-gray-200 p-3 text-sm"
                                                placeholder="Tanggal Pesan" type="date" id="tanggal_pesan" name="tangal_pesan"
                                                value="" />
                                        </div>
                                        <div>
                                            <label class="" for="tanggal_masuk">Tanggal Masuk</label>
                                            <input class="w-full rounded-lg border-gray-200 p-3 text-sm"
                                                placeholder="Tanggal Masuk" type="date" id="tanggl_masuk" name="tanggl_masuk"
                                                value="" />
                                        </div>
                                        <div>
                                            <label class="" for="status_pembayaran">Status Pembayaran</label>
                                            <input class="w-full rounded-lg border-gray-200 p-3 text-sm"
                                                placeholder="Status Pembayaran" type="text" id="status_pembayaran" name="status_pembayaran"
                                                value="panding" readonly/>
                                        </div>
                                        <div class="mt-4">
                                            <button type="submit"
                                                class="inline-block w-full rounded-lg bg-black px-5 py-3 font-medium text-white sm:w-auto">
                                                Pesan
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
