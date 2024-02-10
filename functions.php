<?php


function nslookup($name) {
  return dns_get_record($name, DNS_A + DNS_AAAA);
  // return gethostbynamel($name);
}


function get_disk_space_info($disk) {
  $disk_free_space = disk_free_space($disk);
  $disk_total_space = disk_total_space($disk);
  if (!$disk_free_space or !$disk_total_space) {
    return false;
  } else {
    $hr_free = size_human_readable($disk_free_space);
    $hr_total = size_human_readable($disk_total_space);
    $hr_used = size_human_readable($disk_total_space - $disk_free_space);
    $size = array();
    $size["free_bytes"] = $disk_free_space;
    $size["free_hr"] = $hr_free["hr"];
    $size["free_unit"] = $hr_free["unit"];
    $size["total_bytes"] = $disk_total_space;
    $size["total_hr"] = $hr_total["hr"];
    $size["total_unit"] = $hr_total["unit"];
    $size["used_bytes"] = $disk_total_space - $disk_free_space;
    $size["used_hr"] = $hr_used["hr"];
    $size["used_unit"] = $hr_used["unit"];
    $size["used_percent"] = round( ($disk_total_space - $disk_free_space) * 100 / $disk_total_space, 1);
    $size["free_percent"] = round( ($disk_free_space) * 100 / $disk_total_space, 1);
    return $size;
  }
}


function size_human_readable($bytes) {
  $si_prefix = array( 'B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB' );
  $base = 1024;
  $class = min((int)log($bytes , $base) , count($si_prefix) - 1);
  // echo $bytes . '<br />';
  // echo sprintf('%1.2f' , $bytes / pow($base,$class)) . ' ' . $si_prefix[$class] . '<br />';
  $hr = array();
  $hr["hr"] = round( $bytes / pow($base,$class), 2) . " " . $si_prefix[$class];
  $hr["unit"] = $si_prefix[$class];
  return $hr;
}


// function get_tls_certificate_curl($url, $port) {
//   $orignal_parse = @parse_url($url, PHP_URL_HOST);

//   $header[0] = "Accept: text/xml,application/xml,application/xhtml+xml,";
//   $header[0] .= "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5";
//   $header[] = "Cache-Control: max-age=0";
//   $header[] = "Connection: keep-alive";
//   $header[] = "Keep-Alive: 300";
//   $header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
//   $header[] = "Accept-Language: en-us,en;q=0.5";
//   $header[] = "Pragma: "; // browsers keep this blank.
//   $header[] = "Host: " . $url . ":" . $port; // browsers keep this blank.

//   // if($fp = tmpfile())
//   // {
//       $fp = tmpfile();
//       $ch = curl_init();
//       curl_setopt($ch, CURLOPT_REFERER, $url . ":" . $port);
//       // curl_setopt($ch, CURLOPT_URL, $url . ":" . $port);
//       curl_setopt($ch, CURLOPT_URL, "https://traefik-rp:443");
//       // curl_setopt($ch, CURLOPT_URL, "https://traefik-rp:443");
//       curl_setopt($ch, CURLOPT_PORT, 443);
//       curl_setopt($ch, CURLOPT_CONNECT_TO, array("traefik-rp"));
//       // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Host: ' . $orignal_parse));
//       curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
//       curl_setopt($ch, CURLOPT_STDERR, $fp);
//       curl_setopt($ch, CURLOPT_CERTINFO, 1);
//       curl_setopt($ch, CURLOPT_SSLVERSION, 6);
//       curl_setopt($ch, CURLOPT_VERBOSE, 1);
//       curl_setopt($ch, CURLOPT_HEADER, 1);
//       curl_setopt($ch, CURLOPT_NOBODY, 1);
//       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//       // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  2);
//       $result = curl_exec($ch);

//       curl_errno($ch)==0 or print_r("Error:".curl_errno($ch)." ".curl_error($ch));

//       fseek($fp, 0);//rewind
//       $str='';
//       while(strlen($str.=fread($fp,8192))==8192);
//       echo "<pre>" . $str . "</pre>";
//       fclose($fp);
//   // }
// }


// function get_tls_certificate_socket($url, $port) {
//   $orignal_parse = @parse_url($url, PHP_URL_HOST);
//   $ctx = stream_context_create(array("ssl" => array("capture_peer_cert" => TRUE)));
//   $read = @stream_socket_client("ssl://".$orignal_parse.":".$port, $errno, $errstr, 1, STREAM_CLIENT_CONNECT, $ctx);
//   // echo "<hr>$errno, $errstr <br>" . $url . "<br><hr>";

