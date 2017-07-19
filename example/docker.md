# How To Run These Scripts With Docker

1. start a container: `docker run --rm -p 3306:3306 -e MYSQL_ALLOW_EMPTY_PASSWORD=yes mariadb`
2. execute the script: `mysql -u root -h 127.0.0.1 -P 3306 < music_db.sql`
3. connect to database: `mysql -u root -h 127.0.0.1 -P 3306 music_db`