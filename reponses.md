# Réponses aux questions (TP 4)

## Partie 0
* *0.3 :* Non, `$v1` et `$v2` ne partagent pas la même valeur de `$marque`. Chaque objet créé avec le mot-clé `new` est une instance indépendante de la classe. La pseudo-variable `$this` désigne uniquement l'objet courant qui appelle la méthode.

## Partie 1
* *1.1 :* `echo $p->getName()` affiche `Sara Hachimi` et `echo $p->nom` affiche `Hachimi` car ils sont `public`. Les trois instructions suivantes génèrent une erreur fatale (`Fatal error: Uncaught Error: Cannot access private property` et `Call to private method`) car les membres `private` sont accessibles uniquement de l'intérieur de la classe.
* *1.2 :* Le CIN est une information sensible. En `public`, il serait accessible et modifiable directement depuis l'extérieur de la classe sans aucun contrôle.
* *1.3 :* Non, une méthode `private` est sollicitée en interne par une autre méthode `public` de la classe pour structurer le code (comme `__toString()` dans la Partie 4).
* *1.4 :* Non, depuis l'extérieur de la classe, le comportement reste identique : un attribut `protected` n'est accessible que depuis l'intérieur de la classe et de ses classes dérivées.

## Partie 2
* *2.1.a :* `new Voiture("Noire")` fonctionne et garde la vitesse par défaut `0`. `new Voiture(120)` convertit automatiquement `120` en chaîne `"120"` en typage faible PHP, mais déclencherait une `TypeError` si le typage strict (`strict_types=1`) était activé.
* *2.1.b :* La promotion de propriétés permet de déclarer et d'initialiser les attributs directement dans les paramètres du constructeur, ce qui évite de répéter la déclaration des attributs et les affectations avec `$this->`.
* *2.2.a :* PHP affiche une erreur fatale (`Cannot redeclare Personne::__construct()`), car il est interdit de définir deux méthodes portant le même nom dans une même classe.
* *2.2.b :* On utilise un seul constructeur avec des valeurs par défaut sur ses paramètres (`string $nom = "", string $prenom = ""`).
* *2.2.c :* Une méthode statique de fabrique (*named constructor*) est une méthode `public static` qui retourne une nouvelle instance de la classe (`new self(...)`) construite à partir d'un paramètre spécifique comme un tableau.

## Partie 3
* *3.2 :* Sans `__set()`, `$p->nom = "X"` déclenche une erreur d'accès à une propriété `private`. Avec `__set()`, PHP appelle automatiquement cette méthode magique lors de l'écriture vers une propriété inaccessible.
* *3.3 :* Oui, si `__set()` accepte n'importe quelle valeur sans vérification, l'encapsulation n'est plus protégée. Il faut ajouter des conditions de validation dans `__set()` avant d'affecter la valeur.

## Partie 4
* *4.1 :* `__toString()` fait partie de la classe `Personne`, elle a donc accès aux méthodes `private` de cette même classe.
* *4.2 :* PHP convertit l'entier en chaîne de caractères en mode normal, mais déclenche une `TypeError` si `strict_types=1` est actif car le type de retour déclaré est `: string`.
* *4.3 :* `__toString()` permet de traiter directement un objet comme une chaîne de caractères. Exemples : l'affichage direct avec `echo $p;` et la concaténation avec du texte (`"Infos : " . $p`).

## Partie 5
* *5.1 :* Non, le mot de passe n'apparaît pas dans la chaîne car `__serialize()` ne retourne que `nom` et `age`.
* *5.2 :* Sans `__serialize()`, `serialize($u)` enregistre toutes les propriétés de l'objet, y compris le mot de passe en clair (`secret123`), ce qui expose une donnée sensible.
* *5.3 :* Après `unserialize()`, `$motDePasse` est réinitialisé à `""`. Dans une application réelle, il faudrait recharger cette information depuis une base de données sécurisée ou demander une nouvelle authentification.
* *5.4 :* Passer des données utilisateur à `unserialize()` expose au risque de *PHP Object Injection* : un attaquant peut forger une chaîne sérialisée qui déclenchera automatiquement des méthodes magiques (`__destruct()`, `__wakeup()`) lors de la désérialisation. Pour échanger des données en toute sécurité, on utilise `json_encode()` et `json_decode()`.

## Partie 6
* *6.1.b :* Non, `$c->miauler()` produit une erreur (`Call to undefined method Chien::miauler()`), car `Chien` et `Chat` héritent toutes deux d'`Animal` mais `Chien` n'hérite pas de `Chat`.
* *6.2.a :* Sans `parent::__construct($nom)`, l'attribut `$nom` n'est pas initialisé, ce qui provoque une erreur lors de l'appel à `presentation()` (`Typed property Personne::$nom must not be accessed before initialization`).
* *6.2.b :* `$nom` est `protected` pour être accessible à la fois dans `Personne` et dans la classe dérivée `Etudiant`, tout en restant inaccessible de l'extérieur.
* *6.3.a :*
  1) `Fatal error: Cannot override final method Base::afficher()`
  2) `Fatal error: Class SousOutil cannot extend final class Outil`
  3) `Fatal error: Cannot modify readonly property Produit::$reference`
* *6.3.b :* `readonly` est utile pour un identifiant unique ou un code ISBN qui ne doit pas changer après l'initialisation. `final` est utile pour verrouiller une méthode critique ou une classe utilitaire qui ne doit pas être étendue.
* *6.4.a :* L'appel à `$this->getAge()` provoque une erreur (`Call to private method Personne::getAge() from scope Etudiant`). Il faut la déclarer en `protected` dans `Personne`.
* *6.4.b :* Car un attribut `private` est strictement limité à la classe où il est déclaré et n'est pas accessible dans les classes filles.
* *6.4.c :* Réutiliser `parent::__toString()` évite la duplication de code et facilite la maintenance.

## Partie 7
* *7.1 :* Il manque l'opérateur `+` dans l'expression `($this->montant 1 * $this->interet / 100)` (erreur de syntaxe).
* *7.2 :* La formule correcte est : `$this->montant = $this->montant * (1 + $this->interet / 100);`.
* *7.3 :* Non, l'ordre des paramètres dans le code (`$interet, $montantInitial`) est inversé par rapport à l'énoncé (« un montant initial et un intérêt »), ce qui risque de fausser les valeurs passées lors de l'instanciation.

## Questions de synthèse
1) *Différence entre classe et objet :* Une classe est un modèle (un plan) qui regroupe des propriétés et des méthodes. Un objet est une instance concrète de cette classe créée avec le mot-clé `new`.
2) *Trois avantages de la POO :* Meilleure organisation du projet, facilité de maintenance du code, et transmission des propriétés via l'héritage pour éviter la duplication de code.
3) *Pourquoi `private` ou `protected` :* Pour respecter le principe d'encapsulation, qui consiste à masquer les attributs d'un objet aux utilisateurs extérieurs du code.
4) *Différence entre `private` et `protected` avec l'héritage :* Un membre `private` est accessible uniquement à l'intérieur de la classe qui le déclare, tandis qu'un membre `protected` est accessible dans la classe mère et dans toutes ses classes filles.
5) *Visibilité des méthodes magiques :* Oui, les méthodes magiques doivent être déclarées `public` car elles sont appelées automatiquement par PHP depuis l'extérieur. Les exceptions tolérées sont `__construct()`, `__destruct()` et `__clone()`.