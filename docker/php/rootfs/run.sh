#!/bin/bash

got_sigkill=0

_term() { 
  echo "Caught SIGTERM signal!" 
  kill -QUIT "$child" 2>/dev/null
}

trap _term SIGTERM

usermod -u `stat -c '%u' /var/www/html` www-data
groupmod -g `stat -c '%u' /var/www/html` www-data

sudo -u www-data composer install &

child=$!
wait "$child"
if [ "$got_sigkill" -eq "1" ]; then
    exit
fi

/usr/local/bin/apache2-foreground &

child=$!
wait "$child"
