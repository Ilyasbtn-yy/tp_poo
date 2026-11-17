<?php
// 2.1
class Voiture {
    public function __construct(
        public string $couleur = "Blanche",
        public int $vitesse = 0
    ) {}

    public function afficher(): void {
        echo "Couleur : {$this->couleur} | Vitesse : {$this->vitesse} km/h" . PHP_EOL;
    }
}

$v1 = new Voiture();
$v2 = new Voiture("Rouge", 50);
$v1->afficher();
$v2->afficher();

// 2.2 & 2.3
class Personne {
    public function __construct(
        public string $nom = "",
        public string $prenom = ""
    ) {
        if ($this->nom === "" && $this->prenom === "") {
            echo "Création " . __CLASS__ . PHP_EOL;
        }
    }

    public static function depuisTableau(array $data): self {
        return new self($data['nom'] ?? "", $data['prenom'] ?? "");
    }

    public function __destruct() {
        echo "Détruire " . __CLASS__ . PHP_EOL;
    }
}

$p1 = new Personne();
$p2 = new Personne("Hachimi", "Sara");
$p3 = Personne::depuisTableau(["nom" => "Alami", "prenom" => "Youssef"]);

?>