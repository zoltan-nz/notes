#!/usr/bin/env bash

wget -q -O - https://dl-ssl.google.com/linux/linux_signing_key.pub | sudo apt-key add - && sudo sh -c 'echo "deb http://dl.google.com/linux/chrome/deb/ stable main" >> /etc/apt/sources.list.d/google-chrome.list' && sudo add-apt-repository ppa:no1wantdthisname/ppa -y && sudo add-apt-repository ppa:no1wantdthisname/openjdk-fontfix --yes && sudo add-apt-repository ppa:webupd8team/sublime-text-3 -y && sudo apt-get update && sudo apt-get dist-upgrade -y && sudo apt-get install mc htop build-essential curl zsh git libmagickwand-dev libxslt1-dev  libpq-dev libcurl4-gnutls-dev vim fontconfig-infinality default-jdk sublime-text-installer -y && curl -sL https://deb.nodesource.com/setup | sudo bash - && sudo apt-get update && sudo apt-get install nodejs google-chrome-stable -y

curl -L https://github.com/robbyrussell/oh-my-zsh/raw/master/tools/install.sh | sh
chsh -s $(which zsh)

\curl -L https://get.rvm.io | bash

npm install -g bower grunt gulp ember-cli

sh -c 'echo "alias node=nodejs" >> ~/.zshrc'
