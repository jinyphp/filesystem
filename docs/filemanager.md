# 파일메니져

서버내 파일을 관리자 페이지를 통하여 관리합니다.

`localhost:8000/admin/file` 로 접속하면 파일들의 목록을 출력합니다.

만일 서브 폴더로 직접 들어 가고 싶다면 `localhost:8000/admin/file/서브폴더`를
url로 지정을 하면 됩니다.

서버 관리자에서 지정한 root 기준은 라이브디렉터리에서 설정한 기준 폴더 경로 입니다.


```php
{{-- Live 디렉터리를 출력합니다. --}}
@livewire('FileManager', [
    'actions' => $actions,
    'path' => '/public/images/themes'
])
```

## 퍼미션 설정
등록된 파일은 `/download` uri를 통하여 다운로드 가능합니다.
만일 특정 파일의 다운로드를 허용/불허 하고 싶다면 permit 를 선택합니다.

permit는 DB와 연동되어 권환을 체크합니다.
또한 다운로드시 count를 추가합니다.
