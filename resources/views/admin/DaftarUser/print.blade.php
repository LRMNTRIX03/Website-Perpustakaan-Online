@extends('admin.layouts.mainAdmin')

@section('content')
<div class="container d-flex justify-content-center mt-5" id="printableArea">
    <div class="card" style="width: 550px; border: 1px solid black; padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); background-color: #1591ea;">
        <div class="d-flex justify-content-between">
            <div class="p-2">
                <img src="{{ asset('img/logoPerpus.png') }}" alt="Logo" style="width: 100px; height: auto;">
            </div>
            <div class="text-center">
                <h4 style="color: white; font-weight: bold;">KARTU ANGGOTA</h4>
                <h5 style="color: white;">PERPUSTAKAAN</h5>
                <h6 style="color: white;">SMA ARIF RAHMAN HAKIM</h6>
            </div>
            <div class="p-2">
                {{-- <img src="{{ asset('/storage/kartu.png') }}" alt="Logo 2" style="width: 100px; height: auto;"> --}}
            </div>
        </div>

        <!-- Informasi Anggota -->
        <div class="row mt-3">
            <div class="col-4 text-center">
                <img src="{{ asset('storage/' . $user->fotoUrl) }}" alt="Foto {{ $user->name }}" class="img-fluid" style="width: 200px; height: auto; border: 2px solid white;">
            </div>
            <div class="col-8 text-left text-white">
                <p><strong>No. Anggota: </strong>1234567890</p>
                <p><strong>Nama: </strong>{{ $user->name }}</p>
                <p><strong>Username: </strong>{{ $user->username }}</p>
                <p><strong>Email: </strong>{{ $user->email }}</p>
                <p><strong>Tempat, Tanggal Lahir: </strong>{{ $user->TTL ?? '-' }}</p>
                <p><strong>Alamat: </strong>{{ $user->alamat ?? '-' }}</p>
            </div>
        </div>

        <!-- Bagian Stempel dan Tanda Tangan -->
        <div class="d-flex justify-content-between mt-4">
            <div>
                <p style="color: white;">
                    {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}
                </p>                
                <p style="color: white;">Kepala Sekolah</p>
                <p style="color: white;">(Tanda Tangan)</p>
            </div>
            <div class="text-center">
                {{-- <img src="{{ asset('/path/to/stamp.png') }}" alt="Stempel" style="width: 80px; height: auto;"> --}}
            </div>
        </div>
    </div>
</div>

<!-- Tombol Print dan Kembali -->
<div class="container text-center mt-4 no-print">
    <button onclick="window.print();" class="btn btn-primary">Print Kartu</button>
    <a href="{{ route('anggota.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
</div>

<!-- Print Script -->
<script type="text/javascript">
    // Fungsi untuk memprint kartu anggota
    window.onload = function() {
        const printButton = document.querySelector('.btn-primary');
        printButton.addEventListener('click', () => {
            window.print();
        });
    };
</script>

<!-- CSS Print -->
<style>
    @media print {
        body * {
            visibility: hidden;
        }
        #printableArea, #printableArea * {
            visibility: visible;
        }
        #printableArea {
            position: absolute;
            left: 0;
            top: 0;
            background-color: #1591ea !important; /* Pastikan background tercetak */
            -webkit-print-color-adjust: exact; /* Cetak warna background */
        }

        /* Hilangkan border */
        #printableArea .card {
            border: none !important;
            box-shadow: none !important;
        }

        .no-print {
            display: none;
        }
    }
</style>
@endsection
