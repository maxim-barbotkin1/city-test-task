- name : Maxim
- surname : Barbotkin
- company: Jagaad

## installation guide
- git clone
- for start docker run cd docker/ && docker-compose build && docker-compose up
- run docker exec task_php cp .env.example .env 
- add your WEATHER_API_KEY={your key} to .env
- run docker exec task_php composer install  
- run docker exec task_php php artisan key:generate
- run docker exec task_php php artisan config:cache

## tests guide
- endpoints to see cities with forecast /cities/forecasts
- endpoints to see single cities with forecast /cities/{cityId}/forecasts
- for start unit tests run docker exec task_php ./vendor/bin/phpunit
- application use psr2 coding standard and tool CodeSniffer to prove this  
- for start CodeSniffer run docker exec task_php ./vendor/bin/phpcs
- application use code analyser Mess Detector 
- for start Mess Detector run docker exec task_php vendor/bin/phpmd app text ./phpmd-ruleset.xml
- for check open api config go by this url /swager.json
- for check open api html go by this url /swager.html
