@extends('layouts.admin')
@section('content')
    <div class="content">

        <div class="page-header">
            <div class="page-title">
                <h4 class="fw-bold">QR Code</h4>
                <h6>Staff Attendance QR Code</h6>
            </div>
            <ul class="table-top-head">
                <li>
                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh">
                        <i class="ti ti-refresh"></i>
                    </a>
                </li>
            </ul>
        </div>

        <div class="row justify-content-start">
            <div class="col-xl-5 col-lg-6 col-md-8">
                <div class="card border-0 shadow-sm">

                    {{-- Header --}}
                    {{-- <div class="card-header text-center py-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <h4 class="text-white mb-1 fw-bold">KodexAfrica</h4>
                    <p class="text-white mb-0 opacity-75 fs-13">Student Attendance QR Code</p>
                </div> --}}

                    <div class="card-body p-4">

                        {{-- How to use --}}
                        {{-- <div class="alert bg-light border border-purple d-flex gap-2 align-items-start mb-4"
                            style="border-color: #667eea !important;">
                            <i class="ti ti-info-circle fs-18 mt-1" style="color:#667eea;flex-shrink:0;"></i>
                            <div class="fs-13 text-muted">
                                <p class="mb-1"><strong>1.</strong> Scan this QR code with a smartphone camera</p>
                                <p class="mb-1"><strong>2.</strong> Fill in details on the first visit</p>
                                <p class="mb-0"><strong>3.</strong> On future visits, info auto-fills — just submit!</p>
                            </div>
                        </div> --}}

                        {{-- QR Code --}}
                        <div class="text-center p-4 mb-4 rounded-3 border"
                            style="border-color: #e0d7f5 !important; border-width: 3px !important; width: 100% !important;">
                            <div>
                                <canvas id="qrCanvas" class="" style="width: 100% !important;"></canvas>
                            </div>

                        </div>



                        {{-- Download Buttons --}}
                        <div class="row g-3">
                            <div class="col-6">
                                <button onclick="downloadPNG()" class="btn w-100 fw-semibold text-white py-3 bg-primary">
                                    <i class="ti ti-download me-1"></i> Download PNG
                                </button>
                            </div>
                            <div class="col-6">
                                <button onclick="downloadPDF()" class="btn w-100 fw-semibold text-white py-3  bg-primary">
                                    <i class="ti ti-file-type-pdf me-1"></i> Download PDF
                                </button>
                            </div>
                            <div class="col-12">
                                <button onclick="copyLink()" class="btn btn-outline-secondary w-100 fw-semibold py-3">
                                    <i class="ti ti-copy me-1"></i> Copy Attendance Link
                                </button>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
<style>
    #qrCanvas {
        width: 100% !important;
        height: auto !important;
    }
</style>

@push('scripts')
    {{-- QRious --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>
    {{-- jsPDF --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <script>
        const attendanceUrl = "{{ $attendanceUrl }}";

        // Generate QR on load
        const qr = new QRious({
            element: document.getElementById('qrCanvas'),
            value: attendanceUrl,
            size: 250,
            background: '#282629',
            foreground: '#ffffff',
            level: 'H',
        });

        function downloadPNG() {
            const canvas = document.getElementById('qrCanvas');
            const link = document.createElement('a');
            link.href = canvas.toDataURL('image/png');
            link.download = 'Kodex-Attendance-QR.png';
            link.click();

            iziToast.success({
                message: 'QR Code downloaded as PNG.',
                position: 'topRight',
                timeout: 3000,
                transitionIn: 'flipInX',
                transitionOut: 'flipOutX',
            });
        }

        async function downloadPDF() {
            const canvas = document.getElementById('qrCanvas');
            const {
                jsPDF
            } = window.jspdf;

            const pdf = new jsPDF({
                orientation: 'portrait',
                unit: 'mm',
                format: 'a4'
            });

            // Center the QR on the page
            const pageW = 210;
            const qrSize = 100; // mm
            const x = (pageW - qrSize) / 2;

            pdf.setFontSize(18);
            pdf.setTextColor(102, 126, 234);
            pdf.text('KodexAfrica', pageW / 2, 30, {
                align: 'center'
            });

            pdf.setFontSize(11);
            pdf.setTextColor(120, 120, 120);
            pdf.text('Staff Attendance QR Code', pageW / 2, 38, {
                align: 'center'
            });

            pdf.addImage(canvas.toDataURL('image/png'), 'PNG', x, 50, qrSize, qrSize);

            pdf.setFontSize(10);
            pdf.setTextColor(150, 150, 150);
            pdf.text('Scan to mark attendance', pageW / 2, 158, {
                align: 'center'
            });

            pdf.save('Kodex-Attendance-QR.pdf');

            iziToast.success({
                message: 'QR Code downloaded as PDF.',
                position: 'topRight',
                timeout: 3000,
                transitionIn: 'flipInX',
                transitionOut: 'flipOutX',
            });
        }

        function copyLink() {
            navigator.clipboard.writeText(attendanceUrl).then(() => {
                iziToast.info({
                    message: 'Attendance link copied to clipboard.',
                    position: 'topRight',
                    timeout: 3000,
                    transitionIn: 'flipInX',
                    transitionOut: 'flipOutX',
                });
            });
        }
    </script>
@endpush
