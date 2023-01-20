<?php
namespace Utilities;
class Cache {
    protected $memcached;

    public function __construct() {
        $this->memcached = new Memcached();
        $this->memcached->addServer('localhost', 11211);
    }

    public function get($key) {
        return $this->memcached->get($key);
    }

    public function set($key, $value, $expiration = 3600) {
        $this->memcached->set($key, $value, $expiration);
    }
}
