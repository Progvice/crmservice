# CRM-Service Oy näytetyö

Hei! Tässä minun näytetyöni henkilötietojärjestelmästä. 

## Asennusohjeet

### Docker asennus

Helpoin tapa asentaa koko järjestelmä on käyttää Dockeria. 
Voit yksinkertaisesti kirjoittaa tässä kansiossa komennon "docker compose up --build" ja sovellus lähtee rakentamaan itse itseään. Saat toimivan boilerplaten sovellukselle.

Docker hoitaa myös SQL taulujen luonnin automaattisesti. 

Kun Docker on asentanut kaikki paketit valmiiksi, niin suuntaa
selaimen puolelle ja avaa osoite http://localhost:8080

### Manuaalinen asennus

Manuaalinen asennus on hieman monimutkaisempi prosessi. Jos käytät
manuaalista asennusta, niin sinulla on todennäköisesti olemassaoleva
LAMP/XAMPP stack asennettuna valmiiksi. 

1. Kopioi kaikki sisältö www-kansiosta suoraan sinun palvelimen document root kansioon. 
2. Muuta konfiguraatiota niin, että palvelimen root kansio osoittaa /public kansioon
3. Varmista, että AllowOverride on kytketty päälle 
4. Kopioi config-example.json tiedostoksi "config.json"
5. Määritä tietokannan asetukset manuaalisesti kohdasta "development" -> "database". 
6. Mene tietokantaan käyttäen PHPMyAdmin, shelliä tmv työkalua mitä käytät tietokantojen hallintaan
7. Luo uusi tietokanta nimeltä "crmdb"
8. Aja tietokannassa /sql/init.sql -tiedosto mikä löytyy www-kansiosta

## API endpointit

API endpointit löydät osoitteesta /swagger. 

Rajapinta poikkeaa hieman perinteisestä REST rajapinnasta niin, että jokaisen entiteetin jälkeen osoitteeseen tulee toimenpide mitä tehdään. Esimerkkinä

- /personel/create
- /personel/delete/[id]
- /personel/update/[id]
- /personel/read
- /personel/read/[id]

Rajapinnassa ei ole lisättynä minkäänlaista authentikaatiota, mutta oikeassa tilanteessa tällainen olisi tarpeen. Rajapinnassa ei ole myöskään minkään muotoista rate limiting järjestelmää. 

## Näkymäpuoli

Olen samalla luonut käytettäväksi yksinkertaisen näkymäpuolen joka visualisoi datanhallintaa ja käyttää tätä rajapintaa jonka olen luonut. Näkymäpuoli ei ole kuitenkaan täysin valmis, koska priorisoin nimenomaan rajapinnan tekemiseen ajan. 

## Miksi päätin tehdä omalla ohjelmistokehyksellä?

Halusin haastaa itseäni ja kehittää samalla työkaluja tämän ohjelmistokehyksen ympärille. Toteutuksen olisi voinut tehdä nopeammin perinteisellä täysin puhtaalla PHP toteutuksella tai Laravelilla. Olen siitä huolimatta ylpeä siitä mitä olen saanut aikaiseksi. 

## Lopputerveiset

Minulla oli hauskaa tätä projektia tehdessä! Toivottavasti harkitsette minua jatkoon. 