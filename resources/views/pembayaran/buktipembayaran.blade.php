<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

<!--Container-->
<div class="container w-full mx-auto pt-20">

    <div class="w-full px-4 md:px-0 md:mt-8 mb-16 text-gray-800 leading-normal">
        <div class="mx-auto">
            <!--Title-->
            <div class="flex flex-col w-full mb-12">
                <div class="font-sans bg-blue-500 rounded-t-lg text-center text-white py-4">
                    <h1 class="font-bold uppercase">Bukti Pembayaran</h1>
                </div>
                <div class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 mb-4 flex flex-col my-2">
                    <!--Payment Info-->
                    <div class="-mx-3 md:flex mb-6">
                        <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="invoice">
                                Nomor Pemesanan
                            </label>
                            <p class="font-bold">{{ $pembayaran->id }}</p>
                        </div>
                        <div class="md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="date">
                                Tanggal Pembayaran
                            </label>
                            <p class="font-bold">{{ $pembayaran->pembayaran->tanggal_pembayaran }}</p>
                        </div>
                    </div>
                    <div class="-mx-3 md:flex mb-6">
                        <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="amount">
                                Jumlah Pembayaran
                            </label>
                            <p class="font-bold">Rp. {{ $pembayaran->pembayaran->harga_pembayaran }} ,-</p>
                        </div>
                        <div class="md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="method">
                                Nama Bank
                            </label>
                            <p class="font-bold">{{ $pembayaran->pembayaran->bank }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    window.print()
</script>
</body>
</html>
