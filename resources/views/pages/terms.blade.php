@extends('layouts.app')
@section('title', 'شروط الاستخدام – مدارس الندى النموذجية')
@section('meta_description', 'شروط الاستخدام لمدارس الندى النموذجية الأهلية')

@section('content')
<main class="min-h-screen bg-white dark:bg-gray-950 py-20 px-4" dir="rtl" lang="ar">
    <div class="mx-auto max-w-3xl">
        <header class="mb-10 text-center">
            <a href="/" class="inline-flex items-center gap-2 text-sm text-primary-600 dark:text-primary-400 hover:underline mb-6">
                <svg class="h-4 w-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                العودة للرئيسية
            </a>
            <h1 class="font-heading text-3xl font-extrabold text-gray-900 dark:text-white">شروط الاستخدام</h1>
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">مدارس الندى النموذجية الأهلية</p>
        </header>
        <article class="prose prose-gray dark:prose-invert max-w-none leading-8 text-gray-700 dark:text-gray-300">
            {!! nl2br(e($content)) !!}
        </article>
    </div>
</main>
@endsection
