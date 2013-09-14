### SSH key problem

The server's host key is not cached in the registry. You have no guarantee that the server is the computer you think it is.

Source; http://stackoverflow.com/questions/4931384/git-server-host-key-not-cached

Try doing a "set | grep -i ssh" from the Git Bash prompt

If your setup is like mine you probably have these set:

GIT_SSH='C:\Program Files (x86)\PuTTY\plink.exe'
PLINK_PROTOCOL=ssh
SVN_SSH='"C:\\Program Files (x86)\\PuTTY\\plink.exe"'
I did a

unset GIT_SSH
unset PLINK_PROTOCOL
unset GIT_SVN
and it worked after that,.. I guess putty saves its keys somewhere else as $HOME/.ssh or something... (I've also had a problem on a box where $HOME was set to "C:\Users\usrnam" instead of "/C/Users/usrnam/"

anyway, your mileage may vary, but that fixed it for me. :-)

(probably just doing the unset GIT_SSH is enough, but I was on a roll)

###Install mysql2 on windows

1. Download connector. http://dev.mysql.com/downloads/connector/c/
2. Copy libmysql.dll in ruby/bin folder.
3. Run this: gem install mysql2 --platform=ruby -- --with-mysql-dir=/c/dev/ruby/lib /mysql-connector-c-6.1.1-winx64