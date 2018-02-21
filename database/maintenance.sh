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
        echo 'Inspecting all tables...'
        # /usr/bin/myisamchk -d -c -i -s /var/lib/mysql/test
        /usr/bin/mysqlcheck --all-databases -u root -proot
        ;;
    repair)
        echo 'Repairing all tables...'
        /usr/bin/myisamchk -a -r –e /var/lib/mysql/test
        ;;
    optimize)
        echo 'Optimizing all tables...'
        /usr/bin/myisamchk -a -d /var/lib/mysql/test
    ;;
esac
exit 0
