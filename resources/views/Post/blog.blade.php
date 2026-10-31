<x-layout title="{{ $title }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <div class="mt-8 pt-6 border-t border-slate-700/60 flex items-center justify-end gap-x-4">
        @if (auth()->check() && in_array(auth()->user()->role, ['Admin' , 'Editor']))
          <a href="/blog/create" class="rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-indigo-600/30 hover:bg-indigo-500 transition">Create Post</a>
        @endif
    </div>

    @if(session('success'))
    <div id="success-alert" 
         class="flex items-center gap-3 rounded-xl bg-emerald-500/10 border border-emerald-500/30 p-4 text-emerald-400 shadow-lg shadow-emerald-500/5 backdrop-blur-sm transition-all duration-500 mb-4 transform translate-y-0 opacity-100">
        <svg class="w-5 h-5 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <span class="text-sm font-medium leading-relaxed">
            {{ session('success') }}
        </span>
    </div>
    @endif

    @if(session('error'))
    <div id="error-alert" 
         class="flex items-center gap-3 rounded-xl bg-rose-500/10 border border-rose-500/30 p-4 text-rose-400 shadow-lg shadow-rose-500/5 backdrop-blur-sm transition-all duration-500 mb-4 transform translate-y-0 opacity-100">
        <svg class="w-5 h-5 text-rose-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
        </svg>
        <span class="text-sm font-medium leading-relaxed">
            {{ session('error') }}
        </span>
    </div>
    @endif

    <script>
        setTimeout(function() {
            let alert = document.getElementById('success-alert');
            if (alert) {
                alert.style.transition = "all 0.6s cubic-bezier(0.4, 0, 0.2, 1)";
                alert.style.opacity = "0";
                alert.style.transform = "translateY(-12px) scale(0.98)";
                setTimeout(() => alert.remove(), 600);
            }
        }, 5000);
    </script>

    <div class="space-y-4 max-w-3xl mx-auto">
        @forelse ($posts as $post)
            <!-- كارت البوست -->
            <div class="p-6 rounded-2xl bg-slate-800/50 border border-slate-700/50 flex items-center justify-between">
                
                <!-- بيانات البوست -->
                <div>
                    <h2 class="text-lg font-bold text-white">{{ $post->title }}</h2>
                    <span class="text-xs text-indigo-400">By {{ $post->author }}</span>
                    <p class="text-sm text-slate-300 mt-2">{{ $post->body }}</p>
                </div>

                <!-- أزرار التحكم والـ Like متناسقة داخل الكارت -->
                <div class="flex items-center gap-2">
                    
                    {{-- زرار اللايك (متاح للمستخدمين المسجلين فقط) --}}
                    @auth
                        <form action="{{ route('posts.like', $post->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" 
                                    class="px-3 py-1 text-xs font-semibold rounded-lg flex items-center gap-1 transition-colors cursor-pointer {{ auth()->user()->likedPosts->contains($post->id) ? 'bg-rose-500/20 text-rose-400 border border-rose-500/30 hover:bg-rose-500/30' : 'bg-slate-700/50 text-slate-300 border border-slate-600/50 hover:bg-slate-700' }}">
                                @if(auth()->user()->likedPosts->contains($post->id))
                                    ❤️ <span>{{ $post->likes()->count() }}</span>
                                @else
                                    🤍 <span>{{ $post->likes()->count() }}</span>
                                @endif
                            </button>
                        </form>
                    @endauth

                    @if (auth()->check() && in_array(auth()->user()->role, ['viewer', 'Admin', 'Editor']))
                        <a href="/blog/{{ $post->id }}" 
                           class="px-3 py-1 text-xs font-semibold rounded-lg bg-indigo-600/30 text-indigo-300 hover:bg-indigo-600/50 transition-colors">
                            Show
                        </a>
                    @endif

                    @can('update', $post)
                        <a href="/blog/{{ $post->id }}/edit" 
                           class="px-3 py-1 text-xs font-semibold rounded-lg bg-amber-600/30 text-amber-300 hover:bg-amber-600/50 transition-colors">
                            Edit
                        </a>
                    @endcan
                    
                    @can('delete', $post)
                        <button type="button" 
                                onclick="confirmDeletePost('/blog/{{ $post->id }}')"
                                class="px-3 py-1 text-xs font-semibold rounded-lg bg-rose-600/30 text-rose-300 hover:bg-rose-600/50 transition-colors cursor-pointer">
                            Delete
                        </button>
                    @endcan
                </div>

            </div>
        @empty
            <p class="text-center text-slate-400 py-6">لا توجد بوستات حتى الآن.</p>
        @endforelse
    </div>

    <!-- الترقيم (Pagination) -->
    <div class="max-w-3xl mx-auto mt-6">
        {{ $posts->links() }} 
    </div>

    <!-- السكربت الخاص بالحذف -->
    <script>
    function confirmDeletePost(url) {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'هل أنت متأكد؟',
                text: "لن تتمكن من التراجع عن حذف هذا البوست!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e11d48',
                cancelButtonColor: '#475569',
                confirmButtonText: 'نعم، احذفه!',
                cancelButtonText: 'إلغاء',
                background: '#1e293b',
                color: '#fff'
            }).then((result) => {
                if (result.isConfirmed) {
                    executePostDelete(url);
                }
            });
        } else {
            if (confirm('هل أنت متأكد من حذف هذا البوست؟')) {
                executePostDelete(url);
            }
        }
    }

    function executePostDelete(url) {
        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';

        const form = document.createElement('form');
        form.action = url;
        form.method = 'POST';

        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = token;

        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';

        form.appendChild(csrfInput);
        form.appendChild(methodInput);
        document.body.appendChild(form);
        form.submit();
    }
    </script>
</x-layout>