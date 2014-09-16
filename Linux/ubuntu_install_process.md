Tmux tutorial: https://www.digitalocean.com/community/tutorials/how-to-install-and-use-tmux-on-ubuntu-12-10--2


    sudo apt-get update
    sudo apt-get dist-upgrade
    sudo apt-get install mc build-essential curl zsh git mysql-server mysql-client mysql-workbench libmysqlclient-dev libmysqlclient18 nodejs libxslt1-dev

option: install virtual machine support files

install ubuntu tweak
install google chrome
uninstall thunderbird

http://jeromejaglale.com/doc/unix/ubuntu_sudo_without_password

### Install grup customizer

    sudo add-apt-repository ppa:danielrichter2007/grub-customizer
    sudo apt-get update
    sudo apt-get install grub-customizer

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

MacbookPro, setup boot:
    
    bless --device /dev/disk0s1 --setBoot --legacy

### MacTel Support install

    sudo add-apt-repository ppa:mactel-support/ppa
    sudo apt-get install macfanctld pommed
    
### Everything together

```bash
sudo add-apt-repository ppa:webupd8team/java -y && sudo apt-get update && sudo apt-get dist-upgrade -y && sudo apt-get install mc htop build-essential curl zsh git nodejs libmagickwand-dev libxslt1-dev oracle-java8-installer libpq-dev -y 

curl -L https://github.com/robbyrussell/oh-my-zsh/raw/master/tools/install.sh | sh
chsh -s $(which zsh) 

\curl -L https://get.rvm.io | bash

npm install -g bower grunt ember-cli
```

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

### Install Google Chrome on Linux Mint

wget -q -O - https://dl-ssl.google.com/linux/linux_signing_key.pub | sudo apt-key add -

sudo sh -c 'echo "deb http://dl.google.com/linux/chrome/deb/ stable main" >> /etc/apt/sources.list.d/google-chrome.list'


### Setup Chrome as default browser on Linux Mint

Step 1

    sudo cp /opt/google/chrome/google-chrome.desktop /usr/share/applications
    
Step 2

Now default application settings will work.
debian/oracle_vbox.asc -O- | sudo apt-key add -
    sudo apt-get update
    sudo apt-get install virtualbox-4.2

### Bleeding Edge

    http://bleedingedge.sourceforge.net/

### Install Greybird and Blackbird style on Linux Mint

    sudo add-apt-repository ppa:shimmerproject/ppa
    sudo apt-get update
    sudo apt-get install shimmer-themes

### php5.5 repos

    sudo add-apt-repository ppa:ondrej/php5
    
### Grub paramters

    GRUB_GFXMODE=1440x900x32
    GRUB_GFXPAYLOAD=1440x900x32

### Mount samba folder

 sudo mount -t cifs -o user=name //samba/shared/folder ~/local/folder

### Install latest virtualbox

    su -sh -c ' echo "deb http://download.virtualbox.org/virtualbox/debian raring contrib" >> /etc/apt/sources.list'
    wget -q http://download.virtualbox.org/virtualbox/

### PostgreSQL Configuration

    https://help.ubuntu.com/community/PostgreSQL

### Ubuntu install on Retina Display Macbook Pro

    - Upragde to Ubuntu 14.04
    - Not a real solution yet.
    - Change resolution to 1920x1200 or smaller.

### External monitor color fix for Retina Macbook Pro (and resolution fix for login screen)

/etc/lightdm/xrandr.sh

    #!/bin/bash
    xrandr --output HDMI1 --set "Broadcast RGB" "Full"
    xrandr --output HDMI2 --set "Broadcast RGB" "Full"
    xrandr --output HDMI1 --primary --mode 1920x1080
    
    sudo chmod +x /etc/lightdm/xrandr.sh
    
/etc/lightdm/lightdm.conf

    display-setup-script=/etc/lightdm/xrandr.sh

### Install dev env

- Mongod DB: http://docs.mongodb.org/manual/tutorial/install-mongodb-on-ubuntu/
- ElasticSearch: http://www.elasticsearch.org/guide/en/elasticsearch/reference/current/setup-repositories.html
- RabitMQ: http://www.rabbitmq.com/install-debian.html
- Redis: http://tosbourn.com/2013/12/redis/install-latest-version-redis-ubuntu/
- NodeJS: https://github.com/joyent/node/wiki/Installing-Node.js-via-package-manager#ubuntu-mint-elementary-os
- PhantomJS: http://phantomjs.org/download.html
 
### Nautilus in XFCE without forcing background change

    gconftool-2 -s -t bool /apps/nautilus/preferences/show_desktop false
    gconftool-2 -s -t bool /desktop/gnome/background/draw_background false

### Install Elasticsearch, MongoDB, RabitMQ

Elasticsearch install steps in one liner:

```
cd ~/Downloads && wget https://download.elasticsearch.org/elasticsearch/elasticsearch/elasticsearch-1.3.2.deb && sudo dpkg -i elasticsearch-1.3.2.deb && sudo update-rc.d elasticsearch defaults 95 10 && sudo /etc/init.d/elasticsearch start
```
More info about Elasticsearch installation: https://www.digitalocean.com/community/tutorials/how-to-install-elasticsearch-on-an-ubuntu-vps

Mongodb install steps in one liner:
```
sudo apt-key adv --keyserver hkp://keyserver.ubuntu.com:80 --recv 7F0CEB10 && echo 'deb http://downloads-distro.mongodb.org/repo/ubuntu-upstart dist 10gen' | sudo tee /etc/apt/sources.list.d/mongodb.list && sudo apt-get update && sudo apt-get install -y mongodb-org && sudo service mongod start
```
Source: http://docs.mongodb.org/manual/tutorial/install-mongodb-on-ubuntu/

RabitMQ install steps in one liner:
```
cd ~/Downloads && wget http://www.rabbitmq.com/rabbitmq-signing-key-public.asc && sudo apt-key add rabbitmq-signing-key-public.asc && echo 'deb http://www.rabbitmq.com/debian/ testing main' | sudo tee /etc/apt/sources.list.d/rabitmq.list && sudo apt-get update && sudo apt-get install -y rabbitmq-server
```
Source: http://www.rabbitmq.com/install-debian.html
