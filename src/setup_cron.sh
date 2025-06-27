#!/bin/bash
# This script should set up a CRON job to run cron.php every 24 hours.
# You need to implement the CRON setup logic here.

 CRON_CMD="0 0 * * * /usr/bin/php $(pwd)/cron.php"
( crontab -l | grep -v -F "$CRON_CMD" ; echo "$CRON_CMD" ) | crontab -
echo "CRON job installed to send XKCD comics every Day"
