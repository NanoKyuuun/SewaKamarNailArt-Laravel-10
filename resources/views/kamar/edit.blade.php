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
                                    <form action="/dashboard/kamar/{{ $kamar->id }}" class="space-y-4" method="POST">
                                        @method('put')
                                        @csrf
                                        <div>
                                            <label class="sr-only" for="name">Nama</label>
                                            <input class="w-full rounded-lg border-gray-200 p-3 text-sm"
                                                placeholder="Nama" type="text" id="name" name="name"
                                                value="{{ $kamar->name }}" />
                                        </div>
                                        <div>
                                            <label class="sr-only" for="tipe">Tipe</label>
                                            <input class="w-full rounded-lg border-gray-200 p-3 text-sm"
                                                placeholder="Tipe" type="text" id="tipe" name="tipe"
                                                value="{{ $kamar->tipe }}" />
                                        </div>
                                        <div>
                                            <label class="sr-only" for="jumlah">harga</label>
                                            <input class="w-full rounded-lg border-gray-200 p-3 text-sm"
                                                placeholder="Harga" type="text" id="jumlah" name="harga"
                                                value="{{ $kamar->harga }}" />
                                        </div>
                                        <div class="mt-4">
                                            <button type="submit"
                                                class="inline-block w-full rounded-lg bg-black px-5 py-3 font-medium text-white sm:w-auto">
                                                Update Enquiry
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
