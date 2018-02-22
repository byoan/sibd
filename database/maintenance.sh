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
        for i in *.MYI; do myisamchk -d -c -i -s /var/lib/mysql/cheval/$(echo $i| cut -f 1 -d '.');done;
        ;;
    defragment)
        echo 'Repairing and defragmenting the cheval tables ...'
        for i in *.MYI; do myisamchk -a -r –e /var/lib/mysql/cheval/$(echo $i| cut -f 1 -d '.');done;
        ;;
    optimize)
        echo 'Optimizing the cheval tables ...'
        for i in *.MYI; do myisamchk -a -d /var/lib/mysql/cheval/$(echo $i| cut -f 1 -d '.');done;
    ;;
esac
exit 0
