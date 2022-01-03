<div>
    <x-card>
        <x-card-header>
            {{$filename}}
        </x-card-header>
        <x-card-body>
            @if(!empty($form))
                <div class="json">
                    {!! $treeForm !!}
                </div>
                <x-button primary wire:click="jsonUpdate">수정</x-button>
            @else
                <div>
                    파일이 없습니다.
                </div>
            @endif
        </x-card-body>
    </x-card>
</div>
