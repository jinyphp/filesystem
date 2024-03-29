{{-- 목록을 출력하기 위한 템플릿 --}}
<x-theme theme="admin.sidebar2">
    <x-theme-layout>
        <!-- start page title -->
        @if (isset($actions['view_title']) && !empty($actions['view_title']))
            @includeIf($actions['view_title'])
        @else
            @include("jinytable::title")
        @endif
        <!-- end page title -->

        <style>
            .directory ul {
                padding-left: 15px;
            }

            .directory li {
                padding: 10px 0px 0px 10px;
                border-left-color: gray;
                border-left-width: 1px;
                margin-top: -1px;
                border-top-color: #cccccc;
                border-top-width: 1px;
                border-top-style: dashed;
            }
        </style>

        <x-card>
            <x-card-body>
                @php
                    if(isset($actions['path'])) {
                        $path = $actions['path'];
                    } else {
                        $path = "/resources";
                    }
                @endphp
                {{-- Live 디렉터리를 출력합니다. --}}
                @livewire('FileExplore', [
                    'actions' => $actions,
                    'path' => $path
                ])
            </x-card-body>
        </x-card>

        <!-- dropzone -->

        @include("jinyfile::script.drop")

        {{-- Admin Rule Setting --}}
        @include('jinyfile::setActionRule')

        {{-- 파일정보 수정 --}}
        @livewire('popupJson', ['actions' => $actions])



    </x-theme-layout>
</x-theme>
