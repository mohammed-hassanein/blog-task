<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Modern Blog')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                    },
                }
            }
        }
    </script>
</head>
<body class="bg-[#f8fafc] text-slate-800 font-sans antialiased relative min-h-screen flex flex-col selection:bg-indigo-500 selection:text-white">
    <!-- Decorative Background Shapes -->
    <div class="absolute top-0 inset-x-0 h-[30rem] bg-gradient-to-b from-indigo-50/80 to-transparent -z-10 pointer-events-none"></div>
    <div class="absolute top-0 right-0 -mr-32 -mt-32 w-96 h-96 rounded-full bg-violet-200/40 blur-3xl -z-10 pointer-events-none"></div>
    <div class="absolute top-64 left-0 -ml-32 w-[30rem] h-[30rem] rounded-full bg-blue-200/30 blur-3xl -z-10 pointer-events-none"></div>

    <!-- Navigation -->
    <nav class="sticky top-0 z-50 bg-white/70 backdrop-blur-xl border-b border-white/40 shadow-[0_1px_3px_rgba(0,0,0,0.02)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-600 to-violet-600 flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-indigo-200">
                        B
                    </div>
                    <a href="{{ route('blog.index') }}" class="text-2xl font-extrabold bg-gradient-to-r from-slate-900 to-slate-700 bg-clip-text text-transparent tracking-tight">
                        BlogTask
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="flex items-center gap-2 sm:gap-6">
                    <a href="{{ route('blog.index') }}" class="px-4 py-2 text-slate-600 hover:text-indigo-600 font-medium transition-all duration-300">
                        Home
                    </a>
                    <a href="{{ route('admin.posts.index') }}" class="px-5 py-2.5 bg-slate-900 hover:bg-indigo-600 text-white font-medium transition-all duration-300 rounded-xl shadow-md hover:shadow-xl hover:-translate-y-0.5">
                        Dashboard
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6 w-full relative z-40">
        @if ($message = Session::get('success'))
            <div class="rounded-2xl bg-emerald-500 text-white p-4 flex items-center gap-4 shadow-lg shadow-emerald-200 animate-[slideDown_0.4s_ease-out]">
                <div class="p-2 bg-white/20 rounded-xl flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                </div>
                <p class="font-medium">{{ $message }}</p>
            </div>
        @endif
        @if ($message = Session::get('error'))
            <div class="rounded-2xl bg-rose-500 text-white p-4 flex items-center gap-4 shadow-lg shadow-rose-200 animate-[slideDown_0.4s_ease-out]">
                <div class="p-2 bg-white/20 rounded-xl flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </div>
                <p class="font-medium">{{ $message }}</p>
            </div>
        @endif
    </div>

    <!-- Main Content -->
    <main class="flex-grow w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-14">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200 mt-auto relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-10">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4 text-slate-500">
                <div class="flex items-center gap-2">
                    <div class="w-7 h-7 rounded-lg bg-gradient-to-br from-indigo-600 to-violet-600 flex items-center justify-center text-white font-bold text-xs shadow-md">B</div>
                    <span class="font-bold text-slate-800 text-lg">BlogTask</span>
                </div>
                <p class="text-sm font-medium">&copy; {{ date('Y') }} All rights reserved.</p>
            </div>
        </div>
    </footer>
    <style>
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</body>
</html>
