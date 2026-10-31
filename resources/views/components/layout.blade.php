<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-950">
<head>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- 🌟 Alpine.js لتشغيل الأكشن والتحكم في قائمة الموبايل أوتوماتيكياً -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Job Board' }}</title>
</head>
<body class="h-full bg-slate-950 text-slate-100 antialiased selection:bg-indigo-500 selection:text-white">
    
    <div class="min-h-full flex flex-col">
        <!-- 🌟 Navbar: أضفنا x-data="{ open: false }" لحفظ حالة القائمة -->
        <nav x-data="{ open: false }" class="sticky top-0 z-40 bg-slate-900/70 backdrop-blur-md border-b border-slate-800/80 shadow-xl shadow-slate-950/20">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    
                    <!-- اللوجو والقائمة (Desktop) -->
                    <div class="flex items-center">
                        <div class="shrink-0 flex items-center gap-2">
                            <div class="p-1.5 bg-indigo-500/10 border border-indigo-500/20 rounded-xl">
                                <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=400" alt="Your Company" class="size-7" />
                            </div>
                        </div>
                        
                        <div class="hidden md:block">
                            <div class="ml-10 flex items-baseline space-x-2">
                                <x-nav href="/" :action="request()->is('/')">Home</x-nav>
                                <x-nav href="/about" :action="request()->is('about')">About</x-nav>
                                <x-nav href="/contact" :action="request()->is('contact')">Contact</x-nav>
                                <x-nav href="/blog" :action="request()->is('blog')">Blog</x-nav>
                            </div>
                        </div>
                    </div>

                    <!-- 🌟 الشاشة الكبيرة: زرارين Sign In و Sign Up ألوانهم رايقة متناسقة -->

    @auth
    {{-- الكود ده هيظهر فقط لو المستخدم مسجل دخوله --}}
        <div class="flex items-center gap-4">
            <span class="text-slate-200 font-semibold">
                مرحباً، {{ auth()->user()->name }} 👋
            </span>

            {{-- زرار تسجيل الخروج --}}
            <form method="POST" action="/logout">
                @csrf
                <button type="submit" class="text-sm text-red-400 hover:text-red-300 font-medium">
                    تسجيل الخروج
                </button>
            </form>
        </div>
    @endauth

    @guest
        {{-- الكود ده هيظهر فقط للزائر (الـ Guest) اللي مش مسجل --}}
        <div class="flex items-center gap-3">
            <a href="{{ route('login') }}" class="text-slate-300 hover:text-white text-sm font-medium">
                تسجيل الدخول
            </a>
            <a href="{{ route('signup') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-500 rounded-xl text-white text-sm font-bold transition">
                حساب جديد
            </a>
        </div>
    @endguest

                    <!-- 🌟 زرار الموبايل: أضفنا @click لفتح وغلق القائمة وتغيير شكل الأيقونة -->
                    <div class="-mr-2 flex md:hidden">
                        <button @click="open = !open" type="button" class="inline-flex items-center justify-center rounded-xl p-2 text-slate-400 hover:bg-slate-800 hover:text-white border border-slate-800 transition">
                            <span class="sr-only">Open main menu</span>
                            <!-- أيقونة الـ Hamburger عند الغلق -->
                            <svg x-show="!open" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="size-6">
                                <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <!-- أيقونة الـ X عند الفتح -->
                            <svg x-show="open" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="size-6" x-cloak>
                                <path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- 🌟 قائمة الموبايل: مربوطة بنفس اللينكات والزرارين مع أنيميشن ناعم -->
            <div x-show="open" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-2"
                 class="md:hidden border-t border-slate-800 bg-slate-900/95 px-4 pt-3 pb-5 space-y-3">
                
                {{-- اللينكات الخاصة بالصفحات --}}
                <div class="flex flex-col space-y-1">
                    <x-nav href="/" :action="request()->is('/')">Home</x-nav>
                    <x-nav href="/about" :action="request()->is('about')">About</x-nav>
                    <x-nav href="/contact" :action="request()->is('contact')">Contact</x-nav>
                    <x-nav href="/blog" :action="request()->is('blog')">Blog</x-nav>
                </div>

                {{-- زرارين تسجيل الدخول للموبايل --}}
                <div class="pt-4 border-t border-slate-800/80 flex flex-col gap-2">
                    <a href="/login" class="w-full text-center py-2.5 px-4 text-sm font-medium text-slate-300 hover:text-white rounded-xl bg-slate-800/60 border border-slate-700/60 hover:bg-slate-800 transition">
                        Sign In
                    </a>
                    <a href="/register" class="w-full text-center py-2.5 px-4 text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-500 rounded-xl shadow-md transition active:scale-95">
                        Sign Up
                    </a>
                </div>
            </div>
        </nav>

        <!-- 🌟 Header -->
        <header class="relative border-b border-slate-800/60 bg-gradient-to-b from-slate-900 to-slate-950 py-8">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
                    {{ $title ?? 'Job Board' }}
                </h1>
            </div>
        </header>

        <!-- 🌟 Main Content Zone -->
        <main class="flex-1 py-8">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </main>
    </div>

<script src="{{ asset('js/show.js') }}"></script>
</body>
</html>