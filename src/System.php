<?php
/*
 * This file is part of the jinyphp package.
 *
 * (c) hojinlee <infohojin@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Jiny\Filesystem;

/**
 * 싱글톤
 */
class System
{
    const DS = DIRECTORY_SEPARATOR;
    const PS = PATH_SEPARATOR;

    public static $instance;

    private function __construct()
    {
        // 싱글턴
    }

    private function __clone()
    {
        // 싱글턴
    }

    /**
     * 인스턴스 생성
     */
    public static function init($path=null)
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * 운영체제 타입확인
     */
    public function type()
    {
        if ( self::DS == "/" ) {
            return "linux";
        } else {
            return "windows";
        }
    }

    // -----
    // 경로
    // -----

    /**
     * 경로를 출력합니다.
     */
    public function path($path)
    {
        return pathinfo($path)['dirname'];
    }

    /**
     * 현재위치에서, 입력한 경로를 추가합니다.
     */
    public function path_real($path)
    {
        $p= $this->path_add(getcwd(), $path);
        return $this->path($p);
    }

    /**
     * 경로 결합
     */
    public function path_add($base, $path)
    {
        $base = str_replace("/", self::DS, $base);
        $base = rtrim($base, self::DS);
        $base = explode(self::DS, $base);

        $path = str_replace("/", self::DS, $path);
        $path = rtrim($path, self::DS);
        $path = explode(self::DS, $path);

        $j = count($base)-1;
        for ($i=0; $i<count($path); $i++) {
            if ($path[$i] && $path[$i] !== ".") {
                if($path[$i] == "..") {
                    unset($path[$i]);
                    unset($base[$j--]);
                }
            } else {
                unset($path[$i]);
            }
        }

        $arr = \array_merge($base, $path);
        $string = "";
        foreach($arr as $value) {
            $string .=  $value.self::DS;
        }

        return rtrim($string, self::DS);
    }

    // -----
    // 디렉토리
    // -----

    /**
     * 디렉토리 확인합니다.
     */
    public function is_dir($path)
    {
        return is_dir($path);
    }

    /**
     * 디렉토리 생성
     */
    public function mkdir($path, $mode=777)
    {
        return mkdir($path, $mode);
    }

    /**
     * 서브디렉토리 생성
     */
    public function mkdir_sub($path, $mode=777)
    {
        return mkdir($path, $mode, true);
    }

    /**
     * 디렉토리 삭제
     */
    public function rmdir($path)
    {
        if (is_dir($path)) {
            return rmdir($path);
        }
    }

    /**
     * 서브 디렉토리까지 삭제
     */
    public function rmdir_all($path)
    {
        if (is_dir($path)) {
            $arr = scandir($path);
            foreach ($arr as $dir) {
                if ($dir == "." || $dir == "..") {
                    continue;
                }

                if (is_dir($path.self::DS.$dir)) {
                    $this->rmdir_all($path.self::DS.$dir);
                } else {
                    unlink($dir);
                }
            }

            return rmdir($path);
        }
    }

    /**
     * 디렉토리 이름을 변경합니다.
     */
    public function rename($old, $new)
    {
        return rename($old, $new);
    }

    /**
     * 디렉토리 목록을 반환합니다.
     */
    public function scandir($path)
    {
        $arr = scandir($path);

        unset($arr[0]); // .
        unset($arr[1]); // ..

        return $arr;
    }

    // -----
    // 파일
    // -----

    /**
     * 파일을 삭제합니다.
     */
    public function delete($path)
    {
        return unlink($path);
    }

    /**
     * 파일의 확장자를 반환합니다.
     */
    public function file_extension($path)
    {
        return pathinfo($path)['extension'];
    }

    /**
     * 파일의 이름을 반환합니다.
     */
    public function file_name($path)
    {
        return pathinfo($path)['filename'];
    }


    /**
     * 심볼 링크를 생성합니다.
     */
    public function symlink($src, $dst)
    {
        // 리눅스 운영체제 일경우에만 동작을 처리합니다.
        if ( DIRECTORY_SEPARATOR == "/" ) {
            return symlink($src, $dst);
        }
    }

    /**
     * 파일을 읽어 옵니다.
     */
    public function read($filename)
    {
        if (file_exists($filename)) {
            return \file_get_contents($filename);
        }
    }

    /**
     * 배열(줄단위) 읽기
     */
    public function read_lines($filename)
    {
        if (file_exists($filename)) {
            $fp = fopen($filename,"r");
            $content = [];
            if (is_resource($fp)) {
                while (($buffer = fgets($fp, 4096)) !== false) {
                    $content []= $buffer;
                }
            }
            fclose($fp);
            return $content;
        }
    }

    /**
     * 파일을 저장합니다.
     */
    public function save($filename, $content, $mode="w")
    {
        // 파일이 존재하는 경우
        if (file_exists($filename)) {
            if (is_writable($filename)) {
                $fp = fopen($filename, $mode);
                if (is_resource($fp)) {
                    flock($fp, LOCK_EX);    // 잠금

                    $size = fwrite($fp, $content);

                    fflush($fp);
                    flock($fp, LOCK_UN);    // 잠금해제

                    return $size;
                }
                fclose($fp);
            }
        }
        // 새파일 저장
        else {
            return \file_put_contents($filename, $content);
        }
    }

    /**
     * 파일을 복사합니다.
     */
    public function copy($src, $dst)
    {
        return copy($src, $dst);
    }

    /**
     * 파일 시간갱신 여부확인
     */
    public function isUpadate($filename)
    {

        if (file_exists($filename)) {
            $mtime = \filemtime($filename);
            $atime = \fileatime($filename);

            echo "수정일자 = ".$mtime."\n";
            echo "접근일자 = ".$atime."\n";
            echo "$filename was last edit    : " . date("F d Y H:i:s.", $mtime)."\n";
            echo "$filename was last accessed: " . date("F d Y H:i:s.", $atime);

            echo "\n";
            if(\filemtime($filename) >= \fileatime($filename)) {
                return true;
            } else {
                return false;
            }
        } else {
            return -1;
        }

    }

    /**
     *
     */
}