//   if ($read != false) { 
//     $cert = @stream_context_get_params($read);
//     $certinfo = @openssl_x509_parse($cert['options']['ssl']['peer_certificate']);
//     // return $certinfo;
//     // echo "<pre>" . print_r($certinfo, true) . "</pre>";
  
//     if ( is_array($certinfo) ) {
//       $san = str_replace( "DNS:", "", $certinfo["extensions"]["subjectAltName"] );
//       $san = str_replace( " ", "", $san );
//       $info          = array();
//       $info["san"]   = explode( ",", $san );
//       $info["from"]  = date( "Y-m-d H:i", $certinfo["validFrom_time_t"] );
//       $info["to"]    = date( "Y-m-d H:i", $certinfo["validTo_time_t"] );
//       $info["raw"]   = $certinfo;
   
//       if ( time() > $certinfo["validTo_time_t"] ) {
//         $info["nbj"]   = "expired";
//       } else {
//         $diff = time() - $certinfo["validTo_time_t"];
//         // $diff = $diff * -1 ;
//         $diff = floor( $diff / 86400 ) * -1;
//         $info["dl"]   = $diff;
//       }    
  
//       return $info;
//     } else {
//       return false; 
//     }
//     return false;
//   } else {
//     return false;
//   }
// }


function get_tls_cert_file($cert_file) {
  $read = openssl_x509_parse(file_get_contents( $cert_file ));
  if ($read != false) { 
    // echo "<pre>" . print_r($read, true) . "</pre>";

    $san = str_replace( "DNS:", "", $read["extensions"]["subjectAltName"] );
    $san = str_replace( " ", "", $san );
    $info          = array();
    $info["san"]   = explode( ",", $san );
    $info["from"]  = date( "Y-m-d H:i", $read["validFrom_time_t"] );
    $info["to"]    = date( "Y-m-d H:i", $read["validTo_time_t"] );
    $info["raw"]   = $read;
     
    if ( time() > $read["validTo_time_t"] ) {
      $info["nbj"]   = "expired";
    } else {
      $diff = time() - $read["validTo_time_t"];
      // $diff = $diff * -1 ;
      $diff = floor( $diff / 86400 ) * -1;
      $info["dl"]   = $diff;
    }    
    
    return $info;
  } else {
    return false;
  }

  //   $orignal_parse = @parse_url($url, PHP_URL_HOST);
  //   $ctx = stream_context_create(array("ssl" => array("capture_peer_cert" => TRUE)));
  //   $read = @stream_socket_client("ssl://".$orignal_parse.":".$port, $errno, $errstr, 1, STREAM_CLIENT_CONNECT, $ctx);
  //   // echo "<hr>$errno, $errstr <br>" . $url . "<br><hr>";
  
  //   if ($read != false) { 
  //     $cert = @stream_context_get_params($read);
  //     $certinfo = @openssl_x509_parse($cert['options']['ssl']['peer_certificate']);
  //     // return $certinfo;
  //     // echo "<pre>" . print_r($certinfo, true) . "</pre>";
    
  //     if ( is_array($certinfo) ) {
  //       $san = str_replace( "DNS:", "", $certinfo["extensions"]["subjectAltName"] );
  //       $san = str_replace( " ", "", $san );
  //       $info          = array();
  //       $info["san"]   = explode( ",", $san );
  //       $info["from"]  = date( "Y-m-d H:i", $certinfo["validFrom_time_t"] );
  //       $info["to"]    = date( "Y-m-d H:i", $certinfo["validTo_time_t"] );
  //       $info["raw"]   = $certinfo;
     
  //       if ( time() > $certinfo["validTo_time_t"] ) {
  //         $info["nbj"]   = "expired";
  //       } else {
  //         $diff = time() - $certinfo["validTo_time_t"];
  //         // $diff = $diff * -1 ;
  //         $diff = floor( $diff / 86400 ) * -1;
  //         $info["dl"]   = $diff;
  //       }    
    
  //       return $info;
  //     } else {
  //       return false; 
  //     }
  //     return false;
  //   } else {
  //     return false;
  //   }
  }


