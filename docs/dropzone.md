# drag 를 통한 파일 업로드
HTML의 Drag 기능을 이용하여 복수의 파일을 업로드 가능합니다.
drag and upload 기능은 css와 javascript 코드를 같이 사용해야 합니다.
하지만 jinyPHP의 Filesystem 패키지는 dropzone 컴포넌트를 통하여 쉽게 파일을 drag 하여 업로드 
가능합니다.

## dropzone 영역 설정
drag 한 파일을 업로드 할 수 있도록 dropzone 영역을 설정합니다. blade 코드에서 x-dropzone 테그를 사용하빈다.

```php
<x-dropzone>
    Dropzone
</x-dropzone>
```
위의 코드만 삽입하면 드롭존이 생성됩니다. 해당 영역으로 파일을 drag 하면 `public/uploads` 폴더에 
파일이 업로드 됩니다.

## 업로드 경로지정
x-dropzone 테그 사용시 path 속성을 추가하면, 설정한 경로로 파일을 업로드 합니다.

```php
<x-dropzone class="p-4" path="public/images">
    Dropzone
</x-dropzone>
```

`public/images` 폴더에 파일이 업로드 됩니다.
