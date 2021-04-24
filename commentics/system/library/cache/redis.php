<?php
namespace Commentics;

class Redis
{
    private $time;
    private $host;
    private $port;
    private $redis;
    private $status = false;

    public function __construct($settings)
    {
        $this->time = $settings['time'];
        $this->host = $settings['host'];
        $this->port = $settings['port'];

        if (class_exists('Redis')) {
            $redis = new \Redis();

            $connected = true;

            try {
                if ($this->port) {
                    @$redis->connect($this->host, $this->port);
                } else {
                    @$redis->connect($this->host);
                }
            } catch (\Exception $e) {
                $connected = false;
            }

            if ($connected) {
                $this->status = true;

                $this->redis = $redis;
            }
        }
    }

    public function get($key) {
        if ($this->status) {
            $result = $this->redis->get('cmtx_' . $key);

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

            $status = $this->redis->set('cmtx_' . $key, $value);

            if ($status) {
                $this->redis->expire('cmtx_' . $key, $this->time);
            }
        }
    }

    public function delete($key) {
        if ($this->status) {
            $this->redis->delete('cmtx_' . $key);
        }
    }

    public function flush() {
        if ($this->status) {
            $keys = $this->redis->keys('cmtx_*');

            foreach ($keys as $key) {
                $this->redis->delete($key);
            }
        }
    }

    public function getStatus() {
        return $this->status;
    }
}
