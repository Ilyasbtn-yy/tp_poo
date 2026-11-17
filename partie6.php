<?php

// 6.1
class Animal {
    public function manger(): void {
        echo "Je mange." . PHP_EOL;
    }
}

class Chien extends Animal {
    public function aboyer(): void {
        echo "Wouf !" . PHP_EOL;
    }
}

class Chat extends Animal {
    public function miauler(): void {
        echo "Miaou !" . PHP_EOL;
    }
}

$c = new Chien();
$c->manger();
$c->aboyer();

$chat = new Chat();
$chat->manger();
$chat->miauler();

// 6.4
class Personne {
    public string $nom;
    public string $prenom;
    private string $dateNaissance;
    private string $villeNaissance;
    private string $cin;

    public function __construct(
        string $nom,
        string $prenom,
        string $dateNaissance,
        string $villeNaissance,
        string $cin
    ) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->dateNaissance = $dateNaissance;
        $this->villeNaissance = $villeNaissance;
        $this->cin = $cin;
    }

    protected function getAge(): int {
        $naissance = new DateTime($this->dateNaissance);
        $aujourdhui = new DateTime();
        return $naissance->diff($aujourdhui)->y;
    }

    public function __toString(): string {
        return $this->prenom . " " . $this->nom . " (" . $this->getAge() . " ans)";
    }
}

class Etudiant extends Personne {
    private string $cne;

    public function __construct(
        string $nom,
        string $prenom,
        string $dateNaissance,
        string $villeNaissance,
        string $cin,
        string $cne
    ) {
        parent::__construct($nom, $prenom, $dateNaissance, $villeNaissance, $cin);
        $this->cne = $cne;
    }

    public function getCne(): string {
        return $this->cne;
    }

    public function __toString(): string {
        return parent::__toString() . " | CNE : " . $this->cne;
    }
}

$etudiants = [];
$etudiants[] = new Etudiant("Alami", "Ahmed", "2003-04-12", "Marrakech", "EE111111", "G130001");
$etudiants[] = new Etudiant("Bennani", "Sara", "2004-08-21", "Rabat", "AA222222", "G130002");
$etudiants[] = new Etudiant("Chraibi", "Omar", "2002-11-05", "Fès", "CD333333", "G130003");
$etudiants[] = new Etudiant("Idrissi", "Khadija", "2003-01-30", "Agadir", "JB444444", "G130004");
$etudiants[] = new Etudiant("Tazi", "Yassine", "2004-06-18", "Casablanca", "BK555555", "G130005");

foreach ($etudiants as $e) {
    echo $e . PHP_EOL;
}

?>