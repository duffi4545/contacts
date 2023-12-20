# Contacts

Tento projekt přináší základní obsluhu repozitáře na kontakty. Vytváření mazání a úpravu kontaktů.

# Tvorba

Při tvorbě nebylo specifikováno jakým stylem ukládat telefonní číslo jestli s předvolbou nebo bez a jak s ním bude dále nakládáno pro zjednodušení testování jsem zvolik kratší zápis čísel.

Dále nebyli specifikovány další entity keré by měli být vytvořeny z toho důvodu jsem se rozhodl pro jednu entitu a nijak jsem jí dále nedělil.

Jelikož se jedná o základní zobrazení, připsal jsem jen nezbytné css a js pro zobrazení srozumitelného modalu.

Dále nybli specifikovány technologie a proto jsem pro vývoj používal mysql databázi

## Instalace Docker
Pro instalaci je potřeba composer a docker nebo vlastní databáze

## Spuštění kontejnerů pomocí Docker Compose (vytvoření testovací databáze)
`docker-compose up -d`

## Instalace Composer závislostí
spustit v adresáři projektu: 
`composer install`

## Vygenerování tabulek
`php bin/console doctrine:database:create
php bin/console make:migration
php bin/console doctrine:migrations:migrate`

## Spuštění lokálního vývojového serveru
`php -S 127.0.0.1:8000 -t public`

## Instalace dokončena. Aplikace je nyní dostupná na http://localhost:8000



## Instalace vlastní DB

## Spuštění kontejnerů pomocí Docker Compose (vytvoření testovací databáze)
`v souboru .env nastavit proměnou DATABASE_URL na adresu vaší databáze`

## Instalace Composer závislostí
spustit v adresáři projektu: 
`composer install`

## Vygenerování tabulek
`php bin/console doctrine:database:create
php bin/console make:migration
php bin/console doctrine:migrations:migrate`

## Spuštění lokálního vývojového serveru
`php -S 127.0.0.1:8000 -t public`

## Instalace dokončena. Aplikace je nyní dostupná na http://localhost:8000
