@extends('admin.layout')

@section('title', 'إدارة الأقسام')
@section('page-title', 'إدارة أقسام الموقع')
@section('page-desc', 'تحكم في ترتيب وظهور ومحتوى وأنماط كل قسم في الصفحة الرئيسية')

@section('admin-content')
@livewire('admin.section-manager')
@endsection
