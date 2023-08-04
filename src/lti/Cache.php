<?php

namespace IMSGlobal\LTI;

class Cache
{

    private $cache;

    public function get_launch_data($key)
    {
        $this->load_cache();
        return $this->cache[$key];
    }

    private function load_cache()
    {
        $cache = file_get_contents(sys_get_temp_dir().'/lti_cache.txt');
        if (empty($cache)) {
            file_put_contents(sys_get_temp_dir().'/lti_cache.txt', '{}');
            $this->cache = [];
        }
        $this->cache = json_decode($cache, true);
    }

    public function cache_launch_data($key, $jwt_body)
    {
        $this->cache[$key] = $jwt_body;
        $this->save_cache();
        return $this;
    }

    private function save_cache()
    {
        file_put_contents(sys_get_temp_dir().'/lti_cache.txt', json_encode($this->cache));
    }

    public function cache_nonce($nonce)
    {
        $this->cache['nonce'][$nonce] = true;
        $this->save_cache();
        return $this;
    }

    public function check_nonce($nonce)
    {
        $this->load_cache();
        if (!isset($this->cache['nonce'][$nonce])) {
            return false;
        }
        return true;
    }
}

?>