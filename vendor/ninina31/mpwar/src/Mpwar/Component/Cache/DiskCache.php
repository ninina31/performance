<?php 

namespace Mpwar\Component\Cache;

class DiskCache extends BaseCache
{

  const CACHE_PATH = '/tmp/cachedisk';

  public function get ($key){

    if( file_exists(self::CACHE_PATH . $key)){
      return file_get_contents(self::CACHE_PATH . $key);
    }

    return false;

  }

  public function set ($key, $content, $expiration){

    if (!file_exists(self::CACHE_PATH . $key)) {
      mkdir(self::CACHE_PATH);
    }

    file_put_contents(self::CACHE_PATH . $key, $content);
  }

  public function delete ($key){

    unlink(self::CACHE_PATH . $key);
  }

}
