@extends('user.layouts.mainUser')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Baca Buku: {{ $peminjaman->buku->title }}</h1>

    <!-- Kontainer untuk menampilkan PDF -->
    <div id="pdf-container" style="width: 100%; height: 1000px; overflow-y: scroll; border: 1px solid #ccc;"></div>
    <a href="{{ route('pinjam.index') }}" class= "btn btn-secondary xl mt-3" >Kembali</a>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>

    <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.worker.min.js';

        // URL file PDF buku yang akan ditampilkan
        const pdfUrl = "{{ asset('storage/' . $peminjaman->buku->urlPDF) }}";

        // Memuat dokumen PDF
        const loadingTask = pdfjsLib.getDocument(pdfUrl);
        loadingTask.promise.then(function(pdf) {
            console.log('PDF berhasil dimuat. Total halaman: ' + pdf.numPages);

            // Render semua halaman PDF
            for (let pageNum = 1; pageNum <= pdf.numPages; pageNum++) {
                renderPage(pdf, pageNum);
            }
        });

        // Fungsi untuk merender setiap halaman ke div
        function renderPage(pdf, pageNum) {
    pdf.getPage(pageNum).then(function(page) {
        // Tentukan skala berdasarkan ukuran layar (contoh: untuk mobile)
        let scale = 1.5;
        if (window.innerWidth < 768) {
            scale = window.innerWidth / page.getViewport({ scale: 1 }).width;
        }

        const viewport = page.getViewport({ scale: scale });

        // Buat elemen div untuk setiap halaman
        const pageDiv = document.createElement('div');
        pageDiv.className = 'page';
        pageDiv.style.marginBottom = '20px';

        // Buat elemen canvas untuk menampilkan halaman PDF
        const canvas = document.createElement('canvas');
        const context = canvas.getContext('2d');
        canvas.height = viewport.height;
        canvas.width = viewport.width;

        // Tambahkan canvas ke div "pdf-container"
        pageDiv.appendChild(canvas);
        document.getElementById('pdf-container').appendChild(pageDiv);

        // Render halaman PDF ke canvas
        const renderContext = {
            canvasContext: context,
            viewport: viewport
        };
        page.render(renderContext);
    });
}
    </script>
</div>
@endsection
