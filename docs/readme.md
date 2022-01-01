①②③④⑤⑥⑦⑧⑨⑩⑪⑫⑬⑭⑮

## 1. 디렉터리 출력
지정한 폴더 부터 목록을 출력한다. 지정폴더는 루트(base_path)를 기준으로 한다. 
라이브와이어 컴포넌트를 이용하여 디렉터리를 출력합니다.

```php
{{-- Live 디렉터리를 출력합니다. --}}
@livewire('FileDirectory', [
    'actions' => $actions,
    'path' => '/public/images/themes'
])
```
* actions: 설정값
* path : base_path를 기준으로 경로값


## multi dropzone
폴더별로 파일을 업로드 할 수 있는 dropzone이 생성됩니다.


## 폴더만들기







3. 폴더 만들기

4. 파일 보기 및 수정 
