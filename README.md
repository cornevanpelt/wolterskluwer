# Schulinck Assessment
Dit is een Proof-of-Concept applicatie voor een pizza bestelservice.   

De intentie is om een OO backend te demonsteren welke als basis (of puur alleen als PoC) zou kunnen dienen voor een productie-waardige applicatie als er later bv. nog een gebruiksvriendelijke front-end wordt toegevoegd en zaken als exception handling, caching en validatie fatsoenlijk geregeld worden.

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
6) Maak de inhoud van de database aan door het runnen van de migrations "bin/console doctrine:migrations:execute" (er zit hard-coded dummy data in de migrations)
7) Start de build-in web server "symfony serve" (of de PHP build-in webserver als Symfony CLI niet geinstalleerd is "php -S localhost:8000 -t public")
8) Ga naar http://localhost:{port} (zie output van stap 7 om de poort te bepalen)
9) Door middel van de links bovenaan de pagina kan tussen de klantpagina en de admin pagina voor elk van de pizzeria's worden gewisseld

**Aannames bij het maken van deze PoC applicatie**
- Front-end is niet belangrijk in deze PoC, het gaat om het OO-design van de backend. Er is dus geen gebruik gemaakt van npm, webpack, encore en/of bootstrap.
- Exception handling, caching en validatie hebben geen prioriteit in deze PoC en zijn dus niet productiewaardig geimplementeerd.
- De views die gebruikt zijn, zijn super-fugly by design :-)
- Er is geen authenticatie/authorisatie mechanisme geimplementeerd omdat dat buiten de scope van de PoC valt.
- De communicatie-voorkeur voor het sturen van status updates kan per user worden ingesteld, daarvoor is er in de PoC één user aangemaakt (elke gebruiker kan meerdere communicatie voorkeuren hebben, bv. e-mail EN SMS).
- Er is "gekozen" voor Doctrine ORM met Mysql als achterliggende database.
- Doordat gebruik is gemaakt van interfaces voor de OrderService en de entity repositories kan de storage methode relatief makkelijk worden aangepast, er kunnen andere repository implementaties worden geinjecteerd in de OrderService en ook de implementatie van de OrderService zelf kan indien nodig vervangen worden als de OrderServiceInterface maar geimplementeerd wordt. De Controllers kunnen dan dezelfde calls blijven doen naar de OrderService omdat de OrderServiceInterface wordt geinjecteerd in de controllers en niet de concrete implementatie van de OrderService zelf.
- Het is in deze PoC niet mogelijk om meerdere pizza's te bestellen binnen één bestelling. Elke bestelling bestaat dus maar uit één pizza.
- Punt 4 van de opdracht is nog niet uitgewerkt, de database bevat wel flags die aangeven of een pizzaketen afhaal en/of bezorgmogelijkheden heeft maar in het bestelproces wordt daar momenteel nog niks mee gedaan (dus... -5 punten!)

**Verbeteringen om applicatie productie-waardig te maken**
- Implementeren (betere) exception handling, logging, caching en validatie.
- Toevoegen authenticatie/authorisatie mechanisme (aparte login voor klanten en voor admin gebruiker(s) van een specifieke pizzaketen).
- Implementeren van een goede front-end (bootstrap / interactiever formulier / eventueel one page application - bijvoorbeeld Vue.js / fatsoenlijk design).
- Gebruik maken van webpack (via Encore) en stylesheets en javascript uit de twig templates halen en in aparte scripts stoppen.
- Implementeren status update event (dus het uitsturen van e-mails en SMS en eventuele andere communicatiekanalen mogelijk maken).
- Toevoegen unit tests (indien required).
- Ondersteuning toevoegen voor meerdere pizza's koppelen aan één bestelling.
- Workflow implementeren voor de order status, zodat een order niet zomaar van de ene status naar de andere gezet kan worden, maar het formulier rekening houdt met de workflow die een order kan/moet doorlopen.
- ...en implementeren van nog een hoop andere requirements die de business ongetwijfeld heeft...