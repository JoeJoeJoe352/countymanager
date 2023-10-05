Projekt beüzemelése:
- projekt klónozása
- composer install
- npm install
- countymanager mysql adatbázis létrehozása, .env file-ban a csatlakozási adatok megadása
- php artisan migrate parancs kiadása - adatbázis táblák létrehozása
- php artisan db:seed parancs kiadása - county tábla feltöltése adatokkal


tesztek futtatása:
- countymanager_test tábla létrehozása
- php vendor\bin\phpunit parancsal lefutnak a tesztek
- egyedi teszteset lefuttatása: "composer test SaveTest test_error_creating_wrong_county"