function find_icon($url_full) {
  $url_host_full = @parse_url($url_full, PHP_URL_HOST);
  $url_host_split = @preg_split("/\./", $url_host_full);
  // $url_img = "img/nologo.png";
  // echo  $url_host_split[0] ;
  
  $url_img = $url_host_split[0];
  $url_img_n = "";
  if ( is_numeric(substr($url_host_split[0], -1, 1)) && substr($url_host_split[0], -3) != "dc1" ) {
    $url_img_n = substr($url_host_split[0], 0, -1);
  }

  if ( file_exists("img/" . $url_host_full . ".png") ) {
    return "img/" . $url_host_full . ".png";
  } else if ( file_exists("img/" . $url_host_split[0] . ".png") ) {
    return "img/" . $url_host_split[0] . ".png";
  } else if ( file_exists("img/" . $url_img_n . ".png") ) {
    return "img/" . $url_img_n . ".png";
  } else {
    return "img/nologo.png";
  }
}



function is_auth() {
  if ( isset($_SERVER['HTTP_REMOTE_USER']) ) {
    return true;
  } else {
    return false; 
  }
}


function theme_selector($theme_list, $default_theme) {
  $current_theme = $default_theme;
  
  if ( isset($_COOKIE["theme"]) && in_array($_COOKIE["theme"], $theme_list) && ! isset($_GET["theme"])) {
    $current_theme = $_COOKIE["theme"];

  } else if ( isset($_GET["theme"]) && in_array($_GET["theme"], $theme_list) ) {
    setcookie("theme", $_GET["theme"], time()+60*60*24*90, "/");
    $current_theme = $_GET["theme"];

    // } else if ( isset($_GET["theme"]) && $_GET["theme"] == "" ) {
    // $current_theme = false;
    // @setcookie("theme", "", 0, "/");

  } else { 
    // $current_theme = false;
    @setcookie("theme", "", 0, "/");
  }
  
  return $current_theme;
}


function create_themes_list($theme_folder) {
  $theme = array();

  $dir = new DirectoryIterator($theme_folder);
  foreach ($dir as $fileinfo) {
    if ($fileinfo->isDir() && !$fileinfo->isDot()) {
      $theme[] = $fileinfo->getFilename();
    }
  }  
  asort($theme);
  return $theme;
}


// function parser_url($url) {
//   $r  = "^(?:(?P<scheme>\w+)://)?";
//   $r .= "(?:(?P<login>\w+):(?P<pass>\w+)@)?";
//   $r .= "(?P<host>(?:(?P<subdomain>[\w\.]+)\.)?" . "(?P<domain>\w+\.(?P<extension>\w+)))";
//   $r .= "(?::(?P<port>\d+))?";
//   $r .= "(?P<path>[\w/]*/(?P<file>\w+(?:\.\w+)?)?)?";
//   $r .= "(?:\?(?P<arg>[\w=&]+))?";
//   $r .= "(?:#(?P<anchor>\w+))?";
//   $r  = "!$r!"; 
//   preg_match ( $r, $url, $out ); 
//   return $out;
// }


function get_json_api($url_api, $path) {
  $api_raw = false;

  $ctx = stream_context_create(array('http'=>
      array(
          'timeout' => 5,  //1200 Seconds is 20 Minutes
      )
  ));

  foreach ($url_api as $url) {
    // echo "try: $url$path <br>";
    $api_raw = @file_get_contents($url . $path, false, $ctx);
    if ($api_raw != "") {
      break;
    }    
  }

  // if (!$api_raw) {
  if ($api_raw == "") {
    return false;
  } else {
    $api_json = @json_decode($api_raw, true);
    if ($api_json == "") {
      return false;
    } else {
      return $api_json;
    }
  } 
}


// function get_traefik_api_content($url_api) {
//   $traefik_api_raw = @file_get_contents($url_api);
//   if (!$traefik_api_raw) {
//     return false;
//   } else {
//     $traefik_api_json = @json_decode($traefik_api_raw, true);
//     if ($traefik_api_json == "") {
//       return false;
//     } else {
//       return $traefik_api_json;
//     }
//   } 
// }


