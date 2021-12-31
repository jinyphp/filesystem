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


        <div class="relative">
            <div class="absolute right-0 bottom-4">
                <div class="btn-group">
                    <x-button id="btn-livepopup-manual" secondary wire:click="$emit('popupManualOpen')">메뉴얼</x-button>
                    <x-button id="btn-livepopup-create" primary wire:click="$emit('popupFormOpen')">신규추가</x-button>
                </div>
            </div>
        </div>


        @push('scripts')
        <script>
            document.querySelector("#btn-livepopup-create").addEventListener("click",function(e){
                e.preventDefault();
                Livewire.emit('popupFormCreate');
            });

            document.querySelector("#btn-livepopup-manual").addEventListener("click",function(e){
                e.preventDefault();
                Livewire.emit('popupManualOpen');
            });
        </script>
        @endpush

        <!-- dropzone -->
        <style>
            .dropzone {
                width: 100%;
                height: 200px;
                border:2px dashed #ccc;
                color: #333;
                line-height: 200px;
                text-align: center;
            }

            .dropzone.dragover {
                border-color:#000;
                color:#000;
            }
        </style>
        <div id="uploads"></div>
        <div class="dropzone" id="dropzone">
            Dropzone
        </div>

        <script>
            //console.log("dropzone");

            var dropzone = document.getElementById('dropzone');

            var upload = function(files) {
                var formData = new FormData();

                for(let i=0; i < files.length; i++) {
                    formData.append('file[]', files[i]);
                }

                var xhr = new XMLHttpRequest();
                xhr.onload = function() {
                    var data = this.responseText;
                    console.log(data);
                }
                xhr.open('post', '/upload.php');
                xhr.send(formData);
            }

            dropzone.addEventListener('drop', function(e){
                e.preventDefault();
                e.target.classList.remove("dragover");
                upload(e.dataTransfer.files);
            });

            dropzone.addEventListener('dragover', function(e){
                e.preventDefault();
                e.target.classList.add("dragover");
            });

            dropzone.addEventListener('dragleave', function(e){
                e.preventDefault();
                e.target.classList.remove("dragover");
            });

        </script>


        <br><br>

        @livewire('WireTable', ['actions'=>$actions])

        @livewire('Popup-LiveForm', ['actions'=>$actions])

        @livewire('Popup-LiveManual')

        @livewire('ThemeInstall')


        {{-- Admin Rule Setting --}}
        @include('jinytable::setActionRule')

    </x-theme-layout>
</x-theme>
