<?php
/**
 * accessBySSL
 * version 1.0
 */
 
class accessBySSL {
  
  var $ids = array();
  var $append;
  var $full;

  function accessBySSL($ids = '', $append = '') {
    $this->ids = explode(',', $ids);
    $this->append = $append;
  }

  function process() {
    global $modx;

    $output = &$modx->documentOutput;

    foreach ($this->ids as $id) {
      $link = $modx->makeUrl($id, '', '');
      $output = preg_replace("|(https?:\/\/".$_SERVER['HTTP_HOST'].")?\/?" . substr($link, 1) . "|", $this->append . $link, $output);
    }

    if (in_array($modx->documentIdentifier, $this->ids)) {
      $output = preg_replace("/<base href=(\"|\')(.+)(\"|\')/", "<base href=\"" . $this->append . "/\"", $output);
      if(strpos($output,'/manager/')!==false) $output = preg_replace("/\/manager\//", "manager/", $output);
      $output = preg_replace("/<a([\s\w\d=\"\']+)href=(\"|\')\/(.+?)(\"|\')/im", "<a$1href=\"http://".$_SERVER['HTTP_HOST']."/$3\"", $output);
      $output = preg_replace("/<a([\s\w\d=\"\']+)href=\"https?:\/\/".$_SERVER['HTTP_HOST']."\/(https?:\/\/.+)\"/", "<a$1href=\"$2\"", $output);
    }
    
  }
}
