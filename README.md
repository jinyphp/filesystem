# JINY filesystem
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

## 운영체제 확인 : type()


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

