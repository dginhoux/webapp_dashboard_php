# webapp_dashboard_php



## DESCRIPTION

It's my own PHP web Dashboard. <br />
It use bootstrap, jquery and bootswatch for better UI.



## FEATURES

* dynamix apps lists from traefik reverse proxy
* dns resolver test
* disk usage of specified mount point
* display docker swarm informations
* custom url content
* integratation of grafana embedded panels


## WARNING

May be difficult to out of the box : <br />
* use traefik API to list publisheds apps
* use docker socket tcp API to get my 2 swarms clusters informations
* read tls certs files from a folder
<br />
<br />
<br />
**A little dirty ** all in 3 PHP files : index, config, functions.


## EXAMPLES

![example.png](example.png)


## REQUIREMENTS

WebServer like apache, nginx, caddy able to use PHP<br />
PHP v7.x, PHP v8.x<br />

#### INCLUDEDS DEPENDENCIES

* jquery : https://jquery.com
* bootstrap : https://getbootstrap.com

Updates must be manually in ./lib folder and specify used version in config.php

#### SUBMODULES DEPENDENCIES

* bootswatch : https://github.com/thomaspark/bootswatch



## INSTALLATION

On the root folder of the vhost

#### FROM GIT

```shell
git clone https://github.com/dginhoux/webapp_dashboard_php dashboard
```





## AUTHOR

Dany GINHOUX - https://github.com/dginhoux



## LICENSE

MIT
