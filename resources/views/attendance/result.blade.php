@extends('layouts.admin')

@section('content')
    <div
        class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full bg-white p-8 rounded-2xl shadow-xl border border-blue-100">
            <div class="text-center">
                @if ($success)
                    <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 mb-4">
                        <svg class="h-10 w-10 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                @else
                    <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-yellow-100 mb-4">
                        <svg class="h-10 w-10 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                @endif

                <h2 class="mt-2 text-3xl font-bold text-gray-900">
                    {{ $message }}
                </h2>
            </div>

            <div class="mt-8 bg-gray-50 p-6 rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 mb-4">معلومات المشارك</h3>

                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">الاسم:</span>
                        <span class="font-medium">{{ $attendee->name }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-600">البريد الإلكتروني:</span>
                        <span class="font-medium">{{ $attendee->email }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-600">رقم الهاتف:</span>
                        <span class="font-medium">{{ $attendee->phone }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-600">رقم المشارك:</span>
                        <span class="font-medium">{{ $attendee->id }}</span>
                    </div>
                </div>
            </div>

            <div class="mt-8 flex flex-col sm:flex-row justify-center gap-3">
                <a href="{{ route('attendance.form') }}"
                    class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-base font-medium rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700">
                    تأكيد مشارك آخر
                </a>

                <a href="/"
                    class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 text-base font-medium rounded-lg shadow-sm text-gray-700 bg-white hover:bg-gray-50">
                    الصفحة الرئيسية
                </a>
            </div>
        </div>
    </div>
@endsection
