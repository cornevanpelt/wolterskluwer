# Schulinck Assessment
Dit is een Proof-of-Concept applicatie voor een pizza bestelservice.
De intentie is om een OO backend te demonsteren welke als basis (of puur alleen als PoC) zou kunnen dienen voor een productie-waardige applicatie als er later bv. nog een gebruiksvriendelijke front-end wordt toegevoegd en zaken als exception handling, caching en validatie beter geregeld worden.
De applicatie is opgezet op basis van Symfony 6 waardoor hij al direct een goede structuur heeft. De business logic op een object georienteerde manier opgezet waardoor de classes ook hergebruikt zouden kunnen worden in een andere structuur.

**Omgevingsvereisten**
- PHP >=8.0
- MySQL server
- Composer
- Git
- Symfony CLI (optioneel, kan gebruikt worden in stap 7)

**Stappen om de applicatie te runnen**
1) Clone deze repo naar een projectfolder (bv. "pizza-poc") 
2) Ga naar de root folder van het project (bv. "pizza-poc")
3) Run "composer install"
4) Configureer de database connectie door middel van de DATABASE_URL in /.env (bv. DATABASE_URL="mysql://user:pass@127.0.0.1:3306/dbname?serverVersion=8.0.28&charset=utf8mb4")
5) Maak de database aan "bin/console doctrine:database:create"
6) Maak de inhoud van de database aan door het runnen van de migrations "bin/console doctrine:migrations:execute"
7) Start de build-in web server "symfony server" (of de build-in PHP webserver als Symfony CLI niet geinstalleerd is "php -S localhost:8000 -t public")
9) Ga naar http://localhost:{port} (zie output van stap 7 om de poort te bepalen)
10) Door middel van de links bovenaan de pagina kan tussen de klantpagina en de admin pagina voor elk van de pizzeria's worden gewisseld

**Aannames bij het maken van deze PoC applicatie**
- Front-end is niet belangrijk in deze PoC, het gaat om het OO-design van de backend. Er is dus geen gebruik gemaakt van npm, webpack of bootstrap.
- Exception handling, caching en validatie hebben geen prioriteit in deze PoC en zijn dus niet productiewaardig geimplementeerd.
- De views die gebruikt zijn, zijn super-fugly by design :-)

**Verbeteringen om applicatie productie-waardig te maken**
1) Implementeren betere exception handling, logging, caching en validatie
2) Toevoegen authenticatie/authorisatie
3) 