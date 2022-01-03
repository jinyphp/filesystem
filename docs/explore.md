# 파일 탐색기

## 파일탐색
지니 Filesystem은 손쉽게 서버의 파일목록을 확인하고 관리할 수 있는 Admin 기능을 지원합니다.
`/admin/file/explore`로 접속하면 `resource`폴더내의 파일목록을 출력합니다.

### 서브탐색
파일 탐색기는 지정한 경로내의 모든 파일과 폴더를 계층적으로 출력합니다. 만일, 특정 계층의 목록만을
출력하고자 하는 경우 추가 `/admin/file/explore`에 추가 경로를 덧붙여 주면 됩니다.

예를들면)
`/admin/file/explore/actions` 와 같이 입력하면, 기본 경로를 기준으로 `/actions` 폴더내의 목록만을
출력합니다.

> 지정폴더는 루트(base_path)를 기준으로 한다. 


## 사용자 파일 탐색
만일 사용자 파일 explore를 생성하고자 하는 경우 `FileExplore` 라이브와이어 컴포넌트를 삽입하면
됩니다. 탐색하고자 하는 파일의 경로를 `path` 인자값으로 전달하면 됩니다.

```php
{{-- Live 디렉터리를 출력합니다. --}}
@livewire('FileExplore', [
    'actions' => $actions,
    'path' => $path
])
```

> `actions`는 UI설정 및 권한등의 정보를 전달받은 인자값입니다.


## 다운로드
지니 탐색기는 등록된 파일을 다운로드 할 수 있는 `/download` 링크를 제공합니다.
`http:://~~/download/파일경로` 형태로 입력하면 파일을 다운로드 받을 수 있습니다.

> 다운로드는 `src/Http/Controllers/Download.php`을 사용합니다.


## 권한 설정
지니 탐색기는 파일 다운로드 권한을 부여합니다. explore 목록에서 `permit`를 선택하여
다운로드 허용을 선택합니다.
다운로드가 가능한 파일들은 별도의 `download` 데이터베이스 테이블에 기록하여 관리 합니다.


