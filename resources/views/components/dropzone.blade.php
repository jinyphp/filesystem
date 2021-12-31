<form>
    @csrf
    <div {{ $attributes->merge(['class'=>"dropzone", 'id'=>"dropzone"]) }}>
        {{$slot}}
    </div>
</form>

<section class="progress-area"></section>
<ul class="uploaded-area"></ul>

@push('css')
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


        section .row{
            /* margin-bottom: 10px; */
            /* background: #E9F0FF; */
            list-style: none;
            padding: 5px 10px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        section .details span{
            font-size: 14px;
        }

        .progress-area .row .content{
            width: 100%;
            margin-left: 15px;
        }

        .progress-area .details{
            display: flex;
            align-items: center;
            margin-bottom: 7px;
            justify-content: space-between;
        }

        .progress-area .content .progress-bar{
            height: 6px;
            width: 100%;
            margin-bottom: 4px;
            background: #fff;
            border-radius: 30px;
        }

        .content .progress-bar .progress{
            height: 100%;
            width: 0%;
            background: #6990F2;
            border-radius: inherit;
        }

        .uploaded-area{
            max-height: 232px;
            overflow-y: scroll;
        }
        .uploaded-area.onprogress{
            max-height: 150px;
        }
        .uploaded-area::-webkit-scrollbar{
            width: 0px;
        }
        .uploaded-area .row .content{
            display: flex;
            align-items: center;
        }
        /*
        .uploaded-area .row .details{
            display: flex;
            margin-left: 15px;
            flex-direction: column;
        }
        */
        .uploaded-area .row .details .size{
            color: #404040;
            font-size: 11px;
        }

    </style>
@endpush

@push('scripts')
    <script>
        var path = "{!! $path !!}";
    </script>

    <script>
        var dropzone = document.getElementById('dropzone');
        var progressArea = document.querySelector(".progress-area");
        var uploadedArea = document.querySelector(".uploaded-area");

        let token = document.querySelector('input[name=_token]').value;



        function uploadFile(file) {
            var name = file.name;
            //console.log(name);

            let xhr = new XMLHttpRequest();
            //xhr.open("POST", "/upload.php");
            xhr.open("POST", "/api/upload/drop");

            let data = new FormData();
            data.append('file[]', file);
            data.append('_token', token);

            if (path) {
                data.append('path', path);
            }



            xhr.upload.addEventListener("progress", ({loaded, total}) =>{
                let fileLoaded = Math.floor((loaded / total) * 100);
                let fileTotal = Math.floor(total / 1000);
                let fileSize;
                (fileTotal < 1024) ? fileSize = fileTotal + " KB" : fileSize = (loaded / (1024*1024)).toFixed(2) + " MB";

                //console.log(fileLoaded);

                let progressHTML = `<div class="row">
                                        <div class="content">
                                            <div class="details">
                                                <span class="name">` + name + `</span>
                                                <span class="percent">` +  " : " +fileLoaded + `%</span>
                                            </div>
                                            <div class="progress-bar">
                                                <div class="progress" style="width: `+fileLoaded +`%"></div>
                                            </div>
                                        </div>
                                    </div>`;
                progressArea.innerHTML = progressHTML;

                uploadedArea.classList.add("onprogress");
                if(loaded == total){
                    progressArea.innerHTML = "";
                    let uploadedHTML = `<li>
                                            <span class="name">${name}</span>
                                            <span class="size"> / ${fileSize}</span>
                                        </li>`;
                    uploadedArea.classList.remove("onprogress");
                    uploadedArea.insertAdjacentHTML("afterbegin", uploadedHTML);
                }

            });

            xhr.onload = function() {
                var data = JSON.parse(this.responseText);
                console.log(data);
            }

            xhr.send(data);

        }


        dropzone.addEventListener('drop', function(e){
            e.preventDefault();
            e.target.classList.remove("dragover");
            // upload(e.dataTransfer.files);

            uploadedArea.innerHTML = "";

            var files = e.dataTransfer.files;
            for(let i=0; i < e.dataTransfer.files.length; i++) {
                //formData.append('file[]', files[i]);
                uploadFile(e.dataTransfer.files[i]);
            }
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
@endpush


