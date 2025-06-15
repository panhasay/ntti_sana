@extends('app_layout.app_layout')
@section('content')
    <x-breadcrumbs :array="[
        ['route' => 'certificate/module-menu', 'title' => 'ត្រួតពិនិត្យលិខិតបញ្ជាក់'],
        ['route' => 'department-menu', 'title' => 'ប្រព័ន្ឋគ្រប់គ្រងលិខិតបញ្ជាក់'],
    ]" style="custom-style" />
    <x-module-center>
        @foreach ($record_certificate as $item)
            <x-module img="/asset/NTTI/images/modules/{{ $item->icon }}"
                url="/certificate/{{ $item->route }}/{{ $item->code }}" title="{{ $item->name_kh }}" />
        @endforeach
    </x-module-center>
@endsection
