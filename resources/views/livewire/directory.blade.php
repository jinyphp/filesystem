<div>
    {!! (new \Jiny\Html\CTag('a',true))
        ->addItem(
            xSpan(
                xIcon("folder-plus")->setType("bootstrap")->setClass("h-4 w-4 inline-block")
            )
            ->addClass("px-2")
        )
        ->setAttribute("wire:click","create('".str_replace("\\","/",$path)."')") !!}
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
                <div>
                    @if($mode == "edit")
                        <x-button danger wire:click="editDelete">삭제</x-button>
                    @endif
                </div>
                <div>
                    @if($mode == "create")
                        <x-button secondary wire:click="popupFormClose">취소</x-button>
                        <x-button primary wire:click="store">생성</x-button>
                    @endif

                    @if($mode == "edit")
                        <x-button secondary wire:click="popupFormClose">취소</x-button>
                        <x-button success wire:click="update">수정</x-button>
                    @endif
                </div>
            </x-flex-between>
        </x-slot>
    </x-dialog-modal>
    @endif

    {{-- 선택삭제 --}}
    @if ($popupDelete)
    <x-dialog-modal wire:model="popupDelete" maxWidth="xl">

        <x-slot name="content">
            <p class="p-8"> {{$filepath}} 정말로 삭제할까요?</p>

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

    {{-- 선택삭제 --}}
    @if ($popupPermitSet)
    <x-dialog-modal wire:model="popupPermitSet" maxWidth="xl">

        <x-slot name="content">
            <x-navtab class="mb-3 nav-bordered">

                <!-- formTab -->
                <x-navtab-item class="show active" >

                    <x-navtab-link class="rounded-0 active">
                        <span class="d-none d-md-block">권환설정</span>
                    </x-navtab-link>

                    <x-form-hor>
                        <x-form-label>파일명</x-form-label>
                        <x-form-item>
                            {{ $this->permitForm['path'] }}
                        </x-form-item>
                    </x-form-hor>

                    <x-form-hor>
                        <x-form-label>다운로드 허용</x-form-label>
                        <x-form-item>
                            {!! xCheckbox()
                                ->setWire('model.defer',"permitForm.permit")
                            !!}
                        </x-form-item>
                    </x-form-hor>



                </x-navtab-item>
            </x-navtab>

        </x-slot>

        <x-slot name="footer">
            <x-button secondary wire:click="popupPermitSetClose">취소</x-button>
            <x-button primary wire:click="setPermited">설정</x-button>
        </x-slot>
    </x-dialog-modal>
    @endif

    <script>
        window.addEventListener('dropzone', event => {
            //alert('Name updated to: ');
            setDropzone();
        })
    </script>

</div>

