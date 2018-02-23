#!/bin/bash

### BEGIN INIT INFO
# Provides: maintenance.sh
# Required-Start:
# Required-Stop:
# Default-Start: 2 3 4 5
# Default-Stop: 0 1 6
# Short-Description: Script de maintenance des tables MyIsam pour le projet SIBD
# Description: Script de maintenance des tables MyIsam pour le projet SIBD
### END INIT INFO
case "$1" in

    inspect)
        echo 'Inspecting the cheval tables ...'
        rm /var/www/sibd/storage/logs/cron/inspect.log
        echo "Last execution : `date '+%d-%m-%Y %H:%M:%S'`" > /var/www/sibd/storage/logs/cron/inspect.log
        for i in /var/lib/mysql/cheval/*.MYI; do myisamchk -d -c -i -s $(echo $i| cut -f 1 -d '.') &>> /var/www/sibd/storage/logs/cron/inspect.log;done;
        ;;
    defragment)
        echo 'Repairing and defragmenting the cheval tables ...'
        rm /var/www/sibd/storage/logs/cron/defragment.log
        echo "Last execution : `date '+%d-%m-%Y %H:%M:%S'`" > /var/www/sibd/storage/logs/cron/defragment.log
        for i in /var/lib/mysql/cheval/*.MYI; do myisamchk -a -r –e $(echo $i| cut -f 1 -d '.') &>> /var/www/sibd/storage/logs/cron/defragment.log;done;
        ;;
    optimize)
        echo 'Optimizing the cheval tables ...'
        rm /var/www/sibd/storage/logs/cron/optimize.log
        echo "Last execution : `date '+%d-%m-%Y %H:%M:%S'`" > /var/www/sibd/storage/logs/cron/optimize.log
        for i in /var/lib/mysql/cheval/*.MYI; do myisamchk -a -d $(echo $i| cut -f 1 -d '.') &>> /var/www/sibd/storage/logs/cron/optimize.log;done;
    ;;
esac
exit 0
