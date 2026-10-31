<!DOCTYPE html>
<html lang="ar" dir="rtl" class="h-full bg-slate-950">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء حساب جديد</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Cairo', sans-serif; }
    </style>
</head>
<body class="h-full bg-slate-950 text-slate-100 flex items-center justify-center p-4 selection:bg-indigo-500 selection:text-white">

    <div class="w-full max-w-md bg-slate-900/90 rounded-2xl shadow-2xl p-8 border border-slate-800/80 backdrop-blur-md">
        
        {{-- الهيدر --}}
        <div class="text-center mb-6">
            <div class="inline-flex p-3 bg-indigo-500/10 border border-indigo-500/20 rounded-2xl mb-3">
                <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=400" alt="Logo" class="size-8" />
            </div>
            <h1 class="text-2xl font-bold text-white">حساب جديد 🚀</h1>
            <p class="text-sm text-slate-400 mt-1">انضم إلينا وابدأ في استخدام المنصة</p>
        </div>

        {{-- 🌟 1. صندوق يعرض جميع الأخطاء القادمة من الـ Validation دفعة واحدة --}}
        @if ($errors->any())
            <div class="mb-5 p-4 rounded-xl bg-red-500/10 border border-red-500/30 text-red-400 text-sm">
                <div class="font-semibold mb-1">يرجى تصحيح الأخطاء التالية:</div>
                <ul class="list-disc list-inside space-y-1 text-xs">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- 🌟 2. صندوق الرسائل القادمة من الـ Session (لو كاتب error فلاش في الكنترولر) --}}
        @if (session('error'))
            <div class="mb-5 p-4 rounded-xl bg-red-500/10 border border-red-500/30 text-red-400 text-sm text-center">
                {{ session('error') }}
            </div>
        @endif

        {{-- الفوّرم --}}
        <form method="POST" action="{{ route('signup') }}" class="space-y-4">
            @csrf

            {{-- الاسم بالكامل --}}
            <div>
                <label for="name" class="block text-sm font-medium text-slate-300 mb-1.5">الاسم بالكامل</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name') }}" 
                    required 
                    autofocus
                    placeholder="اكتب اسمك بالكامل"
                    class="w-full px-4 py-3 rounded-xl bg-slate-950 border text-slate-100 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition placeholder:text-slate-600 @error('name') border-red-500/80 ring-1 ring-red-500/50 @else border-slate-800 @enderror"
                >
                @error('name')
                    <p class="text-xs text-red-400 mt-1.5 font-medium">{{ $message }}</p>
                @enderror
            </div>

            {{-- البريد الإلكتروني --}}
            <div>
                <label for="email" class="block text-sm font-medium text-slate-300 mb-1.5">البريد الإلكتروني</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ old('email') }}" 
                    required 
                    placeholder="email@example.com"
                    class="w-full px-4 py-3 rounded-xl bg-slate-950 border text-slate-100 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition placeholder:text-slate-600 @error('email') border-red-500/80 ring-1 ring-red-500/50 @else border-slate-800 @enderror"
                >
                @error('email')
                    <p class="text-xs text-red-400 mt-1.5 font-medium">{{ $message }}</p>
                @enderror
            </div>

            {{-- كلمة السر --}}
            <div>
                <label for="password" class="block text-sm font-medium text-slate-300 mb-1.5">كلمة السر</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    required 
                    placeholder="••••••••"
                    class="w-full px-4 py-3 rounded-xl bg-slate-950 border text-slate-100 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition placeholder:text-slate-600 @error('password') border-red-500/80 ring-1 ring-red-500/50 @else border-slate-800 @enderror"
                >
                @error('password')
                    <p class="text-xs text-red-400 mt-1.5 font-medium">{{ $message }}</p>
                @enderror
            </div>

            {{-- تأكيد كلمة السر --}}
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-slate-300 mb-1.5">تأكيد كلمة السر</label>
                <input 
                    type="password" 
                    id="password_confirmation" 
                    name="password_confirmation" 
                    required 
                    placeholder="••••••••"
                    class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-800 text-slate-100 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition placeholder:text-slate-600"
                >
            </div>

            {{-- زر التسجيل --}}
            <button 
                type="submit" 
                class="w-full py-3.5 px-4 bg-indigo-600 hover:bg-indigo-500 text-white font-bold rounded-xl transition duration-200 shadow-lg shadow-indigo-600/25 active:scale-[0.98] mt-2"
            >
                إنشاء الحساب
            </button>

        </form>

        {{-- رابط العودة لصفحة الدخول --}}
    

</body>
</html>