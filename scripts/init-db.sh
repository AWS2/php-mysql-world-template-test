sudo apt-get update
sudo apt-get install -y mysql-server
sudo mysql < init-db.sql
sudo mysql < world.sql
