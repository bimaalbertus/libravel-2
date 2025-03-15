@props([
    'url' => '',
])

@push('styles')
    <style>
        .no-spinner::-webkit-inner-spin-button,
        .no-spinner::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .no-spinner {
            -moz-appearance: textfield;
        }
    </style>
@endpush

<div x-data="pdfViewer('{{ $url }}')" class="relative p-6 rounded-lg shadow-md w-full max-w-4xl mx-auto">
    <!-- Kontainer PDF -->
    <div class="flex flex-col items-center justify-center">
        <canvas id="pdf-canvas" class="rounded-lg shadow max-h-[720px] max-w-[450px] lg:max-w-full"></canvas>

        <!-- Kontrol Navigasi -->
        <div class="flex items-center justify-between text-neutral-300 mt-4 w-full max-w-[450px] lg:max-w-full">
            <button @click="prevPage" class="p-2 rounded-md transition">
                &larr; Prev
            </button>
            <div class="flex items-center gap-2 text-sm">
                <span>Page</span>
                <button @click="prevPage" class="p-1 rounded-md transition">−</button>
                <input type="text" x-model="pageInput" @input.debounce.500ms="goToPage"
                    class="bg-transparent w-12 h-7 text-center rounded-md focus:ring focus:ring-blue-300" />
                <button @click="nextPage" class="p-2 rounded-md transition">+</button>
                <span>/</span>
                <span x-text="totalPages"></span>
            </div>
            <button @click="nextPage" class="p-2 rounded-md transition">
                Next &rarr;
            </button>
        </div>
    </div>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@2.3.200/build/pdf.min.js"></script>
    <script>
        function pdfViewer(url) {
            return {
                url: url,
                pdfDoc: null,
                pageNum: 1,
                totalPages: 0,
                scale: 1.2,
                pageInput: 1,

                async loadPdf() {
                    this.pdfDoc = await pdfjsLib.getDocument(this.url).promise;
                    this.totalPages = this.pdfDoc.numPages;
                    this.pageInput = this.pageNum;
                    this.renderPage();
                },

                async renderPage() {
                    let page = await this.pdfDoc.getPage(this.pageNum);
                    let viewport = page.getViewport({
                        scale: this.scale
                    });

                    let canvas = document.getElementById("pdf-canvas");
                    let ctx = canvas.getContext("2d");
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;

                    let renderContext = {
                        canvasContext: ctx,
                        viewport: viewport
                    };
                    page.render(renderContext);
                },

                nextPage() {
                    if (this.pageNum < this.totalPages) {
                        this.pageNum++;
                        this.pageInput = this.pageNum;
                        this.renderPage();
                    }
                },

                prevPage() {
                    if (this.pageNum > 1) {
                        this.pageNum--;
                        this.pageInput = this.pageNum;
                        this.renderPage();
                    }
                },

                goToPage() {
                    let page = parseInt(this.pageInput);
                    if (!isNaN(page) && page >= 1 && page <= this.totalPages) {
                        this.pageNum = page;
                        this.renderPage();
                    } else {
                        this.pageInput = this.pageNum; // Reset input jika invalid
                    }
                },

                init() {
                    this.loadPdf();
                }
            };
        }
    </script>
@endpush
