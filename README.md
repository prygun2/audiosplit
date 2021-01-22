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

## Controls

| Key | Info | Required | Default value |
| ------ | ------ | ------ | ------ |
| xml |  The path to an XML file with silence intervals | true | - |
| chapter | The silence duration which reliably indicates a chapter transition, milliseconds | false | 3000 |
| long | The maximum duration of a segment, after which the chapter will be broken up into multiple segments, milliseconds | false | 300000 |
| part | A silence duration which can be used to split a long chapter (always shorter than the silence duration used to split chapters), milliseconds | false | 1000 |
