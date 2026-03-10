<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kodex Attendance QR Code Generator</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
           background: #f0ebf8;
        }

        .qr-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
        }

        .qr-canvas {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }

        .download-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
        }

        .download-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.4);
        }

        .download-btn:active {
            transform: translateY(0);
        }

        .fade-in {
            animation: fadeIn 0.6s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .pulse-animation {
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }

        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 sm:p-6">
    <div class="w-full max-w-2xl">
        <!-- Main Container -->
        <div class="qr-container overflow-hidden fade-in">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-purple-600 to-indigo-600 px-6 sm:px-10 py-8 sm:py-10 text-center">

                <h1 class="text-3xl sm:text-4xl font-bold text-white mb-3">KodexAfrica</h1>
                <p class="text-purple-100 text-base sm:text-lg">Student Attendance QR Code</p>
            </div>

            <!-- QR Code Section -->
            <div class="px-6 sm:px-10 py-8 sm:py-10">
                <!-- Instructions -->
                <div class="bg-gradient-to-r from-purple-50 to-indigo-50 rounded-xl p-6 mb-8 border border-purple-100">
                    <h2 class="text-lg font-semibold gradient-text mb-3 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                        </svg>
                        How to Use
                    </h2>
                    <ul class="space-y-2 text-sm text-gray-700">
                        <li class="flex items-start">
                            <span class="font-semibold text-purple-600 mr-2">1.</span>
                            <span>Scan this QR code with your smartphone camera</span>
                        </li>
                        <li class="flex items-start">
                            <span class="font-semibold text-purple-600 mr-2">2.</span>
                            <span>Fill in your details on the first visit</span>
                        </li>
                        <li class="flex items-start">
                            <span class="font-semibold text-purple-600 mr-2">3.</span>
                            <span>On future visits, your info will auto-fill - just submit!</span>
                        </li>
                    </ul>
                </div>

                <!-- QR Code Display -->
                <div id="qrWrapper" class="bg-white rounded-2xl p-8 sm:p-10 text-center shadow-lg border-4 border-purple-100">
                    <div id="qrcode" class="flex justify-center mb-6"></div>
                    <p class="text-sm text-gray-500 font-medium">Scan to mark attendance</p>
                </div>



                <!-- Download Buttons -->
                <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <button
                        onclick="downloadQRImage()"
                        class="download-btn py-4 px-6 text-white font-semibold rounded-xl shadow-lg flex items-center justify-center gap-3"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Download PNG
                    </button>

                    <button
                        onclick="downloadAsPDF()"
                        class="download-btn py-4 px-6 text-white font-semibold rounded-xl shadow-lg flex items-center justify-center gap-3"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                        Download PDF
                    </button>
                </div>

            </div>

            <!-- Footer -->
            <div class="bg-gray-50 px-6 py-4 text-center border-t border-gray-200">
                <p class="text-xs text-gray-500">KodexAfrica Student Attendance System © 2024</p>
            </div>
        </div>
    </div>

    <script>
        // Default URL - Update this after deployment
        let currentURL = 'https://kodex-student-attendance.vercel.app/';
        let qrCodeCanvas = null;

        // Generate QR Code
        function generateQR(url) {
            const qrCodeElement = document.getElementById('qrcode');
            const qrWrapper = document.getElementById('qrWrapper');

            // Clear previous QR code
            qrCodeElement.innerHTML = '';

            try {
                // Create canvas element
                const canvas = document.createElement('canvas');
                canvas.className = 'qr-canvas mx-auto';

                // Generate QR code using QRious
                const qr = new QRious({
                    element: canvas,
                    value: url,
                    size: 300,
                    background: '#ffffff',
                    foreground: '#667eea',
                    level: 'H', // High error correction
                    padding: 20
                });

                // Add canvas to container
                qrCodeElement.appendChild(canvas);
                qrCodeCanvas = canvas;

                // Add animation
                qrWrapper.classList.add('pulse-animation');
                setTimeout(() => {
                    qrWrapper.classList.remove('pulse-animation');
                }, 2000);

            } catch (error) {
                console.error('QR Code generation error:', error);
                qrCodeElement.innerHTML = `
                    <div class="text-center p-8">
                        <svg class="w-16 h-16 mx-auto text-red-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-red-600 font-semibold">Unable to generate QR code</p>
                        <p class="text-sm text-gray-500 mt-2">Please check your connection and refresh the page</p>
                    </div>
                `;
            }
        }



        // Download QR Code as PNG
        function downloadQRImage() {
            if (!qrCodeCanvas) {
                alert('QR Code not generated yet');
                return;
            }

            try {
                const dataURL = qrCodeCanvas.toDataURL('image/png');
                const link = document.createElement('a');
                link.href = dataURL;
                link.download = 'Kodex-Attendance-QR-Code.png';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            } catch (error) {
                console.error('Download error:', error);
                alert('Error downloading image. Please try again.');
            }
        }

        // Download as PDF
        async function downloadAsPDF() {
            const container = document.querySelector('.qr-container');
            const buttons = document.querySelectorAll('button');

            // Hide buttons temporarily
            buttons.forEach(btn => btn.style.display = 'none');

            try {
                // Create canvas from the container
                const canvas = await html2canvas(container, {
                    scale: 2,
                    useCORS: true,
                    allowTaint: true,
                    backgroundColor: '#ffffff',
                    width: container.offsetWidth,
                    height: container.offsetHeight
                });

                // Create PDF
                const { jsPDF } = window.jspdf;
                const pdf = new jsPDF({
                    orientation: 'portrait',
                    unit: 'mm',
                    format: 'a4'
                });

                // Calculate dimensions to fit the page
                const imgWidth = 210; // A4 width in mm
                const imgHeight = (canvas.height * imgWidth) / canvas.width;

                // Add image to PDF
                pdf.addImage(canvas.toDataURL('image/png'), 'PNG', 0, 0, imgWidth, imgHeight);

                // Save the PDF
                pdf.save('Kodex-Attendance-QR-Code.pdf');

            } catch (error) {
                console.error('Error generating PDF:', error);
                alert('Error generating PDF. Please try again.');
            } finally {
                // Show buttons again
                buttons.forEach(btn => btn.style.display = '');
            }
        }



        // Auto-generate QR code on page load
        window.addEventListener('load', function() {
            setTimeout(() => {
                generateQR(currentURL);
                document.getElementById('formUrl').value = currentURL;
            }, 150);
        });


    </script>

</body>
</html>
