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



        <x-card>
            <x-card-body>
                {{-- Live 디렉터리를 출력합니다. --}}
                @livewire('FileManager', [
                    'actions' => $actions,
                    'path' => '/public/images/themes'
                ])
            </x-card-body>
        </x-card>

        <!-- dropzone -->

        @include("jinyfile::script.drop")


        {{-- Admin Rule Setting --}}
        @include('jinytable::setActionRule')

    </x-theme-layout>
</x-theme>
