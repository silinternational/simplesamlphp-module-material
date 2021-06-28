#!/usr/bin/env bash

set -x

# establish a signal handler to catch the SIGTERM from a 'docker stop'
# reference: https://medium.com/@gchudnov/trapping-signals-in-docker-containers-7a57fdda7d86
term_handler() {
  apache2ctl stop
  exit 143; # 128 + 15 -- SIGTERM
}
trap 'kill ${!}; term_handler' SIGTERM

export XDEBUG_CONFIG="remote_enable=1 remote_host="$REMOTE_DEBUG_IP

apt-get update
apt-get install php-xdebug

cd /data

# Send info about this image's O/S and PHP version to our logs.
cat /etc/*release | grep PRETTY
php -v | head -n 1

apache2ctl -k start -D FOREGROUND

# endless loop with a wait is needed for the trap to work
while true
do
  tail -f /dev/null & wait ${!}
done
