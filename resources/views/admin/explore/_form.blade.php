<div>

    <x-navtab class="mb-3 nav-bordered">

        <!-- formTab -->
        <x-navtab-item class="show active" >

            <x-navtab-link class="rounded-0 active">
                <span class="d-none d-md-block">기본정보</span>
            </x-navtab-link>

            <x-form-hor>
                <x-form-label>활성화</x-form-label>
                <x-form-item>
                    {!! xCheckbox()
                        ->setWire('model.defer',"form.enable")
                    !!}
                </x-form-item>
            </x-form-hor>

            <x-form-hor>
                <x-form-label>제목</x-form-label>
                <x-form-item>
                    {!! xInputText()
                        ->setWire('model.defer',"form.title")
                        ->setWidth("standard")
                    !!}
                </x-form-item>
            </x-form-hor>

            <x-form-hor>
                <x-form-label>부제목</x-form-label>
                <x-form-item>
                    {!! xTextarea()
                        ->setWire('model.defer',"form.subtitle")
                    !!}
                </x-form-item>
            </x-form-hor>

            <x-form-hor>
                <x-form-label>작성자</x-form-label>
                <x-form-item>
                    {!! xInputText()
                        ->setWire('model.defer',"form.author")
                        ->setWidth("standard")
                    !!}
                </x-form-item>
            </x-form-hor>

            <x-form-hor>
                <x-form-label>이메일</x-form-label>
                <x-form-item>
                    {!! xInputText()
                        ->setWire('model.defer',"form.email")
                        ->setWidth("standard")
                    !!}
                </x-form-item>
            </x-form-hor>

            <x-form-hor>
                <x-form-label>내용</x-form-label>
                <x-form-item>
                    {!! xTextarea()
                        ->setWire('model.defer',"form.content")

                    !!}
                </x-form-item>
            </x-form-hor>

        </x-navtab-item>


        <!-- formTab -->
        <x-navtab-item >
            <x-navtab-link class="rounded-0">
                <span class="d-none d-md-block">다운로드</span>
            </x-navtab-link>

            <x-form-hor>
                <x-form-label>code</x-form-label>
                <x-form-item>
                    {!! xInputText()
                        ->setWire('model.defer',"form.code")
                        ->setWidth("standard")
                    !!}
                </x-form-item>
            </x-form-hor>

            <x-form-hor>
                <x-form-label>Vendor</x-form-label>
                <x-form-item>
                    {!! xInputText()
                        ->setWire('model.defer',"form.vendor")
                        ->setWidth("standard")
                    !!}
                </x-form-item>
            </x-form-hor>

            <x-form-hor>
                <x-form-label>테마명</x-form-label>
                <x-form-item>
                    {!! xInputText()
                        ->setWire('model.defer',"form.name")
                        ->setWidth("standard")
                    !!}
                </x-form-item>
            </x-form-hor>

            <x-form-hor>
                <x-form-label>Download Url</x-form-label>
                <x-form-item>
                    {!! xInputText()
                        ->setWire('model.defer',"form.url")
                        ->setWidth("standard")
                    !!}
                </x-form-item>
            </x-form-hor>

            <x-form-hor>
                <x-form-label>이미지</x-form-label>
                <x-form-item>
                    {{-- preload image--}}
                    @if(isset($form['image']))
                        @if (is_object($form['image']))
                            <!-- 업로드 미리보기 -->
                            <img src="{{$form['image']->temporaryUrl()}}" alt="">
                        @else
                            <!-- 저장된 이미지 보기 -->
                            <img src="/images/{{$form['image']}}" alt="">
                        @endif
                    @endif

                    <div
                        x-data="{ isUploading: false, progress: 0 }"
                        x-on:livewire-upload-start="isUploading = true"
                        x-on:livewire-upload-finish="isUploading = false"
                        x-on:livewire-upload-error="isUploading = false"
                        x-on:livewire-upload-progress="progress = $event.detail.progress"
                    >
                        <!-- File Input -->
                        <input type="file" name="filename" wire:model.defer="form.image" class="form-control"/>

                        <!-- Progress Bar -->
                        <div x-show="isUploading">
                            <progress max="100" x-bind:value="progress"></progress>
                        </div>
                    </div>

                    @error('filename') <span class="text-danger">{{$message}}</span> @enderror
                    {{--
                    <button wire:click="fileUpload" class="btn btn-success flot-right">Upload</button>
                    --}}
                </x-form-item>
            </x-form-hor>

            <x-form-hor>
                <x-form-label>version</x-form-label>
                <x-form-item>
                    {!! xInputText()
                        ->setWire('model.defer',"form.version")
                        ->setWidth("standard")
                    !!}
                </x-form-item>
            </x-form-hor>

            <x-form-hor>
                <x-form-label>css</x-form-label>
                <x-form-item>
                    {!! xInputText()
                        ->setWire('model.defer',"form.css")
                        ->setWidth("standard")
                    !!}
                </x-form-item>
            </x-form-hor>

        </x-navtab-item>


        <!-- formTab -->
        <x-navtab-item >
            <x-navtab-link class="rounded-0">
                <span class="d-none d-md-block">기타정보</span>
            </x-navtab-link>

            <x-form-hor>
                <x-form-label>카테고리</x-form-label>
                <x-form-item>
                    {!! xInputText()
                        ->setWire('model.defer',"form.category")
                        ->setWidth("standard")
                    !!}
                </x-form-item>
            </x-form-hor>

            <x-form-hor>
                <x-form-label>가격</x-form-label>
                <x-form-item>
                    {!! xInputText()
                        ->setWire('model.defer',"form.price")
                        ->setWidth("standard")
                    !!}
                </x-form-item>
            </x-form-hor>

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

</div>
