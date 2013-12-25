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
    $http_host = substr($modx->config['site_url'],strpos($modx->config['site_url'],'://')+3);
    $http_host = substr($http_host,0,strrpos($http_host,'/'));

    foreach ($this->ids as $id) {
      $link = $modx->makeUrl($id, '', '','full'); // Since 1.0.12J
      $link = $modx->config['base_url'] . str_replace($modx->config['site_url'],'',$link);
      $output = preg_replace("|(https?:\/\/".$http_host.")?\/?" . substr($link, 1) . "|", $this->append . $link, $output);
    }

    if (in_array($modx->documentIdentifier, $this->ids)) {
      $output = preg_replace("/<base href=(\"|\')(.+)(\"|\')/", "<base href=\"" . $this->append . "/\"", $output);
      if(strpos($output,'/manager/')!==false) $output = preg_replace("@/manager/@", "manager/", $output);
      $output = preg_replace("/<a([\s\w\d=\"\']+)href=(\"|\')\/(.+?)(\"|\')/im", "<a$1href=\"http://".$http_host."/$3\"", $output);
      $output = preg_replace("/<a([\s\w\d=\"\']+)href=\"https?:\/\/".$http_host."\/(https?:\/\/.+)\"/", "<a$1href=\"$2\"", $output);
    }
    
  }
}
