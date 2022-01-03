<div>
    {{-- loading 화면 처리 --}}
    <x-loading-indicator/>

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

    <!-- 팝업 Rule 수정창 -->
    @if ($popupJson)
    <x-dialog-modal wire:model="popupJson" maxWidth="2xl">
        <x-slot name="content">
            <div class="p-2">
                {{$filename}}
            </div>
            <div class="json">
                {!! $treeForm !!}
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex justify-between">
                <div>
                </div>
                <div>
                    <x-button secondary wire:click="popupJsonClose">취소</x-button>
                    <x-button primary wire:click="jsonUpdate">수정</x-button>
                </div>
            </div>
        </x-slot>
    </x-dialog-modal>
    @endif

</div>
