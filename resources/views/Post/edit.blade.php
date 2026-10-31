<body class="bg-slate-900 text-white min-h-screen">
    <div class="bg-slate-900 min-h-screen -mx-4 -my-6 sm:-mx-6 lg:-mx-8 p-6 sm:p-10">

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <!-- Card Content -->
    <div class="max-w-3xl mx-auto bg-slate-800/60 rounded-2xl border border-slate-700/50 p-6 sm:p-10 shadow-xl backdrop-blur-sm mt-6">
      
      <form method="POST" action="/blog/{{ $post->id }}" >
        @csrf
        @method('PUT')

        <div class="space-y-8">
          <!-- Header Inside Card -->
          <div class="border-b border-slate-700/60 pb-6">
            <h2 class="text-xl font-bold tracking-tight text-white">Edit Post</h2>
            <p class="mt-1 text-sm text-slate-400">Update the details below to modify the post.</p>
          </div>

          <div class="grid grid-cols-1 gap-y-6">
            
            <!-- 1. Title -->
            <div>
              <label for="title" class="block text-sm font-medium text-slate-200">Title</label>
              <div class="mt-2">
                <input 
                  type="text" 
                  name="title" 
                  id="title" 
                  value="{{ old('title', $post->title) }}"
                  class="{{ $errors->has('title') ? 'outline-red-500' : 'outline-gray-500' }} block w-full rounded-lg bg-slate-900/80 px-3.5 py-2.5 text-slate-100 border border-slate-700/80 placeholder:text-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm transition"
                  placeholder="Enter post title"
                />
              </div>
              @error('title') <span class="text-xs text-rose-400 mt-1 block font-medium">{{ $message }}</span> @enderror
            </div>

            <!-- 2. Author -->
            <div>
              <label for="author" class="block text-sm font-medium text-slate-200">Author</label>
              <div class="mt-2">
                <input 
                  type="text" 
                  name="author" 
                  id="author" 
                  value="{{ old('author', $post->author) }}"
                  class=" {{ $errors->has('author') ? 'outline-red-500' : 'outline-gray-500' }} block w-full rounded-lg bg-slate-900/80 px-3.5 py-2.5 text-slate-100 border border-slate-700/80 placeholder:text-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm transition"
                  placeholder="Author name"
                />
              </div>
              @error('author') <span class="text-xs text-rose-400 mt-1 block font-medium">{{ $message }}</span> @enderror
            </div>

            <!-- 3. Body -->
            <div>
              <label for="body" class="block text-sm font-medium text-slate-200">Content</label>
              <div class="mt-2">
                <textarea 
                  name="body" 
                  id="body" 
                  rows="5" 
                  class="{{ $errors->has('body') ? 'outline-red-500' : 'outline-gray-500' }} block w-full rounded-lg bg-slate-900/80 px-3.5 py-2.5 text-slate-100 border border-slate-700/80 placeholder:text-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm transition resize-y"
                  placeholder="Write content here..."
                >{{ old('body', $post->body) }}</textarea>
              </div>
              @error('body') <span class="text-xs text-rose-400 mt-1 block font-medium">{{ $message }}</span> @enderror
            </div>

           
           <!-- 4. Published -->
           <div class="pt-2">
             <label class="relative flex items-start cursor-pointer gap-x-3">
               @can('published', $post)
               <div class="flex h-6 items-center">
                  <input 
                    type="checkbox" 
                    name="published" 
                    id="published" 
                    value="1" 
                    {{ old('published', $post->published ) ? 'checked' : '' }}
                    class="size-4 rounded border-slate-700 bg-slate-900 text-indigo-500 focus:ring-indigo-500 focus:ring-offset-slate-900"
                  />
                </div>
                <div class="text-sm">
                  <span class="font-medium text-slate-200">Publish immediately</span>
                  <p class="text-slate-400 text-xs">Make this post public right after saving.</p>
                </div>
              </label>
              @endcan
            </div>

          </div>
        </div>

        <!-- Buttons -->
        <div class="mt-8 pt-6 border-t border-slate-700/60 flex items-center justify-end gap-x-4">
          <a href="{{ url()->previous() }}" class="text-sm font-semibold text-slate-300 hover:text-white transition">Cancel</a>
          <button type="submit" class="rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-indigo-600/30 hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 transition">
            Edit Post
          </button>
        </div>

      </form>
    </div>

  </div>
</body>