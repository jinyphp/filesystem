{{-- 목록을 출력하기 위한 템플릿 --}}
<x-theme theme="admin.sidebar2">
    <x-theme-layout>

        <style>
            .json li {
                padding: 10px 0px 10px 10px;
                border-left-color: gray;
                border-left-width: 1px;
                margin-top: -1px;
                border-top-color: #cccccc;
                border-top-width: 1px;
                border-top-style: dashed;
            }
        </style>
        @livewire('JsonEdit', ['actions' => $actions])

        {{-- Admin Rule Setting --}}
        @include('jinytable::setActionRule')

    </x-theme-layout>
</x-theme>
