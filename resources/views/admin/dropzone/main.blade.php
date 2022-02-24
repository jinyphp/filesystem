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
            <x-card-header>
                path : public/images
            </x-card-header>
            <x-card-body>
                <!-- dropzone -->
                <x-dropzone path="public/images">
                    Dropzone
                </x-dropzone>
            </x-card-body>
        </x-card>



        {{-- Admin Rule Setting --}}
        @include('jinytable::setActionRule')

    </x-theme-layout>
</x-theme>
