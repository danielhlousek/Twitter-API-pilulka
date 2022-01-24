# Twitter api pilulka

## Instalace

Celá aplikace běží v dockeru v jednom containeru

Je třeba vyplnit klíče dev účtu twitteru v souboru .env pro připojení k api.

### Build
```sh
docker-compose up
```

### Dále je potřeba dostat se do containeru
```sh
docker exec -it php-apache bash
```

### V containeru spustit
```sh
composer install
composer run post-update-cmd
```

Aplikace běží na adrese http://localhost:8080/

K dispozici jsou tyto url:
http://localhost:8080/twitter/posts/{počet_příspěvků} (volitelný argument)
http://localhost:8080/api/posts/{počet_příspěvků} (volitelný argument)

## Popis a zdroje
Nechtěl jsem pro toto řešení použít žádný velký FW, tak jsem použil tento malinký FW https://github.com/ttulka/minimalist-mvc-framework-in-php,
který jsem lehce upravil.

Pro napojení na twitter api jsem použil https://github.com/noweh/twitter-api-v2-php - používá api v2 a tweets/search/recent endpoint - bez academic developer účtu 
vrací bohužel jen tweety, za posledních 7 dní (proto jich není 100). Jiné vhodnější endpointy (/2/tweets/search/all) vracející více výsledků nelze použít se základním developer účtem.

Dále jsem použil šablony latte a bootstrap.