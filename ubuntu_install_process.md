    sudo apt-get update
    sudo apt-get dist-upgrade
    sudo apt-get install mc build-essential curl zsh git mysql-server mysql-client mysql-workbench libmysqlclient-dev libmysqlclient18 nodejs libxslt1-dev

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
    
    #sudo apt-get install mysql-server mysql-client mysql-workbench libmysqlclient-dev libmysqlclient18
setup gemrc because of ri docs
setup pryrc
    

###ZSH
    curl -L https://github.com/robbyrussell/oh-my-zsh/raw/master/tools/install.sh | sh

Making zsh default:

    chsh -s $(which zsh)
    
Log out log back

fonts => /usr/share/fonts
 
### Installing java 7

    sudo add-apt-repository ppa:webupd8team/java
    sudo apt-get update
    sudo apt-get install oracle-java7-installer
    
### Generating SSH keys

https://help.github.com/articles/generating-ssh-keys

### AHCI enable on linux MacBook Pro 3,1

Insert following in /boot/grub/grub.cfg

    setpci -s 0:1f.2 90.b=60
    
http://blogs.gnome.org/diegoe/2012/10/14/enabling-sata-ahci-on-a-linux-macbook31/

### MacTel Support install

    sudo add-apt-repository ppa:mactel-support/ppa
    sudo apt-get install macfanctld pommed
    
### Everything together

    sudo add-apt-repository ppa:webupd8team/java -y && sudo apt-get update && sudo apt-get dist-upgrade -y && sudo apt-get install mc build-essential curl zsh git mysql-server mysql-client mysql-workbench libmysqlclient-dev libmysqlclient18 nodejs libxslt1-dev oracle-java7-installer -y && curl -L https://github.com/robbyrussell/oh-my-zsh/raw/master/tools/install.sh | sh && chsh -s $(which zsh) && \curl -L https://get.rvm.io | sudo bash && sudo adduser username rvm

### Everything together for vagrant

    sudo apt-get update && sudo apt-get dist-upgrade -y && sudo apt-get install mc build-essential curl zsh git mysql-server mysql-client mysql-workbench libmysqlclient-dev libmysqlclient18 nodejs htop -y && curl -L https://github.com/robbyrussell/oh-my-zsh/raw/master/tools/install.sh | sh 
        
    chsh -s $(which zsh) 
    
    \curl -L https://get.rvm.io | sudo bash 
    
    sudo adduser username rvm
    
### rmagic

    sudo apt-get install libmagickwand-dev

### Install Sublime Text

Source: http://www.technoreply.com/how-to-install-sublime-text-2-on-ubuntu-12-04-unity/

    sudo add-apt-repository ppa:webupd8team/sublime-text-2
    sudo apt-get update
    sudo apt-get install sublime-text-installer


### Pidgin settings

Disable notification: http://www.patanachai.com/2009/05/disable-online-user-notification-in.html

### Get back the old scrollbar:

http://cres2657.wordpress.com/2013/05/29/how-to-get-the-old-scroll-bars-back-in-ubuntu-13-04/

    gsettings set com.canonical.desktop.interface scrollbar-mode normal
    
### Install Grup Customizer

    sudo add-apt-repository ppa:danielrichter2007/grub-customizer
    sudo apt-get update
    sudo apt-get install grub-customizer

### Install wifi on linux mint

    sudo apt-get --purge --reinstall install bcmwl-kernel-source

### Setup Chrome as default browser on Linux Mint

Step 1

    sudo cp /opt/google/chrome/google-chrome.desktop /usr/share/applications
    
Step 2

Now default application settings will work.
