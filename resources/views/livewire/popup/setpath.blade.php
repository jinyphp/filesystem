<div>
    {{-- loading 화면 처리 --}}
    <x-loading-indicator/>

    <style>

    </style>

    <!-- 팝업 Rule 수정창 -->
    @if ($popupRule)
    <x-dialog-modal wire:model="popupRule" maxWidth="2xl">
        <x-slot name="content">
            <x-navtab class="mb-3 nav-bordered">

                <x-navtab-item><!-- Action 정보 -->
                    <x-navtab-link class="rounded-0">
                        <span class="d-none d-md-block">정보</span>
                    </x-navtab-link>

                    <fieldset>
                        <legend class="px-2 text-xs">Argument</legend>
                        <x-form-hor>
                            <x-form-label>타이틀</x-form-label>
                            <x-form-item>
                                {!! xInputText()
                                    ->setWire('model.defer',"form.title")
                                !!}
                            </x-form-item>
                        </x-form-hor>

                        <x-form-hor>
                            <x-form-label>서브타이틀</x-form-label>
                            <x-form-item>
                                {!! xTextarea()
                                    ->setWire('model.defer',"form.subtitle")
                                !!}
                            </x-form-item>
                        </x-form-hor>
                    </fieldset>

                    <fieldset>
                        <legend class="px-2 text-xs">Blade Resource</legend>

                        <x-form-hor>
                            <x-form-label>View_title </x-form-label>
                            <x-form-item>
                                {!! xCheckbox()
                                    ->setWire('model.defer',"form.view_title_check")
                                !!}

                                {!! xInputText()
                                    ->setWire('model.defer',"form.view_title")
                                    ->setWidth("standard")
                                !!}
                            </x-form-item>
                        </x-form-hor>

                    </fieldset>


                </x-navtab-item>


                <x-navtab-item class="show active"><!-- formTab -->
                    <x-navtab-link class="rounded-0 active">
                        <span class="d-none d-md-block">목록</span>
                    </x-navtab-link>

                    <fieldset>
                        <legend class="px-2 text-xs">Blade Resource</legend>

                        <x-form-hor>
                            <x-form-label>view_main</x-form-label>
                            <x-form-item>
                                {!! xInputText()
                                    ->setWire('model.defer',"form.view_main")
                                    ->setWidth("standard")
                                !!}

                            </x-form-item>
                        </x-form-hor>

                        <x-form-hor>
                            <x-form-label>view_main layout</x-form-label>
                            <x-form-item>
                                {!! xInputText()
                                    ->setWire('model.defer',"form.view_main_layout")
                                    ->setWidth("standard")
                                !!}

                            </x-form-item>
                        </x-form-hor>

                        <x-form-hor>
                            <x-form-label>view_filter</x-form-label>
                            <x-form-item>
                                {!! xInputText()
                                    ->setWire('model.defer',"form.view_filter")
                                    ->setWidth("standard")
                                !!}
                            </x-form-item>
                        </x-form-hor>

                        <x-form-hor>
                            <x-form-label>view_list</x-form-label>
                            <x-form-item>
                                {!! xInputText()
                                    ->setWire('model.defer',"form.view_list")
                                    ->setWidth("standard")
                                !!}
                            </x-form-item>
                        </x-form-hor>

                    </fieldset>
                </x-navtab-item>

                <x-navtab-item ><!-- formTab -->
                    <x-navtab-link class="rounded-0">
                        <span class="d-none d-md-block">입력폼</span>
                    </x-navtab-link>

                    <x-form-hor>
                        <x-form-label>view_form</x-form-label>
                        <x-form-item>
                            {!! xInputText()
                                ->setWire('model.defer',"form.view_form")
                                ->setWidth("standard")
                            !!}
                        </x-form-item>
                    </x-form-hor>

                    <x-form-hor>
                        <x-form-label>view_edit</x-form-label>
                        <x-form-item>
                            {!! xInputText()
                                ->setWire('model.defer',"form.view_edit")
                                ->setWidth("standard")
                            !!}
                        </x-form-item>
                    </x-form-hor>
                </x-navtab-item>




                <x-navtab-item ><!-- formTab -->
                    <x-navtab-link class="rounded-0">
                        <span class="d-none d-md-block">파일관리</span>
                    </x-navtab-link>

                    <x-form-hor>
                        <x-form-label>경로</x-form-label>
                        <x-form-item>
                            {!! xInputText()
                                ->setWire('model.defer',"form.path")
                            !!}
                        </x-form-item>
                    </x-form-hor>
                </x-navtab-item>




                <x-navtab-item >
                    <x-navtab-link class="rounded-0">
                        <span class="d-none d-md-block">메뉴</span>
                    </x-navtab-link>

                    <x-form-hor>
                        <x-form-label>메뉴</x-form-label>
                        <x-form-item>
                            {{-- xInputText()
                                ->setWire('model.defer',"form.menu")
                            --}}

                            {!! xSelect()
                                ->table('menus','code')
                                ->setWire('model.defer',"form.menu")
                                ->setWidth("medium")
                            !!}
                        </x-form-item>
                    </x-form-hor>

                </x-navtab-item>

                <x-navtab-item ><!-- formTab -->
                    <x-navtab-link class="rounded-0">
                        <span class="d-none d-md-block">권환</span>
                    </x-navtab-link>

                    <x-form-hor>
                        <x-form-label>Role</x-form-label>
                        <x-form-item>
                            {!! xCheckbox()
                                ->setWire('model.defer',"form.role")
                            !!}
                            <div>사용자 Role권한을 적용합니다.</div>
                        </x-form-item>
                    </x-form-hor>

                    {{-- role 테이블 선택--}}
                    @php
                        $roles = DB::table("roles")->get();
                    @endphp
                    <table class="table">
                        <thead>
                            <tr>
                                <th >Name</th>
                                <th width='100'>Permit</th>
                                <th width='100'>Create</th>
                                <th width='100'>Read</th>
                                <th width='100'>Update</th>
                                <th width='100'>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $item)
                            <tr >
                                <td>{{$item->name}}</td>
                                <td width='100'>
                                    {!! xCheckbox()
                                        ->setWire('model.defer',"form.roles.".$item->name.".permit")
                                    !!}
                                </td>
                                <td width='100'>
                                    {!! xCheckbox()
                                        ->setWire('model.defer',"form.roles.".$item->name.".create")
                                    !!}
                                </td>
                                <td width='100'>
                                    {!! xCheckbox()
                                        ->setWire('model.defer',"form.roles.".$item->name.".read")
                                    !!}
                                </td>
                                <td width='100'>
                                    {!! xCheckbox()
                                        ->setWire('model.defer',"form.roles.".$item->name.".update")
                                    !!}
                                </td>
                                <td width='100'>
                                    {!! xCheckbox()
                                        ->setWire('model.defer',"form.roles.".$item->name.".delete")
                                    !!}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </x-navtab-item>

                <x-navtab-item ><!-- formTab -->
                    <x-navtab-link class="rounded-0">
                        <span class="d-none d-md-block">메모</span>
                    </x-navtab-link>

                    <x-form-hor>
                        <x-form-label>메모</x-form-label>
                        <x-form-item>
                            {!! xTextarea()
                                ->setWire('model.defer',"form.description")
                            !!}
                        </x-form-item>
                    </x-form-hor>
                </x-navtab-item>

            </x-navtab>
        </x-slot>

        <x-slot name="footer">
            <div class="flex justify-between">
            @if (isset($actions['id']))
                <div>
                </div>
                <div>
                    <x-button secondary wire:click="popupRuleClose">취소</x-button>
                    <x-button primary wire:click="update">수정</x-button>
                </div>
            @else
                <div></div>
                <div class="text-right">
                    <x-button secondary wire:click="popupRuleClose">취소</x-button>
                    <x-button primary wire:click="save">저장</x-button>
                </div>
            @endif
            </div>
        </x-slot>
    </x-dialog-modal>
    @endif


    @if ($popupResourceEdit)
    <x-dialog-modal wire:model="popupResourceEdit" maxWidth="2xl">
        <x-slot name="content">
            {!! xTextarea()
                ->setWire('model.defer',"content")
            !!}
        </x-slot>

        <x-slot name="footer">
            <div class="flex justify-between">
                <div></div>
                <div class="text-right">
                    <x-button secondary wire:click="returnRule">취소</x-button>
                    <x-button primary wire:click="update">수정</x-button>
                </div>
            </div>
        </x-slot>
    </x-dialog-modal>
    @endif

</div>
