create user 'admin'@'%' identified by "admin123";
grant all on *.* to 'admin'@'%';
flush privileges;
