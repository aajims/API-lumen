#!bin/bash

mysql --execute "CREATE DATABASE IF NOT EXISTS 'homestead';" --user=root
mysql --execute "USE 'homestead';" --user=root
mysql --execute "CREATE USER 'homestead'@'127.0.0.1' IDENTIFIED BY 'secret';" --user=root
mysql --execute "GRANT ALL PRIVILEGES ON *.* TO 'homestead'@'127.0.0.1';" --user=root

mysql --execute "CREATE DATABASE IF NOT EXISTS 'framework';" --user=root
mysql --execute "USE 'homestead';" --user=root
mysql --execute "CREATE USER 'framework'@'127.0.0.1' IDENTIFIED BY 'secret';" --user=root
mysql --execute "GRANT ALL PRIVILEGES ON *.* TO 'framework'@'127.0.0.1';" --user=root

mysql --execute "FLUSH PRIVILEGES;" --user=root
