<x-layout title="{{ $post->title }}">

    <!-- 🔙 زرار الرجوع لصفحة المقالات -->
    <div class="max-w-3xl mx-auto mb-6">
        <a href="{{ url()->previous() }}" class="inline-flex items-center gap-2 text-sm font-semibold text-slate-500 hover:text-indigo-600 transition">
            <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
            الرجوع لكل المقالات
        </a>
    </div>

    <!-- 📄 كارت المقال الرئيسي -->
    <article class="max-w-3xl mx-auto bg-white rounded-2xl border border-slate-200/80 p-6 sm:p-10 shadow-sm">
        <!-- الهيدر والكاتب -->
        <header class="border-b border-slate-100 pb-6">
            <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-900 leading-tight">
                {{ $post->title }}
            </h1>
            <div class="mt-3 flex items-center gap-3">
                <div class="size-9 rounded-full bg-indigo-100 text-indigo-700 font-bold flex items-center justify-center text-sm border border-indigo-200">
                    {{ strtoupper(substr($post->author, 0, 1)) }}
                </div>
                <div>
                    <p class="text-sm font-semibold text-slate-800">By {{ $post->author }}</p>
                    <p class="text-xs text-slate-400">Published recently</p>
                </div>
            </div>
        </header>

        <!-- محتوى المقال -->
        <div class="mt-6 text-slate-700 leading-relaxed text-base whitespace-pre-line">
            {{ $post->body }}
        </div>
    </article>

    <!-- 💬 قسم التعليقات (Comments Section) -->
 @if(session('success'))
    <div id="success-alert" 
         class="flex items-center gap-3 rounded-xl bg-emerald-500/10 border border-emerald-500/30 p-4 text-emerald-400 shadow-lg shadow-emerald-500/5 backdrop-blur-sm transition-all duration-500 mb-4 transform translate-y-0 opacity-100">
        
        <!-- أيقونة صح (Checkmark) بلون مضيء -->
        <svg class="w-5 h-5 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>

        <!-- نص الرسالة -->
        <span class="text-sm font-medium leading-relaxed">
            {{ session('success') }}
        </span>
    </div>
@endif

<script>
    setTimeout(function() {
        let alert = document.getElementById('success-alert');
        if (alert) {
            // تأثير الاختفاء الناعم (بيطلع لفوق سنة ويتلاشى)
            alert.style.transition = "all 0.6s cubic-bezier(0.4, 0, 0.2, 1)";
            alert.style.opacity = "0";
            alert.style.transform = "translateY(-12px) scale(0.98)";
            
            // ينشال تماماً من الصفحة بعد انتهاء الحركة
            setTimeout(() => alert.remove(), 600);
        }
    }, 5000); // 5 ثواني مضبوطة
</script>






    <section class="max-w-3xl mx-auto mt-8">
        <div class="bg-white rounded-2xl border border-slate-200/80 p-6 sm:p-8 shadow-sm">
            <h3 class="text-lg font-bold text-slate-900 flex items-center gap-2 mb-6">
                💬 التعليقات
            </h3>

            <!-- ✍️ 1. فورم إضافة تعليق جديد (بخانة الكاتب وخانة التعليق) -->
<form action="/comment" method="POST" class="space-y-4">
    @csrf

    <!-- 0️⃣ حقل الـ post_id المخفي (ضروري جداً لوجود شرط exists:posts,id في الـ Request) -->
    <input type="hidden" name="post_id" value="{{ $post->id }}">

    <!-- 1️⃣ خانة اسم الكاتب (author) -->
    <div>
        <label for="author" class="block text-xs font-semibold text-slate-600 mb-1">الاسم / الكاتب</label>
        <input type="text" id="author" name="author" value="{{ old('author') }}"
               placeholder="اكتب اسمك..." 
               class="w-full rounded-xl border @error('author') border-rose-500 @else border-slate-200 @enderror p-3 text-sm text-slate-800 placeholder-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition">
        
        <!-- رسالة الخطأ الخاصة بالكاتب -->
        @error('author')
            <p class="text-xs text-rose-500 font-semibold mt-1.5">{{ $message }}</p>
        @enderror
    </div>

    <!-- 2️⃣ خانة نص التعليق (body) -->
    <div>
        <label for="body" class="block text-xs font-semibold text-slate-600 mb-1">التعليق</label>
        <textarea id="body" name="body" rows="3"
                  placeholder="أكتب تعليقك هنا..." 
                  class="w-full rounded-xl border @error('body') border-rose-500 @else border-slate-200 @enderror p-3 text-sm text-slate-800 placeholder-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition resize-none">{{ old('body') }}</textarea>
        
        <!-- رسالة الخطأ الخاصة بالتعليق -->
        @error('body')
            <p class="text-xs text-rose-500 font-semibold mt-1.5">{{ $message }}</p>
        @enderror
    </div>

    <!-- تغليف الزرار بمحاذاة لليمين -->
<div class="flex justify-end">
    <button type="submit" class="bg-indigo-600 text-white text-sm font-semibold px-5 py-2.5 rounded-xl hover:bg-indigo-700 transition">
        حفظ التعليق
    </button>
</div>
</form>

            <hr class="border-slate-100 my-6">

            <!-- 🗨️ 2. قائمة عرض التعليقات -->
            <div class="space-y-4">
<div class="space-y-4">
    @forelse ($post->comments ?? [] as $comment)
        <div class="p-4 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-between">
            <div>
                <span class="text-xs font-bold text-indigo-600">By: {{ $comment->author }}</span>
                <p class="text-sm text-slate-700 mt-1">{{ $comment->body }}</p>
            </div>

            <div class="flex items-center gap-3">
                <!-- زرار التعديل -->
                <a href="/comment/{{ $comment->id }}/edit" class="text-xs font-semibold text-amber-600">تعديل</a>

                <!-- الفوّرم عادي جداً -->
                <form id="delete-comment-form-{{ $comment->id }}" action="/comment/{{ $comment->id }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    
                    <!-- الزرار واخد Class مميز ومعلّم بالـ Form ID جوه data-form-id -->
                    <button type="button" 
                            class="delete-comment-btn text-xs font-semibold text-rose-500 cursor-pointer" 
                            data-form-id="delete-comment-form-{{ $comment->id }}">
                        حذف
                    </button>
                </form>
            </div>
        </div>
    @empty
        <p class="text-center text-slate-400 text-sm">لا توجد تعليقات.</p>
    @endforelse
</div>

<!-- السكربت المباشر للحذف -->


</x-layout>