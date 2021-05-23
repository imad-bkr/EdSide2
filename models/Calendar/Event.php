<?php

namespace Calendar;

class Event {

    private $id_evenement;
    private $nom;
    private $description;
    private $date_debut;
    private $date_fin;

    public function getId(): int { return $this->id_evenement; }
    public function getName (): ?string { return $this->nom; }
    public function getDescription (): string { return $this->description ?? ''; }
    public function getStart (): \DateTime { return new \DateTime($this->date_debut); }
    public function getEnd (): \DateTime { return new \DateTime($this->date_fin); }

}
