### Boost Ruby development environment with RAMDISK


Create a mount folder

		sudo mkdir /mnt/ramdisk

Create ramdisk in boot process

		/etc/fstab

		#RAMDISK
		tmpfs      /mnt/ramdisk tmpfs      defaults,size=512M 0 0
		tmpfs      /var/log     tmpfs      defaults,noatime        0    0
		tmpfs      /tmp         tmpfs      defaults,noatime,mode=1777    0    0

Mount ramdisk

		sudo mount /mnt/ramdisk

Create backup folder

		sudo mkdir /var/ramdisk-backup

Create a new init.d file

		#! /bin/sh 
		# /etc/init.d/ramdisk.sh
		#

		### BEGIN INIT INFO
		# Provides:          ramdisk
		# Required-Start:    $remote_fs $syslog
		# Required-Stop:     $remote_fs $syslog
		# Default-Start:     2 3 4 5
		# Default-Stop:      0 1 6
		# Short-Description: Start daemon at boot time
		# Description:       Enable ramdisk service
		### END INIT INFO
		 
		case "$1" in
		  start)
		    echo "Copying files to ramdisk"
		    rsync -av /var/ramdisk-backup/ /mnt/ramdisk/
		    echo [`date +"%Y-%m-%d %H:%M"`] Ramdisk Synched from HD >> /var/log/ramdisk_sync.log
		    ;;
		  sync)
		    echo "Synching files from ramdisk to Harddisk"
		    echo [`date +"%Y-%m-%d %H:%M"`] Ramdisk Synched to HD >> /var/log/ramdisk_sync.log
		    rsync -av --delete --recursive --force /mnt/ramdisk/ /var/ramdisk-backup/
		    ;;
		  stop)
		    echo "Synching logfiles from ramdisk to Harddisk"
		    echo [`date +"%Y-%m-%d %H:%M"`] Ramdisk Synched to HD >> /var/log/ramdisk_sync.log
		    rsync -av --delete --recursive --force /mnt/ramdisk/ /var/ramdisk-backup/
		    ;;
		  *)
		    echo "Usage: /etc/init.d/ramdisk {start|stop|sync}"
		    exit 1
		    ;;
		esac

		exit 0

Change permission of this file to executable.

Setup startup process

		sudo update-rc.d ramdisk defaults 00 99

Test it with

		sudo service ramdisk start
		sudo service ramdisk stop

