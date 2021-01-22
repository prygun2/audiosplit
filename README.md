# Book

## Install
1. `git clone https://gitlab.com/veselov.denis/audiobook.git audiobook`
1. `cd audiobook`
1. `composer install`

## Usage without Docker
1. `php index.php --xml "silence-files/silence1.xml" --chapter "3000" --long "900000" --part "1000"`
1. `php index.php --xml "silence-files/silence1.xml" --chapter "3000" --long "900000" --part "1000" > segments.json`

## Docker
1. `docker-compose build app`
1. `docker-compose up -d`

## Usage with Docker
1. `docker-compose exec app php index.php --xml "silence-files/silence1.xml" --chapter "3000" --long "900000" --part "1000"`
1. `docker-compose exec app php index.php --xml "silence-files/silence1.xml" --chapter "3000" --long "900000" --part "1000" > segments.json`
