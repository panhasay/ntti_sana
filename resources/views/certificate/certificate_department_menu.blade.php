<style>
    .effect-9 {
        width: 274px !important;
    }
</style>
@extends('app_layout.app_layout')
@section('content')
    <x-breadcrumbs :array="[
        ['route' => 'certificate/dept-menu', 'title' => 'ដេប៉ាតឺម៉ង់'],
        ['route' => 'department-menu', 'title' => 'ប្រព័ន្ឋគ្រប់គ្រងលិខិតបញ្ជាក់'],
    ]" style="custom-style" />
    <x-grid>
        @foreach ($record_dept as $item)
            <x-card-department url="{{ route('cert.dept.list', ['dept_code' => $item->code]) }}"
                image="/asset/NTTI/images/modules/{{ $item->icon }}" alt="Reports Management" title="{{ $item->name_2 }}" />
        @endforeach
    </x-grid>
@endsection