function get_docker_nodes_status($docker_api_url) {
  $nodes = array();
  // $i = 0;
  // print_r($docker_api_url);

  $docker_api_nodes_json = get_json_api($docker_api_url, "/nodes");
  $docker_nodes_tasks_json = get_json_api($docker_api_url, "/tasks");

  if ( is_array($docker_api_nodes_json) ) {
    foreach ($docker_api_nodes_json as $docker_node) {

      $i                                 = $docker_node["Description"]["Hostname"];
      $nodes[$i]["NodeID"]               = $docker_node["ID"];
      $nodes[$i]["NodeAvailability"]     = $docker_node["Spec"]["Availability"];
      $nodes[$i]["NodeRole"]             = $docker_node["Spec"]["Role"];
      $nodes[$i]["NodeHostname"]         = $docker_node["Description"]["Hostname"];
      $nodes[$i]["NodeEngineVersion"]    = $docker_node["Description"]["Engine"]["EngineVersion"];
      $nodes[$i]["NodeStatus"]           = $docker_node["Status"]["State"];

      if ( $docker_node["Spec"]["Role"] == "manager" ) {
        $nodes[$i]["ManagerLeader"]   = false;
        if ( isset( $docker_node["ManagerStatus"]["Leader"] ) && $docker_node["ManagerStatus"]["Leader"] == 1 ) {
          $nodes[$i]["ManagerLeader"] = true;
        }
        $nodes[$i]["ManagerReachability"]  = $docker_node["ManagerStatus"]["Reachability"];
      }

      $nodes[$i]["NodeTaskRunning"] = 0;
      // $nodes[$i]["NodeTaskShutdown"] = 0;
      if ( is_array($docker_nodes_tasks_json) ) {
        foreach ($docker_nodes_tasks_json as $task) {
          if ( isset( $task["NodeID"] ) && $task["NodeID"] == $docker_node["ID"] ) {            
            if ( isset( $task["DesiredState"] ) && $task["DesiredState"] == "running" ) {
              $nodes[$i]["NodeTaskRunning"]++;
            // } else if ( isset( $task["DesiredState"] ) && $task["DesiredState"] == "shutdown" ) {
              // $nodes[$i]["NodeTaskShutdown"]++;
            } 
          }
        }
      }

// desired-state=running&
// echo $nodes[$i]["NodeHostname"] . " -- " . $docker_node["ID"] . " --- " . $nodes[$i]["NodeTaskRunning"] . "<br />";

      //echo "<pre>" . print_r($docker_nodes_tasks_json, true) . "</pre>";
      // $i++;
    }
  }
  ksort($nodes);
  return $nodes;
}


function get_apps_list($traefik_api_url, $traefik_api_routers_exclude_rule, $links_apps) {
  $services = array();
  $i = 0;
  
  $traefik_api_routers_json = get_json_api($traefik_api_url, "/api/http/routers");
  if ( is_array($traefik_api_routers_json) ) {
    foreach ($traefik_api_routers_json as $traefik_router) {
      $traefik_router_rule = $traefik_router['rule'];
      if ( in_array($traefik_router_rule, $traefik_api_routers_exclude_rule) ) { continue; }
      if ( str_contains($traefik_router_rule, "PathPrefix") ) { continue; }
      if ( isset($traefik_router['entryPoints']) and in_array("traefikhub-api", $traefik_router['entryPoints']) ) { continue; }

      $traefik_router_rule = str_replace("Host(`", "", $traefik_router_rule);
      $traefik_router_rule = str_replace("`)", "", $traefik_router_rule);

      // echo "<pre>" . print_r($traefik_router, true) . "</pre>";

      $services[$i]['url'] = "$traefik_router_rule";
      $services[$i]['icon'] = find_icon("https://" . $traefik_router_rule);
      $services[$i]['entryPoints'] = $traefik_router['entryPoints'];
      // $services[$i]['middlewares'] = $traefik_router['middlewares'];
      $services[$i]['provider'] = $traefik_router['provider'];
      
      $i++;
    }
  }

  foreach ($links_apps as $l) {
    $services[$i]['url'] = $l;
    $services[$i]['icon'] = find_icon($l);
    $i++;
  }
  asort($services);
  return $services;
}


function get_internals_list($traefik_api_url, $links_internals) {
  $services = array();
  $i = 0;
  
  $traefik_api_services_json = get_json_api($traefik_api_url, "/api/http/services");
  if ( is_array($traefik_api_services_json) ) {
    foreach ($traefik_api_services_json as $traefik_service) {
      if ( $traefik_service['provider'] == "docker" ) { continue; }
      if ( $traefik_service['provider'] == "internal" ) { continue; }
    
      // echo "<pre>" . print_r($traefik_service, true) . "</pre>";

      $traefik_service_server = $traefik_service['loadBalancer']['servers'][0]['url'];
      $services[$i]['url'] = $traefik_service_server;
      $services[$i]['icon'] = find_icon($traefik_service_server);
      $i++;
    }            
  }         
  foreach ($links_internals as $l) {
    $services[$i]['url'] = $l;
    $services[$i]['icon'] = find_icon($l);
    $i++;
  }
  asort($services);
  return $services;
}


function get_others_services ( $links_others ) {
  $services = array();     
  $i = 0;        
  foreach ($links_others as $l) {
    $services[$i]['url'] = $l;
    $services[$i]['icon'] = find_icon($l);
    $i++;
  }
  asort($services);
  return $services;
}


?>
