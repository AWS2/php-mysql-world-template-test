# pre test

# setup DB
docker-compose -f .scripts/docker-compose.yml up -d
# setup firefox driver & PHP web server
.scripts/run.sh &

# wait for DB to start
echo "Sleeping some seconds to let DB start"
sleep 10

# DB initialization
#mysql < .scripts/init-db.sql
mysql -u admin -padmin123 -h 127.0.0.1 < .scripts/world.sql
