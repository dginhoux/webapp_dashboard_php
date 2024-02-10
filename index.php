<?php

function func_microtime_float () {
  list ($msec, $sec) = explode(' ', microtime());
  $microtime = (float)$msec + (float)$sec;
  return $microtime;
} 
$microtime_start = func_microtime_float(); 


include("config.php");
include("functions.php");

// $current_url = parser_url($_SERVER['HTTP_HOST']);
// echo "<pre>" . print_r($current_url, true) . "</pre>";

$domain_extract = array_reverse( explode(".", $_SERVER['HTTP_HOST']) );
$domain_name = $domain_extract[1] . "." . $domain_extract[0];

$theme_list = create_themes_list($theme_folder);
$current_theme = theme_selector($theme_list, $default_theme);

echo "<!doctype html>
<html lang=\"en\">
  <head>
    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">
    <title>
      " . $_SERVER["HTTP_HOST"] . "
    </title>

    <script src=\"lib/$jquery\"></script>
    <link href=\"lib/$bootstrap_version/css/bootstrap.min.css\" rel=\"stylesheet\">
    <script src=\"lib/$bootstrap_version/js/bootstrap.bundle.min.js\"></script>

    <style>
      html {font-size:0.9rem;} /*1rem = 14px*/
      @media (min-width: 544px) {
        html {font-size:0.9rem;} /*1rem = 14px*/
      }
      /* Medium devices (tablets, 768px and up) The navbar toggle appears at this breakpoint */
      @media (min-width: 768px) {  
        html {font-size:1rem;} /*1rem = 14px*/
      }
      /* Large devices (desktops, 992px and up) */
      @media (min-width: 992px) { 
        html {font-size:1rem;} /*1rem = 14px*/
      }
      /* Extra large devices (large desktops, 1200px and up) */
      @media (min-width: 1200px) {
        html {font-size:1.1rem;} /*1rem = 14px*/
      }
    </style>
    ";

    if ( $current_theme != "" && file_exists( $theme_folder . "/" . $current_theme . "/bootstrap.min.css" ) ) { 
      echo "<link href=\"" . $theme_folder . "/" . $current_theme . "/bootstrap.min.css" . "\" rel=\"stylesheet\">";
    }

  echo "
  </head>
  <body>
  
		<nav class=\"navbar navbar-expand-md sticky-top bg-primary \" data-bs-theme=\"dark\" >
			<div class=\"container-fluid\">
				<a class=\"navbar-brand fw-bold\" href=\"#\">
        <img src=\"img/dashboard50.png\" width=\"38\" height=\"32\" class=\"d-inline-block align-text-top\">
        &nbsp;&nbsp;&nbsp;
        " . $_SERVER["HTTP_HOST"] . "
        </a>
				<button class=\"navbar-toggler\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#navbarNavDropdown\" aria-controls=\"navbarNavDropdown\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
					<span class=\"navbar-toggler-icon\"></span>
				</button>
				<!-- -->
				<div class=\"collapse navbar-collapse\" id=\"navbarNavDropdown\">
					<ul class=\"navbar-nav\">
					  <!--
						<li class=\"nav-item\">
							<a class=\"nav-link active\" aria-current=\"page\" href=\"#\">1</a>
						</li>
						<li class=\"nav-item\">
							<a class=\"nav-link\" href=\"#\">2</a>
						</li>
						<li class=\"nav-item\">
							<a class=\"nav-link\" href=\"#\">3</a>
						</li>
						-->
					</ul>
				</div>
				<!-- -->
        
  			<ul class=\"navbar-nav\">
  				<li class=\"nav-item dropdown\">
  					<a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdownMenuLink\" role=\"button\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
  					" . $_SERVER['HTTP_REMOTE_USER'] . "
  					</a>
  					<ul class=\"dropdown-menu\" aria-labelledby=\"navbarDropdownMenuLink\">
  						<li><a class=\"fs-6 lh-1 dropdown-item\" href=\"https://auth." . $domain_name . "\">settings</a></li>
  						<li><a class=\"fs-6 lh-1 dropdown-item\" href=\"https://auth." . $domain_name . "/logout\">logout</a></li>
  					</ul>
  				</li>
          
  				<li class=\"nav-item dropdown\">
  				<a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdownMenuLink\" role=\"button\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
  				theme
  				</a>
  				<ul class=\"dropdown-menu\" aria-labelledby=\"navbarDropdownMenuLink\">";
  					echo "<li><a class=\"dropdown-item active\" href=\"?theme=\">default</a></li>";
  					foreach ( $theme_list as $theme_id ) {
  						if ( $theme_id == $current_theme ) { 
  							echo "<li><a class=\"fs-6 lh-1 dropdown-item active\" href=\"?theme=$theme_id\">" . $theme_id . "</a></li>";
  						} else {
  							echo "<li><a class=\"fs-6 lh-1 dropdown-item \" href=\"?theme=$theme_id\">" . $theme_id . "</a></li>";
  						}
  					}
  				echo "</ul>
  				</li>
          
  			</ul>
			</div>
		</nav>";



	// 	<li class=\"nav-item dropdown\">
	// 	<a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdownMenuLink\" role=\"button\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
	// 	theme
	// 	</a>
	// 	<ul class=\"dropdown-menu\" aria-labelledby=\"navbarDropdownMenuLink\">";
	// 	  foreach ( $theme_list as $theme_id ) {
	// 		  if ( $theme_id == $current_theme ) {
	// 		  	echo "<li><a class=\"dropdown-item active\" href=\"?theme=$theme_id\">" . $theme_id . "</a></li>";
	// 		  } else {
	// 		  	echo "<li><a class=\"dropdown-item \" href=\"?theme=$theme_id\">" . $theme_id . "</a></li>";
	// 		  }
	// 	  }          
	// 	echo "</ul>
	// </li>


        // <ul class=\"navbar-nav justify-content-end\">
        //   <li class=\"nav-item dropdown\">
        //     <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"dropdown02\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">theme</a>
        //     <div class=\"dropdown-menu\" aria-labelledby=\"dropdown02\">
        //       <a class=\"dropdown-item active\" href=\"?theme=\">" . "default" . "</a>
        //       <div class=\"dropdown-divider\"></div>";
        //       foreach ( $theme_list as $theme_id ) {
        //         if ( $theme_id == $current_theme ) {
        //           echo "<a class=\"dropdown-item active\" href=\"?theme=$theme_id\">" . $theme_id . "</a>";
        //         } else {
        //           echo "<a class=\"dropdown-item \" href=\"?theme=$theme_id\">" . $theme_id . "</a>";
        //         }
        //       }
        //     echo "
        //     </div>
        //   </li>";



