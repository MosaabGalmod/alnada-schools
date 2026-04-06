@extends("admin.layout")
@section("title", "الرسائل")
@section("page-title", "رسائل التواصل")
@section("page-desc", "الرسائل الواردة من الموقع")
@section("admin-content")
  @livewire("admin.messages")
@endsection
