
docker-compose -f .scripts/docker-compose.yml up -d
#mysql < .scripts/init-db.sql
mysql < .scripts/world.sql

geckodriver &
.scripts/run.sh &

vendor/bin/phpunit .tests
EXIT=$?

killall geckodriver
killall php

docker-compose -f .scripts/docker-compose.yml down

exit $EXIT
