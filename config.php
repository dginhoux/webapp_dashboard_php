<?php


error_reporting(0);


date_default_timezone_set('UTC');


$is_debug = true;


$apps_nb_cols = 4;


// $navbar_bg = "dark";
// $item_color_default = "dark";
// $link_color_default = "dark";
// $detail_color_default = "dark-emphasis";
$navbar_bg = "black";
$navlink_color_default = "primary";
$item_color_default = "primary";
$link_color_default = "primary";
$detail_color_default = "secondary";


$section_class = "fs-4  fw-bold  text-uppercase";
$link_class = "fw-semibold  text-decoration-none  text-lowercase  link-$link_color_default  link-opacity-75  link-opacity-100-hover  link-offset-2  link-underline-opacity-0  link-underline-opacity-100-hover";
$item_class = "fw-semibold  text-decoration-none  text-lowercase";
$progress_class = "progress-bar-striped  progress-bar-animated  fw-bold  overflow-visible";


$default_theme = ""; 
$theme_folder = "lib/bootswatch/dist";


$bootstrap_version = "bootstrap-5.3.2-dist";
$jquery = "jquery-3.7.1.min.js";


$dns_list = array();
$dns_list[] = "he308jp4snr.sn.mynetname.net";
$dns_list[] = "gnet-router50.freeboxos.fr";
$dns_list[] = "gnet-router50.ddns.net";
$dns_list[] = "gnet-router99.freeboxos.fr";
$dns_list[] = "he308gk20g5.sn.mynetname.net";
$dns_list[] = "gnet-router70.freeboxos.fr";
$dns_list[] = "gnet-router70.ddns.net";


$disk_space = array();
$disk_space[] = "/host/mnt/gfs_lv_swarm_prod0";
$disk_space[] = "/host/mnt/gfs_lv_swarm_prod1";
$disk_space[] = "/host/mnt/gfs_lv_swarm_registry0";
$disk_space[] = "/host/mnt/gfs_lv_ansible0";


$traefik_api_url = array();
// $traefik_api_url[] = "http://traefik-rp:8083";
$traefik_api_url[] = "http://traefik-internal-rp:8083";
// $traefik_api_url[] = "http://traefik-external-rp:8083";


$docker_swarm_api_url = array();
$docker_swarm_api_url[] = "http://socket:2375";
// $docker_swarm_api_url[] = "http://srv-swarm-manager1.infra.ginhoux.net:2375";
// $docker_swarm_api_url[] = "http://srv-swarm-manager2.infra.ginhoux.net:2375";
// $docker_swarm_api_url[] = "http://srv-swarm-manager3.infra.ginhoux.net:2375";


$docker_pxe_api_url = array();
$docker_pxe_api_url[] = "http://pxe.infra.ginhoux.net:2375";


$managed_domains = array(); 
$managed_domains[] = "ginhoux.app"; 
$managed_domains[] = "ginhoux.net"; 
$managed_domains[] = "ginhoux.org"; 
$managed_domains[] = "mystack.fr"; 
// $managed_domains[] = "ginhoux.cloud"; 
// $managed_domains[] = "orchestre-elyps.fr"; 
// $managed_domains[] = "rockinshake.com"; 


$links_apps = array();
// $links_apps[] = "https://www.free.fr";


$links_others = array();
$links_others[] = "https://galaxy.ansible.com/";
$links_others[] = "https://manager.infomaniak.com";
$links_others[] = "https://www.ovh.com/manager";
$links_others[] = "https://hub.docker.com";
$links_others[] = "https://www.github.com";
$links_others[] = "https://www.gitlab.com";
$links_others[] = "http://shreckbull.free.fr";
// $links_others[] = "https://www.rockinshake.com/r0ck1nsh4k3";


