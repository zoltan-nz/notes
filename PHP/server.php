#!/usr/bin/env php
<?php

if (1 != assert_options(ASSERT_ACTIVE) or 1 != assert_options(ASSERT_WARNING)):
    trigger_error('Assertion ignored');
endif;

// Create a tmp folder in actual project folder.
$return_var = 0;
echo passthru('mkdir -p '.getcwd().'/tmp', $return_var);
assert ('0 == $return_var');

// Create a log folder.
$return_var = 0;
echo passthru('mkdir -p '.getcwd().'/log', $return_var);
assert ('0 == $return_var');

// Use php-cgi only if php-fpm not available
$php_process = proc_open("env PHP_FCGI_CHILDREN=15 php-cgi -b 127.0.0.1:7233", array(), $pipes);

// Create the standard fastcgi_params file in tmp folder.
file_put_contents(getcwd()."/tmp/fastcgi_params", '
fastcgi_param  QUERY_STRING       $query_string;
fastcgi_param  REQUEST_METHOD     $request_method;
fastcgi_param  CONTENT_TYPE       $content_type;
fastcgi_param  CONTENT_LENGTH     $content_length;

fastcgi_param  SCRIPT_NAME        $fastcgi_script_name;
fastcgi_param  REQUEST_URI        $request_uri;
fastcgi_param  DOCUMENT_URI       $document_uri;
fastcgi_param  DOCUMENT_ROOT      $document_root;
fastcgi_param  SERVER_PROTOCOL    $server_protocol;
fastcgi_param  HTTPS              $https if_not_empty;

fastcgi_param  GATEWAY_INTERFACE  CGI/1.1;
fastcgi_param  SERVER_SOFTWARE    nginx/$nginx_version;

fastcgi_param  REMOTE_ADDR        $remote_addr;
fastcgi_param  REMOTE_PORT        $remote_port;
fastcgi_param  SERVER_ADDR        $server_addr;
fastcgi_param  SERVER_PORT        $server_port;
fastcgi_param  SERVER_NAME        $server_name;

# PHP only, required if PHP was built with --enable-force-cgi-redirect
fastcgi_param  REDIRECT_STATUS    200;
');

file_put_contents(getcwd()."/tmp/mime.types", '
types {
    text/html                             html htm shtml;
    text/css                              css;
    text/xml                              xml;
    image/gif                             gif;
    image/jpeg                            jpeg jpg;
    application/javascript                js;
    application/atom+xml                  atom;
    application/rss+xml                   rss;

    text/mathml                           mml;
    text/plain                            txt;
    text/vnd.sun.j2me.app-descriptor      jad;
    text/vnd.wap.wml                      wml;
    text/x-component                      htc;

    image/png                             png;
    image/tiff                            tif tiff;
    image/vnd.wap.wbmp                    wbmp;
    image/x-icon                          ico;
    image/x-jng                           jng;
    image/x-ms-bmp                        bmp;
    image/svg+xml                         svg svgz;
    image/webp                            webp;

    application/font-woff                 woff;
    application/java-archive              jar war ear;
    application/json                      json;
    application/mac-binhex40              hqx;
    application/msword                    doc;
    application/pdf                       pdf;
    application/postscript                ps eps ai;
    application/rtf                       rtf;
    application/vnd.apple.mpegurl         m3u8;
    application/vnd.ms-excel              xls;
    application/vnd.ms-fontobject         eot;
    application/vnd.ms-powerpoint         ppt;
    application/vnd.wap.wmlc              wmlc;
    application/vnd.google-earth.kml+xml  kml;
    application/vnd.google-earth.kmz      kmz;
    application/x-7z-compressed           7z;
    application/x-cocoa                   cco;
    application/x-java-archive-diff       jardiff;
    application/x-java-jnlp-file          jnlp;
    application/x-makeself                run;
    application/x-perl                    pl pm;
    application/x-pilot                   prc pdb;
    application/x-rar-compressed          rar;
    application/x-redhat-package-manager  rpm;
    application/x-sea                     sea;
    application/x-shockwave-flash         swf;
    application/x-stuffit                 sit;
    application/x-tcl                     tcl tk;
    application/x-x509-ca-cert            der pem crt;
    application/x-xpinstall               xpi;
    application/xhtml+xml                 xhtml;
    application/xspf+xml                  xspf;
    application/zip                       zip;

    application/octet-stream              bin exe dll;
    application/octet-stream              deb;
    application/octet-stream              dmg;
    application/octet-stream              iso img;
    application/octet-stream              msi msp msm;

    application/vnd.openxmlformats-officedocument.wordprocessingml.document    docx;
    application/vnd.openxmlformats-officedocument.spreadsheetml.sheet          xlsx;
    application/vnd.openxmlformats-officedocument.presentationml.presentation  pptx;

    audio/midi                            mid midi kar;
    audio/mpeg                            mp3;
    audio/ogg                             ogg;
    audio/x-m4a                           m4a;
    audio/x-realaudio                     ra;

    video/3gpp                            3gpp 3gp;
    video/mp2t                            ts;
    video/mp4                             mp4;
    video/mpeg                            mpeg mpg;
    video/quicktime                       mov;
    video/webm                            webm;
    video/x-flv                           flv;
    video/x-m4v                           m4v;
    video/x-mng                           mng;
    video/x-ms-asf                        asx asf;
    video/x-ms-wmv                        wmv;
    video/x-msvideo                       avi;
}
');

// Create nginx.conf in tmp folder.
file_put_contents(getcwd()."/tmp/nginx.conf", '
events {
    worker_connections  1024;
}

worker_processes 1;

pid '.getcwd().'/tmp/nginx.pid;

http {
    include '.getcwd().'/tmp/mime.types;
    default_type application/octet-stream;
    client_max_body_size 10m;
    sendfile on;
    gzip on;
    keepalive_timeout 65;

    # Use this with php-fpm instead of old php-cgi
    upstream phpfcgi {
        server 127.0.0.1:9000;
    }

    server {
        listen 8082;
        server_name 0.0.0.0;
        server_tokens off;

        root '.getcwd().'/web;

        index index.php index.html index.htm;

        access_log '.getcwd().'/log/access.log;
        error_log '.getcwd().'/log/error.log;

        location / {
            try_files $uri /index.php?$args;
        }

        location ^~ /frontend_dev.php/ {
            try_files $uri /frontend_dev.php;
            try_files $uri /frontend_dev.php?q=$uri&$args /index.php?q=$uri&$args;
        }

        location ^~ /sf/ {
            root '.getcwd().'/lib/vendor/symfony/data/web/;
        }

        location ~ \.php$ {
            fastcgi_split_path_info ^(.+\.php)(/.+)$;
            try_files $uri =404;
            # fastcgi_pass phpfcgi;
            # Old php-cgi:
            fastcgi_pass 127.0.0.1:7233;
            fastcgi_index index.php;
            fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
            include '.getcwd().'/tmp/fastcgi_params;
            fastcgi_param PATH_INFO $fastcgi_path_info;
            fastcgi_param PATH_TRANSLATED $document_root$fastcgi_path_info;
            fastcgi_param HTTPS off;
        }
    }
}
');

// Testing nginx script.
echo passthru('nginx -c '.getcwd().'/tmp/nginx.conf -t', $return_var);
assert ('0 == $return_var');
usleep(200000); echo "Launching Nginx\n";

// Launching nginx
echo passthru('nginx -c '.getcwd().'/tmp/nginx.conf', $return_var);
assert ('0 == $return_var');

// Waiting for a keypress in console...
echo "\nPress Enter key to exit.\n";
passthru('read null');

echo "\nShutting down Nginx\n";
echo passthru('nginx -c '.getcwd().'/tmp/nginx.conf -s stop', $return_var);
assert ('0 == $return_var');

// In case of usage of php-cgi
echo "\nShutting down php-cgi (fcgi)\n";
$php_proc_terminate = proc_terminate($php_process);
$php_proc_close = proc_close($php_process);
assert(-1 != $php_proc_close);

?>