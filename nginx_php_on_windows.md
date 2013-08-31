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


start-nginx.bat

	@ECHO OFF
	@start /B c:/dev/nginx/php/php-cgi.exe -b 127.0.0.1:9000 -c c:\dev\ngin x\php\php.ini
	@start /B /D c:\dev\nginx\ c:\dev\nginx\nginx.exe

hidecmd.vbs

	Set oShell = CreateObject ("Wscript.Shell") 
	Dim strArgs
	strArgs = "cmd /c start-nginx.bat"
	oShell.Run strArgs, 0, false