$links_knocking = array();
$links_knocking[] = "https://gnet-router50.freeboxos.fr:7001";
$links_knocking[] = "https://gnet-router50.freeboxos.fr:7002";
$links_knocking[] = "https://gnet-router50.freeboxos.fr:7003";
$links_knocking[] = "https://gnet-router50.freeboxos.fr:28443";
$links_knocking[] = "https://gnet-router70.freeboxos.fr:7001";
$links_knocking[] = "https://gnet-router70.freeboxos.fr:7002";
$links_knocking[] = "https://gnet-router70.freeboxos.fr:7003";
$links_knocking[] = "https://gnet-router70.freeboxos.fr:28443";


$links_internals  = array();
$links_internals[] = "http://192.168.0.1";
$links_internals[] = "http://192.168.1.1";
$links_internals[] = "https://192.168.50.254:28443";
$links_internals[] = "https://192.168.70.254:28443";
$links_internals[] = "http://192.168.175.251";
$links_internals[] = "https://192.168.175.221:8006";
$links_internals[] = "https://192.168.175.222:8006";
$links_internals[] = "https://192.168.175.223:8006";
$links_internals[] = "https://192.168.175.224:8006";
$links_internals[] = "https://192.168.175.225:8006";
$links_internals[] = "https://192.168.175.226:8006";
// $links_internals[] = "http://192.168.50.2";
// $links_internals[] = "http://192.168.70.2";


$traefik_api_routers_exclude_rule  = array();
$traefik_api_routers_exclude_rule[] = "PathPrefix(`/api`)";
$traefik_api_routers_exclude_rule[] = "PathPrefix(`/`)";
$traefik_api_routers_exclude_rule[] = "PathPrefix(`/debug`)";
$traefik_api_routers_exclude_rule[] = "HostRegexp(`{host:.+}`)";
$traefik_api_routers_exclude_rule[] = "PathPrefix(`/ping`)";
$traefik_api_routers_exclude_rule[] = "PathPrefix(`/metrics`)";
$traefik_api_routers_exclude_rule[] = "HostRegexp(`{host:.+}`)";
// foreach ( $managed_domains as $domain ) {
//   $traefik_api_routers_exclude_rule[] = "Host(`authelia.$domain`)";
  // $traefik_api_routers_exclude_rule[] = "Host(`dashboard.$domain`)";
  // $traefik_api_routers_exclude_rule[] = "Host(`auth.$domain`)";
// }


$tls_cert_file = array();
$tls_cert_file[] = "/lego-certs/_.ginhoux.app.crt";
$tls_cert_file[] = "/lego-certs/_.ginhoux.net.crt";
$tls_cert_file[] = "/lego-certs/_.ginhoux.org.crt";
$tls_cert_file[] = "/lego-certs/_.mystack.fr.crt";


// $domains_tls_test[10]["url"] = "https://auth2.ginhoux.app";
// $domains_tls_test[10]["port"] = 443;
// $domains_tls_test[30]["url"] = "https://auth2.ginhoux.net";
// $domains_tls_test[30]["port"] = 443;
// $domains_tls_test[40]["url"] = "https://auth2.ginhoux.org";
// $domains_tls_test[40]["port"] = 443;
// $domains_tls_test[50]["url"] = "https://auth2.mystack.fr";
// $domains_tls_test[50]["port"] = 443;

// $domains_tls_test[10]["url"] = "https://_ssl_dashboard.ginhoux.app";
// $domains_tls_test[10]["port"] = 443;
// $domains_tls_test[30]["url"] = "https://_ssl_dashboard.ginhoux.net";
// $domains_tls_test[30]["port"] = 443;
// $domains_tls_test[40]["url"] = "https://_ssl_dashboard.ginhoux.org";
// $domains_tls_test[40]["port"] = 443;
// $domains_tls_test[50]["url"] = "https://_ssl_dashboard.mystack.fr";
// $domains_tls_test[50]["port"] = 443;
// $domains_tls_test[20]["url"] = "https://_ssl_dashboard.ginhoux.cloud";
// $domains_tls_test[20]["port"] = 443;
// $domains_tls_test[4]["url"] = "https://_ssl_dashboard.orchestre-elyps.fr";
// $domains_tls_test[4]["port"] = 443;
// $domains_tls_test[5]["url"] = "https://www.free.fr";
// $domains_tls_test[5]["port"] = 443;


?>
