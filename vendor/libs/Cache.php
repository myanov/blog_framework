<?php


namespace vendor\libs;


class Cache
{
    public function __construct()
    {
    }

    public function set($key, $data, $seconds = 3600)
    {
        $content['data'] = $data;
        $content['end_time'] = time() + $seconds;
        $file = ROOT . '/tmp/cache/' . md5($key) . '.txt';
        if(file_put_contents($file, serialize($content))) {
            return true;
        }
        return false;
    }

    public function get($key)
    {
        $file = ROOT . '/tmp/cache/' . md5($key) . '.txt';
        if(file_exists($file)) {
            $content = unserialize(file_get_contents($file));
            if(time() <= $content['end_time']) {
                return $content['data'];
            }
            unlink($file);
            return false;
        }
        return false;
    }

    public function delete($key)
    {
        $file = ROOT . '/tmp/cache/' . md5($key) . '.txt';
        if(file_exists($file)) {
            unlink($file);
        }
    }
}