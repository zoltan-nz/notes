# How setup nginx and php on windows

1. Donwload nginx
2. Download php

In nginx.conf:

		location ~ \.php$ {
			root html;
			fastcgi_pass 127.0.0.1:9000;
			fastcgi_index index.php;
			fastcgi_param SCRIPT_FILENAME c:/dev/nginx/html/$fastcgi_script_name;
			include fastcgi_params;
		}


###start-nginx.bat

	@ECHO OFF
	@start /B c:/dev/nginx/php/php-cgi.exe -b 127.0.0.1:9000 -c c:\dev\ngin x\php\php.ini
	@start /B /D c:\dev\nginx\ c:\dev\nginx\nginx.exe

###hidecmd.vbs

	Set oShell = CreateObject ("Wscript.Shell") 
	Dim strArgs
	strArgs = "cmd /c start-nginx.bat"
	oShell.Run strArgs, 0, false

###nginx.conf new settings:

	http {
	    include       mime.types;
	    default_type  application/octet-stream;

	    #log_format  main  '$remote_addr - $remote_user [$time_local] "$request" '
	    #                  '$status $body_bytes_sent "$http_referer" '
	    #                  '"$http_user_agent" "$http_x_forwarded_for"';

	    #access_log  logs/access.log  main;

	    sendfile        on;
	    #tcp_nopush     on;

	    #keepalive_timeout  0;
	    keepalive_timeout  65;

	    #gzip  on;

	    server {
	        listen       80;
	        server_name  localhost;

	        #charset koi8-r;

	        #access_log  logs/host.access.log  main;

	        location / {
	            root   html;
	            index  index.html index.htm;
	        }

	        #error_page  404              /404.html;

	        # redirect server error pages to the static page /50x.html
	        #
	        error_page   500 502 503 504  /50x.html;
	        location = /50x.html {
	            root   html;
	        }

	        # proxy the PHP scripts to Apache listening on 127.0.0.1:80
	        #
	        #location ~ \.php$ {
	        #    proxy_pass   http://127.0.0.1;
	        #}

	        # pass the PHP scripts to FastCGI server listening on 127.0.0.1:9000
	        #
			location ~ \.(php|html|htm)$ {
				fastcgi_pass 127.0.0.1:9000;
				fastcgi_index index.php;
				fastcgi_param SCRIPT_FILENAME c:/dev/nginx/html/$fastcgi_script_name;
				include fastcgi_params;
			}

	        # deny access to .htaccess files, if Apache's document root
	        # concurs with nginx's one
	        #
	        #location ~ /\.ht {
	        #    deny  all;
	        #}
	    }
		
		server {
	        listen       80;
	        server_name  projects;

	        #charset koi8-r;

	        #access_log  logs/host.access.log  main;

	        location / {
	            root   c:/dev/projects;
	            index  index.html index.htm index.php;
	        }

	        #error_page  404              /404.html;

	        # redirect server error pages to the static page /50x.html
	        #
	        error_page   500 502 503 504  /50x.html;
	        location = /50x.html {
	            root   html;
	        }

	        # proxy the PHP scripts to Apache listening on 127.0.0.1:80
	        #
	        #location ~ \.php$ {
	        #    proxy_pass   http://127.0.0.1;
	        #}

	        # pass the PHP scripts to FastCGI server listening on 127.0.0.1:9000
	        #
			location ~ \.(php|html|htm)$ {
				root c:/dev/projects;
				fastcgi_pass 127.0.0.1:9000;
				fastcgi_index index.php;
				fastcgi_param SCRIPT_FILENAME c:/dev/projects/$fastcgi_script_name;
				include fastcgi_params;
			}

	        # deny access to .htaccess files, if Apache's document root
	        # concurs with nginx's one
	        #
	        #location ~ /\.ht {
	        #    deny  all;
	        #}
	    }