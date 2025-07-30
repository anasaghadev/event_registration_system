@extends('layouts.admin')

@section('content')
    <div
        class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full bg-white p-8 rounded-2xl shadow-xl border border-blue-100">
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-blue-100 mb-4">
                    <svg class="h-10 w-10 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>

                <h2 class="mt-2 text-3xl font-bold text-gray-900">
                    تأكيد حضور المشاركين
                </h2>

                <p class="mt-4 text-lg text-gray-600">
                    أدخل رقم المشارك أو امسح رمز QR لتأكيد الحضور
                </p>
            </div>

            <form class="mt-8" method="POST" action="{{ route('attendance.confirm') }}">
                @csrf

                <div class="mb-6">
                    <label for="attendee_id" class="block text-lg font-medium text-gray-700 mb-2">
                        رقم المشارك
                    </label>
                    <input type="number" name="attendee_id" id="attendee_id" required
                        class="w-full px-4 py-3 text-lg border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="أدخل رقم المشارك">
                    @error('attendee_id')
                        <p class="mt-2 text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6">
                    <button type="submit"
                        class="w-full flex justify-center py-3 px-4 border border-transparent text-lg font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        تأكيد الحضور
                    </button>
                </div>
            </form>

            <div class="mt-8 text-center">
                <p class="text-gray-600 mb-4">
                    أو امسح رمز QR باستخدام كاميرا جهازك
                </p>

                <!-- QR Scanner Toggle Button -->
                <button id="toggle-scanner"
                    class="mb-4 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                    تشغيل الماسح الضوئي
                </button>

                <div class="mt-4 hidden" id="scanner-container">
                    <div id="qr-reader" class="w-full mb-4"></div>

                    <!-- Stop Scanner Button -->
                    <button id="stop-scanner"
                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                        إيقاف الماسح الضوئي
                    </button>
                </div>

                <!-- Alternative Upload Option -->
                <div class="mt-6">
                    <p class="text-gray-600 mb-2">أو قم بتحميل صورة رمز الـ QR</p>
                    <form id="upload-form" enctype="multipart/form-data">
                        <input type="file" id="qr-file" accept="image/*" class="hidden">
                        <button type="button" id="upload-btn"
                            class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500">
                            اختر صورة
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Include QR Scanner -->
    <script src="https://unpkg.com/html5-qrcode@2.0.9/dist/html5-qrcode.min.js"></script>
    <script>
        let html5QrCode = null;
        let scannerActive = false;

        // Toggle QR Scanner
        document.getElementById('toggle-scanner').addEventListener('click', function() {
            const scannerContainer = document.getElementById('scanner-container');

            if (!scannerActive) {
                startScanner();
                scannerContainer.classList.remove('hidden');
                this.textContent = 'إخفاء الماسح الضوئي';
                scannerActive = true;
            } else {
                scannerContainer.classList.add('hidden');
                this.textContent = 'تشغيل الماسح الضوئي';
                scannerActive = false;
            }
        });

        // Stop Scanner
        document.getElementById('stop-scanner').addEventListener('click', function() {
            if (html5QrCode && scannerActive) {
                html5QrCode.stop().then(() => {
                    console.log('QR scanner stopped');
                    scannerActive = false;
                    document.getElementById('scanner-container').classList.add('hidden');
                    document.getElementById('toggle-scanner').textContent = 'تشغيل الماسح الضوئي';
                }).catch(err => console.error('Error stopping scanner:', err));
            }
        });

        // Start Scanner
        function startScanner() {
            if (!html5QrCode) {
                html5QrCode = new Html5Qrcode("qr-reader");
            }

            const config = {
                fps: 10,
                qrbox: {
                    width: 250,
                    height: 250
                }
            };

            Html5Qrcode.getCameras().then(cameras => {
                if (cameras && cameras.length) {
                    html5QrCode.start(
                        cameras[0].id,
                        config,
                        onScanSuccess,
                        () => console.log('QR scanning initialized')
                    ).catch(err => {
                        console.error('Unable to start scanner:', err);
                        alert('لا يمكن تشغيل الكاميرا. يرجى التحقق من الأذونات.');
                    });
                } else {
                    console.warn('No cameras found');
                    alert('لم يتم العثور على كاميرا.');
                }
            });
        }

        function onScanSuccess(decodedText) {
            try {
                const data = JSON.parse(decodedText);
                if (data.id) {
                    document.getElementById('attendee_id').value = data.id;
                    document.querySelector('form').submit();
                }
            } catch (e) {
                console.error('Error parsing QR data:', e);
                alert('رمز QR غير صالح. يرجى المحاولة مرة أخرى.');
            }
        }

        // File Upload Handler
        document.getElementById('upload-btn').addEventListener('click', function() {
            document.getElementById('qr-file').click();
        });

        document.getElementById('qr-file').addEventListener('change', function(e) {
            if (e.target.files.length === 0) return;

            const file = e.target.files[0];
            Html5Qrcode.getCameras().then(cameras => {
                const html5QrCode = new Html5Qrcode("qr-reader");

                html5QrCode.scanFile(file, false)
                    .then(decodedText => {
                        try {
                            const data = JSON.parse(decodedText);
                            if (data.id) {
                                document.getElementById('attendee_id').value = data.id;
                                document.querySelector('form').submit();
                            }
                        } catch (e) {
                            console.error('Error parsing QR data:', e);
                            alert('رمز QR غير صالح. يرجى المحاولة مرة أخرى.');
                        }
                    })
                    .catch(err => {
                        console.error('Error scanning file:', err);
                        alert('فشل قراءة رمز QR. يرجى المحاولة بصورة أخرى.');
                    });
            });
        });

        // Cleanup scanner when leaving page
        window.addEventListener('beforeunload', function() {
            if (html5QrCode && scannerActive) {
                html5QrCode.stop().catch(err => console.error('Error stopping scanner:', err));
            }
        });
    </script>
@endsection
