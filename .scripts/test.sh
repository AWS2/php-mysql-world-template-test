
docker-compose -f .scripts/docker-compose.yml up -d
#mysql < .scripts/init-db.sql

geckodriver &
.scripts/run.sh &

echo "Sleeping some seconds to let DB start"
sleep 10
mysql -u admin -padmin123 -h 127.0.0.1 < .scripts/world.sql

vendor/bin/phpunit .tests
EXIT=$?

.scripts/clean.sh

exit $EXIT
