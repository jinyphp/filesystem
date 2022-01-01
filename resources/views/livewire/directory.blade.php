<div>
    <style>
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

    {{$path}}
    <div class="directory">
        {!! $directory !!}
    </div>

    {{-- 선택삭제 --}}
    @if ($popupForm)
    <x-dialog-modal wire:model="popupForm" maxWidth="xl">

        <x-slot name="content">
            {!! xInputText()
                ->setWire('model.defer',"form")
            !!}
        </x-slot>

        <x-slot name="footer">
            <x-flex-between>
                <div></div>
                <div>
                    <x-button secondary wire:click="popupFormClose">취소</x-button>
                    <x-button primary wire:click="store">생성</x-button>
                </div>
            </x-flex-between>
        </x-slot>
    </x-dialog-modal>
    @endif

    {{-- 선택삭제 --}}
    @if ($popupDelete)
    <x-dialog-modal wire:model="popupDelete" maxWidth="xl">

        <x-slot name="content">
            <p class="p-8">정말로 삭제할까요?</p>

            {{--
            @foreach ($selected as $item)
                {{$item}}
            @endforeach
            --}}

        </x-slot>

        <x-slot name="footer">
            <x-button secondary wire:click="popupDeleteClose">취소</x-button>
            <x-button danger wire:click="condfirmDelete">삭제</x-button>
        </x-slot>
    </x-dialog-modal>
    @endif

    {{-- 퍼미션 알람--}}
    @include("jinytable::error.popup.permit")
</div>