echo "<main role=\"main\">

    <div class=\"jumbotron jumbotron-fluid\">
      <div class=\"container\">";
      if ( is_auth() ) {
        echo "<p class=\"fs-3 fw-bold text-uppercase\">hello " . $_SERVER['HTTP_REMOTE_USER'] . " !</p>";
      } else {
        echo "<p class=\"fs-3 fw-bold text-uppercase\">hello !</p>";
      }
      // echo "<p class=\"fs-6\">access start here</p>";
      echo "</div>
    </div>";


    echo "<div class=\"container-fluid px-lg-5\">
      <div class=\"row\">
        <div class=\"col\">
          <div class=\"table-responsive\">
            <table class=\"table table-sm table-borderless\">
              <thead class=\"thead-light\">
                <tr><th class=\"fs-3 fw-bold text-uppercase\" scope=\"col\">applications</th></tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
      <div class=\"row\">";
      $apps_pos = 0;
      $apps_list = get_apps_list($traefik_api_url, $traefik_api_routers_exclude_rule, $links_apps);
      $total_apps_list = count($apps_list);
      $apps_nb_per_cols = round($total_apps_list / $apps_nb_cols, 0) +1;
      $apps_list2 = array_chunk($apps_list, $apps_nb_per_cols, true);
      // echo "$apps_nb_per_cols __ $total_apps_list __ ";
      // echo "<pre>" . print_r($apps_list2, true) . "</pre>";
      for ($i = 0; $i < $apps_nb_cols; $i++) {
        echo "<div class=\"col\">";
          echo "<div class=\"table-responsive\">
          <table class=\"table table-lg table-borderless\">
          <!-- <thead class=\"thead-light\">
            <tr><th class=\"fs-3 fw-bold text-uppercase\" scope=\"col\">applications</th></tr>
          </thead> -->
          <tbody>";

        foreach ( $apps_list2[$i] as $app ) {
          $item_color = "link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover text text-primary fw-bold";
          $app_url = $app['url'];
          $app_scheme = "https";
          if (str_starts_with($app['url'], "pihole")) {
            $app_url = $app['url'] . "/admin";
          }
          if ( isset($app['entryPoints']) and in_array("web_80", $app['entryPoints']) ) {
            $item_color = "link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover text text-primary";
            $app_scheme = "http";
          }
          echo "<tr>";
          echo "<td>";
            echo "<img class=\"rounde float-left align-middle\" width=\"35px\" height=\"35px\" src=\"" . $app['icon'] . "\">";
            echo "&nbsp;&nbsp;";
            echo "<a class=\"$item_color text-lowercase\" href=\"" . $app_scheme . "://" . $app_url . "\" title=\"" . $app_scheme . "://" . $app['url'] . "\" target=\"_blank\">" . $app['url'] . "</a>";
            // echo "&nbsp;&nbsp;";
            // echo "&nbsp;&nbsp;<img title=\"expire soon\" class=\"rounded float-right\" width=\"15px\" height=\"15px\" src=\"img/" . $app_scheme . "2.png\">";
          echo "</td>";
          echo "</tr>";
        }

          echo "
          </tbody>
          </table>
          </div>";


        echo "</div>";
      }
      echo "
      </div>
    </div>";




    echo "<div class=\"container-fluid px-lg-5\">
      <div class=\"row\">
        <div class=\"col\">";




          echo "<div class=\"table-responsive\">
          <table class=\"table table-lg table-borderless table-responsive\">
          <thead class=\"thead-light\">
            <tr><th class=\"fs-3 fw-bold text-uppercase\" scope=\"col\">certificates</th></tr>
          </thead>
          <tbody>";
            foreach ( $tls_cert_file as $cert_file ) {
              $cert_info = get_tls_cert_file( $cert_file );
              if ($cert_info != false) {
                $title_color = "primary";
                $item_color = "light";
                $detail_color = "secondary";
                // $item_icon = "";
                if ( $cert_info["dl"] <= "0" ) {
                  $title_color = "danger";
                  $item_color = "danger";
                  $detail_color = "danger";
                  // $item_icon = "<img title=\"expired\" class=\"rounded float-right\" width=\"15px\" height=\"15px\" src=\"img/s_error.png\">";
                } else if ( $cert_info["dl"] >= "1" and $cert_info["dl"] <= "14") {
                  $title_color = "warning";
                  $item_color = "warning";
                  $detail_color = "warning";
                  // $item_icon = "<img title=\"expire soon\" class=\"rounded float-right\" width=\"15px\" height=\"15px\" src=\"img/s_notice.png\">";
                } else if ( $cert_info["dl"] >= "15" and $cert_info["dl"] <= "44") {
                  $title_color = "primary";
                  $item_color = "info";
                  $detail_color = "info";
                  // $item_icon = "<img title=\"expire soon\" class=\"rounded float-right\" width=\"15px\" height=\"15px\" src=\"img/s_notice.png\">";
                // } else if ( $cert_info["dl"] >= "45" ) {
                  // $title_color = "primary";
                  // $item_color = "success";
                  // $item_icon = "<img title=\"valid\" class=\"rounded float-right\" width=\"15px\" height=\"15px\" src=\"img/s_okay.png\">";
                }
                // $ratio = round( $cert_info["dl"] * 100 / 90, 0 );
                echo "<tr><td class=\"alert\">";
                  echo "<div class=\"alert alert-$item_color\" role=\"alert\">";
                  echo "<p class=\"text text-$title_color fw-bold text-decoration-none text-lowercase\">";
                  foreach ( $cert_info["san"] as $cert_san ) {
                    echo $cert_san;
                    echo "&nbsp;&nbsp;";
                  }
                  // echo "&nbsp;&nbsp;";
                  // echo $item_icon;
                  echo "</p>";
                  echo "<div class=\"progress\" style=\"height: 25px; margin-bottom: 10px;\" aria-valuenow=\"" . $cert_info["dl"] . "\" aria-valuemin=\"0\" aria-valuemax=\"100\">";
                  echo "<div class=\"progress-bar progress-bar-striped progress-bar text-dark fw-bold bg-$detail_color overflow-visible opacity-75\" role=\"progressbar\" style=\"width: " . $cert_info["dl"] . "%\">";
                  echo $cert_info["dl"] . " days";
                  echo "</div>";
                  echo "</div>";
                  echo "delivered";
                  echo "&nbsp;";
                  echo "<span class=\"badge bg-$detail_color opacity-75\">" . $cert_info["from"] . "</span>";
                  echo "&nbsp;&nbsp;";
                  echo "expire";
                  echo "&nbsp;";
                  echo "<span class=\"badge bg-$detail_color opacity-75\">" . $cert_info["to"] . "</span>";
                  echo "</div>";
                echo "</td></tr>";
              }
            }
          echo "
          </tbody>
          </table>
          </div>";


          if ( is_auth() ) {
            echo "<div class=\"table-responsive\">
            <table class=\"table table-lg table-borderless table-responsive\">
            <thead class=\"thead-light\">
              <tr><th class=\"fs-3 fw-bold text-uppercase\" scope=\"col\">internals links</th></tr>
            </thead>
            <tbody>";
              foreach ( get_internals_list( $traefik_api_url, $links_internals ) as $app ) {
                $item_color = "link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover text text-primary fw-bold";
                $app_scheme = parse_url($app['url'], PHP_URL_SCHEME);
                $app_name = preg_replace('#^https?://#', '', rtrim($app['url'],'/'));
                if ( $app_scheme == "http" ) {
                  $item_color = "link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover text text-primary";
                }
                echo "<tr><td>";
                  echo "<img class=\"rounde float-left align-middle\" width=\"35px\" height=\"35px\" src=\"" . $app['icon'] . "\">";
                  echo "&nbsp;&nbsp;";
                  echo "<a class=\"$item_color text-lowercase\" href=\"" . $app_scheme . "://" . $app_name . "\" title=\"" . $app_scheme . "://" . $app_name . "\" target=\"_blank\">" . $app_name . "</a>";
                  // echo "&nbsp;&nbsp;";
                  // echo "<img title=\"expire soon\" class=\"rounded float-right\" width=\"15px\" height=\"15px\" src=\"img/" . $app_scheme . "2.png\">";
                echo "</td></tr>";
              }
            echo "
            </tbody>
            </table>
            </div>";
          }




        echo "</div>";
        echo "<div class=\"col\">";




        echo "<div class=\"table-responsive\">
        <table class=\"table table-lg table-borderless table-responsive\">
        <thead class=\"thead-light\">
          <tr><th class=\"fs-3 fw-bold text-uppercase\" scope=\"col\">wan bandwith</th></tr>
        </thead>
        <tbody>";
        echo "<tr><td>";
          echo "<div class=\"alert alert-light\" role=\"alert\">";
          echo "<p class=\"text text-primary fw-bold text-decoration-none\">router50 - eth1</p> ";
          echo "<iframe src=\"https://grafana.ginhoux.net/d-solo/a99d75bd-58fe-4bb3-a2a3-ce9f0eafbdd2/dashboard-integration?orgId=1&refresh=15s&panelId=266&theme=light\" 
					width=\"100%\" height=\"300\" frameborder=\"0\"></iframe>";
          echo "</div>";
        echo "</td></tr>";
        echo "<tr><td>";
          echo "<div class=\"alert alert-light\" role=\"alert\">";
          echo "<p class=\"text text-primary fw-bold text-decoration-none\">router70 - eth1</p> ";
          echo "<iframe src=\"https://grafana.ginhoux.net/d-solo/a99d75bd-58fe-4bb3-a2a3-ce9f0eafbdd2/dashboard-integration?orgId=1&refresh=15s&panelId=267&theme=light\" 
					width=\"100%\" height=\"300\" frameborder=\"0\"></iframe>";
          echo "</div>";
        echo "</td></tr>";
        echo "
        </tbody>
        </table>
        </div>";


        echo "<div class=\"table-responsive\">
        <table class=\"table table-lg table-borderless table-responsive\">
        <thead class=\"thead-light\">
          <tr><th class=\"fs-3 fw-bold text-uppercase\" scope=\"col\">disk space</th></tr>
        </thead>
        <tbody>";
          foreach ( $disk_space as $disk ) {
            $size = get_disk_space_info($disk);
            if ($size != false) {
              $title_color = "primary";
              $item_color = "light";
              $detail_color = "secondary";
              // $item_icon = "";
              if ( $size["free_percent"] <= "10" ) {
                $title_color = "danger";
                $item_color = "danger";
                $detail_color = "danger";
                // $item_icon = "<img title=\"very low space\" class=\"rounded float-right\" width=\"15px\" height=\"15px\" src=\"img/s_error.png\">";
              } else if ( $size["free_percent"] >= "11" and $size["free_percent"] <= "19") {
                $title_color = "warning";
                $item_color = "warning";
                $detail_color = "warning";
                // $item_icon = "<img title=\"low space\" class=\"rounded float-right\" width=\"15px\" height=\"15px\" src=\"img/s_notice.png\">";
              } else if ( $size["free_percent"] >= "20" ) {
                $title_color = "primary";
                $item_color = "light";
                $detail_color = "secondary";
                // $item_icon = "<img title=\"ok\" class=\"rounded float-right\" width=\"15px\" height=\"15px\" src=\"img/s_okay.png\">";
              }
              echo "<tr><td class=\"alert\">";
                echo "<div class=\"alert alert-$item_color\" role=\"alert\">";
                echo "<p class=\"text text-$title_color fw-bold text-decoration-none text-lowercase\">";
                echo "$disk";
                // echo "&nbsp;&nbsp;";
                // echo "$item_icon";
                echo "</p>";
                echo "<div class=\"progress\" style=\"height: 25px; margin-bottom: 10px;\" aria-valuenow=\"" . $size["free_percent"] . "\" aria-valuemin=\"0\" aria-valuemax=\"100\">";
                echo "<div class=\"progress-bar progress-bar-striped progress-bar text-dark fw-bold bg-$detail_color overflow-visible opacity-75\" role=\"progressbar\" style=\"width: " . $size["free_percent"] . "%\">";
                echo $size["free_hr"] . " (" . $size["free_percent"] . "%)";
                echo "</div>";
                echo "</div>";
                // echo "used &nbsp;<span class=\"badge bg-$item_color\">" . $size["used_hr"] . " (" . $size["used_percent"] . "%)</span> &nbsp;|&nbsp; ";
                // echo "free &nbsp;<span class=\"badge bg-$item_color\">" . $size["free_hr"] . " (" . $size["free_percent"] . "%)</span> &nbsp;|&nbsp; ";
                echo "used";
                echo "&nbsp;";
                echo "<span class=\"badge bg-$detail_color opacity-75\">" . $size["used_hr"] . "</span>";
                echo "&nbsp;&nbsp;";
                echo "free";
                echo "&nbsp;";
                echo "<span class=\"badge bg-$detail_color opacity-75\">" . $size["free_hr"] . "</span>";
                echo "&nbsp;&nbsp;";
                echo "total";
                echo "&nbsp;";
                echo "<span class=\"badge bg-$detail_color opacity-75\">" . $size["total_hr"] . "</span>";
                echo "</div>";
              echo "</td></tr>";
            }
          }
        echo "
        </tbody>
        </table>
        </div>";


        if ( is_auth() ) { 
          echo "<div class=\"table-responsive\">
          <table class=\"table table-lg table-borderless table-responsive\">
          <thead class=\"thead-light\">
            <tr><th class=\"fs-3 fw-bold text-uppercase\" scope=\"col\">port knocking</th></tr>
          </thead>
          <tbody>";
            foreach ( get_others_services( $links_knocking ) as $app ) {
              $item_color = "link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover text text-primary fw-bold";
              $app_scheme = parse_url($app['url'], PHP_URL_SCHEME);
              if ( $app_scheme == "http" ) {
                $item_color = "link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover text text-primary";
              }
              $app_name = preg_replace('#^https?://#', '', rtrim($app['url'],'/'));
              echo "<tr><td>";
                echo "<img class=\"rounded\" width=\"35px\" height=\"35px\" src=\"" . $app['icon'] . "\">";
                echo "&nbsp;&nbsp;";
                echo "<a class=\"$item_color text-lowercase\" href=\"" . $app['url'] . "\" target=\"_blank\">" . $app_name . "</a>";
                // echo "&nbsp;&nbsp;";
                // echo "&nbsp;&nbsp;<img title=\"expire soon\" class=\"rounded float-right\" width=\"15px\" height=\"15px\" src=\"img/" . $app_scheme . "2.png\">";
              echo "</td></tr>";
            }
          echo "
          </tbody>
          </table>
          </div>";
        }


        echo "<div class=\"table-responsive\">
        <table class=\"table table-lg table-borderless table-responsive\">
        <thead class=\"thead-light\">
          <tr><th class=\"fs-3 fw-bold text-uppercase\" scope=\"col\">docker pxe</th></tr>
        </thead>
        <tbody>";
          $docker_nodes_status_list = get_docker_nodes_status( $docker_pxe_api_url );
          foreach ($docker_nodes_status_list as $node) {
            if ( $node["NodeStatus"] == "ready" ) {
              $title_color = "primary";
              $item_color = "light";
              // $item_icon_icon = "<img title=\"expire soon\" class=\"rounded float-right\" width=\"15px\" height=\"15px\" src=\"img/s_okay.png\">";
            } else {
              $title_color = "danger";
              $item_color = "danger";
              // $item_icon_icon = "<img title=\"expire soon\" class=\"rounded float-right\" width=\"15px\" height=\"15px\" src=\"img/s_cancel.png\">";
            }
            if ( isset ( $node["ManagerLeader"] ) && $node["ManagerLeader"] ) {
              $item_color = "info";
            }
            echo "<tr><td class=\"alert\">";
              echo "<div class=\"alert alert-$item_color\" role=\"alert\">";
              echo "<p class=\"text text-$title_color fw-bold text-decoration-none text-lowercase\">" . $node["NodeHostname"] . "";
              // echo "&nbsp;&nbsp;";
              // echo $item_icon;
              echo "</p>";
              echo "tasks";
              echo "&nbsp;";
              echo "<span class=\"badge bg-secondary opacity-75 text-lowercase\">" . $node["NodeTaskRunning"] . "</span>";
              echo "&nbsp;&nbsp;";
              echo "node";
              echo "&nbsp;";
                if ( $node["NodeRole"] == "manager" ) {
                  echo "<span class=\"badge bg-secondary opacity-75 text-lowercase\">manager</span>";
                  echo "&nbsp;";
                } else {
                  echo "<span class=\"badge bg-secondary opacity-75 text-lowercase\">worker</span>";
                  echo "&nbsp;";
                }
                if ( $node["NodeAvailability"] == "active" ) {
                  echo "<span class=\"badge bg-success opacity-75 text-lowercase\">active</span>";
                  echo "&nbsp;";
                } else if ( $node["NodeAvailability"] == "drain" ) {
                  echo "<span class=\"badge bg-warning opacity-75 text-lowercase\">drain</span>";
                  echo "&nbsp;";
                } else {
                  echo "<span class=\"badge bg-danger opacity-75 text-lowercase\">pause</span>";
                  echo "&nbsp;";
                }
                echo "<span class=\"badge bg-secondary opacity-75 text-lowercase\">" . $node["NodeEngineVersion"] . "</span>";
                echo "&nbsp;";
                if ( isset ( $node["ManagerLeader"] ) && $node["ManagerLeader"] ) {
                  echo "<span class=\"badge bg-info opacity-75 text-lowercase\">leader</span>";
                  echo "&nbsp;";
                }
              echo "</div>";
            echo "</td></tr>";
          }
        echo "
        </tbody>
        </table>
        </div>";




        echo "</div>";
        echo "<div class=\"col\">";




        echo "<div class=\"table-responsive\">
        <table class=\"table table-lg table-borderless table-responsive\">
        <thead class=\"thead-light\">
          <tr><th class=\"fs-3 fw-bold text-uppercase\" scope=\"col\">others links</th></tr>
        </thead>
        <tbody>";
          foreach ( get_others_services( $links_others ) as $app ) {
            $item_color = "link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover text text-primary fw-bold";
            $app_scheme = parse_url($app['url'], PHP_URL_SCHEME);
            if ( $app_scheme == "http" ) {
              $item_color = "link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover text text-primary";
            }
            $app_name = preg_replace('#^https?://#', '', rtrim($app['url'],'/'));
            echo "<tr><td>";
              echo "<img class=\"rounded\" width=\"35px\" height=\"35px\" src=\"" . $app['icon'] . "\">";
              echo "&nbsp;&nbsp;";
              echo "<a class=\"$item_color text-lowercase\" href=\"" . $app['url'] . "\" target=\"_blank\">" . $app_name . "</a>";
              // echo "&nbsp;&nbsp;";
              // echo "&nbsp;&nbsp;<img title=\"expire soon\" class=\"rounded float-right\" width=\"15px\" height=\"15px\" src=\"img/" . $app_scheme . "2.png\">";
            echo "</td></tr>";
          }
        echo "
        </tbody>
        </table>
        </div>";


        echo "<div class=\"table-responsive\">
        <table class=\"table table-lg table-borderless table-responsive\">
        <thead class=\"thead-light\">
          <tr><th class=\"fs-3 fw-bold text-uppercase\" scope=\"col\">docker swarm</th></tr>
        </thead>
        <tbody>";
          $docker_nodes_status_list = get_docker_nodes_status( $docker_swarm_api_url );
          foreach ($docker_nodes_status_list as $node) {
            if ( $node["NodeStatus"] == "ready" ) {
              $title_color = "primary";
              $item_color = "light";
              // $item_icon_icon = "<img title=\"expire soon\" class=\"rounded float-right\" width=\"15px\" height=\"15px\" src=\"img/s_okay.png\">";
            } else {
              $title_color = "danger";
              $item_color = "danger";
              // $item_icon_icon = "<img title=\"expire soon\" class=\"rounded float-right\" width=\"15px\" height=\"15px\" src=\"img/s_cancel.png\">";
            }
            if ( isset ( $node["ManagerLeader"] ) && $node["ManagerLeader"] ) {
              $item_color = "info";
            }
            echo "<tr><td class=\"alert\">";
              echo "<div class=\"alert alert-$item_color\" role=\"alert\">";
              echo "<p class=\"text text-$title_color fw-bold text-decoration-none text-lowercase\">" . $node["NodeHostname"] . "";
              // echo "&nbsp;&nbsp;";
              // echo $item_icon;
              echo "</p>";
              echo "tasks";
              echo "&nbsp;";
              echo "<span class=\"badge bg-secondary opacity-75 text-lowercase\">" . $node["NodeTaskRunning"] . "</span>";
              echo "&nbsp;&nbsp;";
              echo "node";
              echo "&nbsp;";
                if ( $node["NodeRole"] == "manager" ) {
                  echo "<span class=\"badge bg-secondary opacity-75 text-lowercase\">manager</span>";
                  echo "&nbsp;";
                } else {
                  echo "<span class=\"badge bg-secondary opacity-75 text-lowercase\">worker</span>";
                  echo "&nbsp;";
                }
                if ( $node["NodeAvailability"] == "active" ) {
                  echo "<span class=\"badge bg-success opacity-75 text-lowercase\">active</span>";
                  echo "&nbsp;";
                } else if ( $node["NodeAvailability"] == "drain" ) {
                  echo "<span class=\"badge bg-warning opacity-75 text-lowercase\">drain</span>";
                  echo "&nbsp;";
                } else {
                  echo "<span class=\"badge bg-danger opacity-75 text-lowercase\">pause</span>";
                  echo "&nbsp;";
                }
                echo "<span class=\"badge bg-secondary opacity-75 text-lowercase\">" . $node["NodeEngineVersion"] . "</span>";
                echo "&nbsp;";
                if ( isset ( $node["ManagerLeader"] ) && $node["ManagerLeader"] ) {
                  echo "<span class=\"badge bg-info opacity-75 text-lowercase\">leader</span>";
                  echo "&nbsp;";
                }
              echo "</div>";
            echo "</td></tr>";
          }
        echo "
        </tbody>
        </table>
        </div>";


        echo "<div class=\"table-responsive\">
        <table class=\"table table-lg table-borderless table-responsive\">
        <thead class=\"thead-light\">
          <tr><th class=\"fs-3 fw-bold text-uppercase\" scope=\"col\">dns resolution</th></tr>
        </thead>
        <tbody>";
          foreach ( $dns_list as $dns_name ) {
            $nslookup = nslookup($dns_name);
            $title_color = "primary";
            $item_color = "light";
            $detail_color = "secondary";
            // $item_icon = "<img title=\"valid\" class=\"rounded float-right\" width=\"15px\" height=\"15px\" src=\"img/s_okay.png\">";
            if ( ! $nslookup ) {
              $title_color = "primary";
              $item_color = "danger";
              $detail_color = "danger";
              // $item_icon = "<img title=\"expired\" class=\"rounded float-right\" width=\"15px\" height=\"15px\" src=\"img/s_error.png\">";
            }
            echo "<tr><td class=\"alert\">";
              echo "<div class=\"alert alert-$item_color\" role=\"alert\">";
              echo "<p class=\"text text-$title_color fw-bold text-decoration-none text-lowercase\">";
              echo "$dns_name";
              // echo "&nbsp;&nbsp;";
              // echo $item_icon;
              echo "</p> ";
              foreach ( $nslookup as $ip ) {
                if ( isset($ip["ip"]) ) {
                  echo "<span class=\"badge bg-$detail_color opacity-75 text-lowercase\">" . $ip["ip"] . "</span>";
                  echo "&nbsp;";
                }
                if ( isset($ip["ipv6"]) ) {
                  echo "<span class=\"badge bg-$detail_color opacity-75 text-lowercase\">" . $ip["ipv6"] . "</span>";
                  echo "&nbsp;";
                }
              }
              echo "</div>";
            echo "</td></tr>";
          }
        echo "
        </tbody>
        </table>
        </div>";




        echo "</div>
      </div>
    </div>";




    if ( is_auth() && $is_debug ) {
      echo "<div class=\"container-fluid px-lg-5\">
      <div class=\"row\">

        <div class=\"col\">
          <div class=\"table-responsive\">
          <table class=\"table table-borderless\">
          <thead class=\"thead-light\">
            <tr><th class=\"fs-3 fw-bold text-uppercase\" scope=\"col\">debug</th></tr>
          </thead>
          <tbody>
            <tr><td>";


      echo "<div class=\"accordion accordion-flush\" id=\"accordion_debug\">

      <div class=\"accordion-item\">
        <h2 class=\"accordion-header\">
          <button class=\"accordion-button collapsed\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#flush-collapse_1\" aria-expanded=\"false\" aria-controls=\"flush-collapse_1\">
            <p class=\"text text-primary fw-bold text-decoration-none\">PHP \$_GET</p>
          </button>
        </h2>
        <div id=\"flush-collapse_1\" class=\"accordion-collapse collapse\" data-bs-parent=\"#accordion_debug\">
          <div class=\"accordion-body\">
          <pre>" . print_r($_GET, true) . "</pre>
          </div>
        </div>
      </div>

      <div class=\"accordion-item\">
        <h2 class=\"accordion-header\">
          <button class=\"accordion-button collapsed\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#flush-collapse_2\" aria-expanded=\"false\" aria-controls=\"flush-collapse_2\">
            <p class=\"text text-primary fw-bold text-decoration-none\">PHP \$_POST</p>
          </button>
        </h2>
        <div id=\"flush-collapse_2\" class=\"accordion-collapse collapse\" data-bs-parent=\"#accordion_debug\">
          <div class=\"accordion-body\">
          <pre>" . print_r($_POST, true) . "</pre>
          </div>
        </div>
      </div>

      <div class=\"accordion-item\">
        <h2 class=\"accordion-header\">
          <button class=\"accordion-button collapsed\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#flush-collapse_3\" aria-expanded=\"false\" aria-controls=\"flush-collapse_3\">
            <p class=\"text text-primary fw-bold text-decoration-none\">PHP \$_SERVER</p>
          </button>
        </h2>
        <div id=\"flush-collapse_3\" class=\"accordion-collapse collapse\" data-bs-parent=\"#accordion_debug\">
          <div class=\"accordion-body\">
          <pre>" . print_r($_SERVER, true) . "</pre>
          </div>
        </div>
      </div>

      <div class=\"accordion-item\">
        <h2 class=\"accordion-header\">
          <button class=\"accordion-button collapsed\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#flush-collapse_4\" aria-expanded=\"false\" aria-controls=\"flush-collapse_4\">
            <p class=\"text text-primary fw-bold text-decoration-none\">PHP \$_COOKIE</p>
          </button>
        </h2>
        <div id=\"flush-collapse_4\" class=\"accordion-collapse collapse\" data-bs-parent=\"#accordion_debug\">
          <div class=\"accordion-body\">
          <pre>" . print_r($_COOKIE, true) . "</pre>
          </div>
        </div>
      </div>

      </div>";

            echo "</td></tr>

          </tbody>
          </table>
          </div>
        </div>

      </div>
    </div>";
    }



  echo "</main>

  </body>
</html>";


$microtime_stop = func_microtime_float();
// echo "<div class=\"alert alert-secondary\" role=\"alert\">";
echo "<p class=\"text-sm-end fs-6 fst-italic text-secondary text-opacity-50\">";
echo "page générée en " . round($microtime_stop - $microtime_start, 3) . "s&nbsp;";
echo "</p>";
// echo "</div>";


// echo "<pre>" . print_r($_SERVER, true) . "</pre>";

?>
