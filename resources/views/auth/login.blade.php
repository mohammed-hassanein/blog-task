@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="max-w-md mx-auto">
    <div class="mb-8 text-center">
        <h1 class="text-3xl font-extrabold text-slate-900 mb-2 tracking-tight">Welcome Back</h1>
        <p class="text-slate-500">Sign in to access the admin dashboard.</p>
    </div>

    <form method="POST" action="{{ route('login.store') }}" class="bg-white rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] p-8 space-y-6">
        @csrf

        <div>
            <label for="email" class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Email</label>
            <input
                id="email"
                name="email"
                type="email"
                value="{{ old('email') }}"
                required
                autofocus
                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all @error('email') border-rose-500 @enderror"
                placeholder="you@example.com"
            >
            @error('email')
                <p class="mt-2 text-sm text-rose-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Password</label>
            <input
                id="password"
                name="password"
                type="password"
                required
                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all @error('password') border-rose-500 @enderror"
                placeholder="Your password"
            >
            @error('password')
                <p class="mt-2 text-sm text-rose-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-2">
            <input id="remember" name="remember" type="checkbox" class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
            <label for="remember" class="text-sm text-slate-600">Remember me</label>
        </div>

        <button
            type="submit"
            class="w-full px-6 py-3 bg-gradient-to-r from-indigo-600 to-violet-600 text-white rounded-xl hover:from-indigo-500 hover:to-violet-500 font-semibold transition-all shadow-md hover:shadow-xl"
        >
            Sign In
        </button>
    </form>
</div>
@endsection
