<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول - منصة الوظائف</title>
    <!-- تضمين Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- خط Cairo العربي -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased">

    <div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="text-center text-3xl font-extrabold text-gray-900">تسجيل الدخول</h2>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10 border border-gray-100">
                    @if ($errors->any())
                        <div class="mb-6 rounded-md bg-red-50 border border-red-200 p-4">
                            <ul class="list-disc list-inside text-sm text-red-600 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                <form class="space-y-6" action="{{ route('login') }}" method="POST">
                    <!-- لا تنسى @csrf في لارافيل -->
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">البريد الإلكتروني</label>
                        <div class="mt-1">
                            <input id="email" name="email" type="email" value="{{ old('email') }}" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">كلمة المرور</label>
                        <div class="mt-1">
                            <input id="password" name="password" type="password" value="{{ old('password') }}" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <label for="remember-me" class="ml-2 block text-sm text-gray-900">تذكرني</label>
                        </div>
                        <div class="text-sm">
                            <a href="{{route('register')}}" class="font-medium text-indigo-600 hover:text-indigo-500">نسيت كلمة المرور؟</a>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            دخول
                        </button>
                    </div>
                </form>

                <!-- رابط إنشاء الحساب في الأسفل -->
                <div class="mt-6 text-center text-sm text-gray-600">
                    ليس لديك حساب؟ <a href="{{route('register')}}" class="font-medium text-indigo-600 hover:text-indigo-500">إنشاء حساب جديد</a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>