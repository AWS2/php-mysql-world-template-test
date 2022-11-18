apt-get update
#apt-get install -y php php-mysql php-curl php-mbstring php-xml
apt-get install -y firefox-geckodriver

# php setup
export COMPOSER_HOME="$HOME/.config/composer"
composer install

# DB users
echo "Init DB"
mysql -u root -proot -h 127.0.0.1 < scripts/init-db.sql
mysql -u root -proot -h 127.0.0.1 < scripts/world.sql
