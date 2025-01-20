<style>
    .title-department {
        text-align: center !important;
        padding: 3px 6px 16px !important;
        font-size: 16px !important;
    }
</style>
@extends('app_layout.app_layout')
@section('content')
    <x-breadcrumbs :array="[
        ['route' => 'certificate/dept-menu/' . $record_dept[0]->code, 'title' => 'ត្រួតពិនិត្យលិខិតបញ្ជាក់'],
        ['route' => 'certificate/dept-menu', 'title' => $record_dept[0]->name_2],
        ['route' => 'department-menu', 'title' => 'ប្រព័ន្ឋគ្រប់គ្រងលិខិតបញ្ជាក់'],
    ]" style="custom-style" />
    <x-module-center>
        @foreach ($record_certificate as $item)
            <x-module img="/asset/NTTI/images/modules/{{ $item->icon }}"
                url="/certificate/{{ $dept_code }}/{{ $item->route }}/{{ $item->code }}" title="{{ $item->name_kh }}" />
        @endforeach
    </x-module-center>
@endsection
