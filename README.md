# JINY filesystem



## 운영체제 확인
php 슈퍼상수 `DIRECTORY_SEPARATOR`를 이용한, OS를 확인합니다.

```php
File::os()
```
반환값으로 `windows` 또는 `linux` 문자열을 출력합니다.

## 디렉토리
디렉토리와 관련된 메소드를 지원합니다.

### isDir
입력된 디렉토리의 존재를 확인합니다.

```php
File::isDir( $경로 )
```

```php
File::isDirMake($path)
```
입력된 경로를 조사합니다. 존재하지 않는 디렉토리 경로일 경우 새롭게 생성을 합니다.


### 디렉토리 생성
디렉토리를 생성할 수 있습니다.

```php
File::mkDir( $경로 )
```
입력한 경로의 디렉토리를 생성합니다.

```php
File::isMkdir( $경로 )
```
디렉토리의 존재를 미리 확인후에, 없으면 새로운 디렉토리를 생성합니다.

```php
File::mkdirRescure($경로)
```
입력된 서브 디렉토리를 같이 생성을 합니다. 



## 경로
경로처리와 관련된 메소드를 지원합니다.

### current
현재의 경로를 출력합니다.

```php
File::current()
```
current는 `getcwd()`의 alias 입니다. php의 내부 `getcwd()`의 결과값을 반환합니다.


### 경로추출
입력된 경로에서 디렉토리 부분만을 추출합니다.
```php
File::pathDir($path)
```

### 기본 경로
입력한 경로에서 기본 경로를 제외한 상대 경로를 출력합니다.
```php
File::basePath($path, $base = null)
```

### 경로 파일
경로에서 주어진 파일을 추출합니다.
```php
File::pathFile($path)
```

### 경로 파일명
입력된 경로에서 파일명을 추출합니다.

```php
File::pathFilename($path);
```



### 경로 파일 확장자
입력된 경로에서 파일의 확장자를 추출합니다.

```php
File::pathExtension($path)
```


















---
지니 파일처리 라이브러리는 `싱글턴`방식의 클래스로 구성되어 있습니다.

## 인스턴스 얻기
먼저 객체의 인스턴스를 얻어 매소드를 호출할 수 있습니다. 기본적으로 클래스의 인스턴스를 얻기 위해서는 `new`를 사용을
해야 하지만, 매번 호출시 중복 생성되는 인스턴스 메모리를 방지하기 위해서 `싱글턴`방식으로 제작이 되었습니다.

파일시스템의 인스턴스를 얻는 방법은 
```php
$d = \Jiny\Filesystem\File::init();
```
와 같이 정적 팩토리 메소드를 호출하는 것입니다.




## path($path)

## path_real($path)


## path_add($base, $path)

## is_dir($path)

## mkdir($path, $mode=777)

## mkdir_sub($path, $mode=777)

## rmdir($path)

## rmdir_all($path)

## rename($old, $new)

## scandir($path)

## delete($path)

## file_extension($path)

## file_name($path)

## symlink($src, $dst)

## read($filename)

## read_lines($filename)


## save($filename, $content, $mode="w")


## copy($src, $dst)


## isUpadate($filename)

