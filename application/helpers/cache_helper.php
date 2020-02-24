<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

    function getCache($name = '') {
       $ci      = & get_instance();
       $return  = array();
       if ($name != '') {
           $ci->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
           $return = $ci->cache->get($name);
       }
       return $return;
    }

    function saveCache($name = '', $value = array(), $setTimeout = 7200) {
       $ci      = & get_instance();
       $return  = false;
       if ($name != '' && !empty($value)) {
           $ci->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
           $ci->cache->save($name, $value, $setTimeout);
           $return = true;
       }
       return $return;
    }

    function updateCache($name = '', $value = array(), $setTimeout = 7200) {
       $ci      = & get_instance();
       $return  = false;
       if ($name != '' && !empty($value)) {
           $ci->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
           $oldValue    = getCache($name);
           $oldValue[]  = $value;
           $ci->cache->save($name, $oldValue, $setTimeout);
           $return = true;
       }
       return $return;
    }

    function cleanCache() {
       $ci = & get_instance();
       $ci->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
       $return = $ci->cache->clean();
       return $return;
    }
 
    function deleteCache($name = '') {
      $ci = & get_instance();
      $ci->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
      $return = $ci->cache->delete($name);
      return $return;
    }

    function deleteCacheSingalItem($name = '', $refId = 0) {
        if ($name != '' && $refId > 0) {
            $ci = & get_instance();
            $ci->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
            $oldValue    = getCache($name);
            if (!empty($oldValue)) {
                foreach ($oldValue as $keyVal => $list) {
                    if ($list['id'] == $refId) {
                        unset($oldValue[$keyVal]);
                    }
                }
                saveCache($name, $oldValue);
            }
        }
    }

?>
