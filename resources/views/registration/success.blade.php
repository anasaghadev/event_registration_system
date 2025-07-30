@extends('layouts.public')

@section('content')
    <div
        class="min-h-screen bg-gradient-to-br from-green-50 to-teal-100 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full bg-white p-8 rounded-2xl shadow-xl border border-green-100 text-center">
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100">
                <svg class="h-10 w-10 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>

            <h2 class="mt-6 text-3xl font-bold text-gray-900">
                تم التسجيل بنجاح!
            </h2>

            <div class="mt-4 text-lg text-gray-600">
                <p>تم إرسال رمز QR الخاص بك إلى بريدك الإلكتروني</p>
                <p class="mt-2 text-indigo-600 font-medium">{{ $attendee->email }}</p>
            </div>

            <!-- QR Code Display -->
            <div class="mt-8 bg-white p-4 rounded-lg border border-gray-200">
                <h3 class="text-lg font-medium text-gray-800 mb-3">رمز QR الخاص بك</h3>


                <img src="{{ $qrCodePath }}" alt="QR Code" class="mx-auto w-48 h-48">
                <p class="mt-3 text-sm text-gray-600">احفظ هذا الرمز لتأكيد حضورك في الفعالية</p>
            </div>

            <div class="mt-4">
                <a href="{{ $qrCodePath }}" download="my-qr-code.png"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    تحميل رمز QR
                </a>
            </div>

            <div class="mt-8 flex flex-col sm:flex-row justify-center gap-3">
                <a href="{{ route('registration.create') }}"
                    class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    تسجيل جديد
                </a>

                <a href="/"
                    class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg shadow-sm text-gray-700 bg-white hover:bg-gray-50">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                    الصفحة الرئيسية
                </a>
            </div>

            <div class="mt-8 text-sm text-gray-500">
                <p>سيصلك رمز QR أيضًا على بريدك الإلكتروني للاحتفاظ به</p>
            </div>
        </div>
    </div>
@endsection
