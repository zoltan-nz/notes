    sudo apt-get update
    sudo apt-get dist-upgrade
    sudo apt-get install mc build-essential curl zsh git

option: install virtual machine support files

install ubuntu tweak
install google chrome
uninstall thunderbird

http://jeromejaglale.com/doc/unix/ubuntu_sudo_without_password

###rvm, mysql install process
    \curl -L https://get.rvm.io | sudo bash
    sudo adduser username rvm
    rvm autolibs enable
    rvm install ruby-2.0.0
    
    sudo apt-get install mysql-server mysql-client mysql-workbench libmysqlclient-dev libmysqlclient18
setup gemrc because of ri docs
    

###ZSH
    curl -L https://github.com/robbyrussell/oh-my-zsh/raw/master/tools/install.sh | sh

Making zsh default:

    chsh -s $(which zsh)
    
Log out log back

- fonts
