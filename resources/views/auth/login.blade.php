<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>
    {{-- CDN لتشغيل Tailwind فوراً --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Cairo', sans-serif; }
    </style>
</head>
<body class="bg-slate-100 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8 border border-slate-200/60">
        
        {{-- الهيدر --}}
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-slate-800">أهلاً بك مجدداً 👋</h1>
            <p class="text-sm text-slate-500 mt-2">سجل دخولك للمتابعة إلى حسابك</p>
        </div>

        {{-- أخطاء الـ Validation العامة --}}
        @if ($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-600 text-sm">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- الفوّرم --}}
        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            {{-- البريد الإلكتروني --}}
            <div>
                <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">البريد الإلكتروني</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ old('email') }}" 
                    required 
                    autofocus
                    placeholder="name@company.com"
                    class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition text-slate-800 placeholder-slate-400 @error('email') border-red-500 ring-1 ring-red-500 @enderror"
                >
            </div>

            {{-- كلمة السر --}}
            <div>
                <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">كلمة السر</label>
                <input 
                    type="password" 
                    value="{{ old('password') }}"
                    id="password" 
                    name="password" 
                    required 
                    placeholder="••••••••"
                    class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition text-slate-800 placeholder-slate-400"
                >
            </div>

            {{-- تذكرني --}}
            <div class="flex items-center justify-between pt-1">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input 
                        type="checkbox" 
                        name="remember" 
                        class="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 accent-indigo-600"
                    >
                    <span class="text-sm font-medium text-slate-600">تذكرني على هذا الجهاز</span>
                </label>
            </div>

            {{-- زر الدخول --}}
            <button 
                type="submit" 
                class="w-full py-3.5 px-4 bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-200 text-white font-bold rounded-xl transition duration-200 shadow-lg shadow-indigo-600/30 active:scale-[0.98]"
            >
                تسجيل الدخول
            </button>

        </form>
    </div>

</body>
</html>