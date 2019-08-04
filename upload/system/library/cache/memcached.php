<?php
namespace Commentics;

class Memcached
{
    private $time;
    private $host;
    private $port;
    private $memcached;
    private $status = false;

    public function __construct($settings)
    {
        $this->time = $settings['time'];
        $this->host = $settings['host'];
        $this->port = $settings['port'];

        if (class_exists('Memcached')) {
            $memcached = new \Memcached();

            $connected = @$memcached->addServer($this->host, $this->port);

            if ($connected) {
                $this->status = true;

                $this->memcached = $memcached;
            }
        }
    }

    public function get($key) {
        if ($this->status) {
            $result = $this->memcached->get('cmtx_' . $key);

            $result = json_decode($result, true);

            if (is_null($result)) {
                $result = false;
            }
        } else {
            $result = false;
        }

        return $result;
    }

    public function set($key, $value) {
        if ($this->status) {
            $value = json_encode($value);

            $this->memcached->set('cmtx_' . $key, $value, $this->time);
        }
    }

    public function delete($key) {
        if ($this->status) {
            $this->memcached->delete('cmtx_' . $key);
        }
    }

    public function flush() {
        if ($this->status) {
            $keys = $this->memcached->getAllKeys();

            if (is_array($keys)) {
                foreach ($keys as $key) {
                    if (strpos($key, 'cmtx_') === 0) {
                        $this->memcached->delete($key);
                    }
                }
            }
        }
    }

    public function getStatus() {
        return $this->status;
    }
}
