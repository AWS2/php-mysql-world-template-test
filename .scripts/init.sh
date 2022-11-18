apt-get update
#apt-get install -y php php-mysql php-curl php-mbstring php-xml
apt-get install -y firefox-geckodriver

# php setup
export COMPOSER_HOME="$HOME/.config/composer"
composer install

