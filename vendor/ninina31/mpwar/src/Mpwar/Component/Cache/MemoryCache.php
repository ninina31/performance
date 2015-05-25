<?php

namespace Mpwar\Component\Cache;
use Memcached;

class MemoryCache extends BaseCache
{

    private $memcached;

    function __construct()
    {
        $this->memcached = new Memcached();
        $this->memcached->addServer('localhost', 11211);
    }

    public function get($keyName)
    {
        return $this->memcached->get($keyName);
    }

    public function set($keyName, $value, $ttl = 10)
    {
        return $this->memcached->set($keyName, $value, $ttl);
    }

    public function delete($keyName)
    {
        return $this->memcached->delete($keyName);
    }
}
