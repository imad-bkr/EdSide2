<?php

namespace Calendar;

class Event {

    private $id_evenement;
    private $nom;
    private $description;
    private $date_debut;
    private $date_fin;
    private $id_groupe;

    public function getId(): int { return $this->id_evenement; }
    public function getName (): string { return $this->nom; }
    public function getDescription (): string { return $this->description ?? ''; }
    public function getStart (): \DateTime { return new \DateTime($this->date_debut); }
    public function getEnd (): \DateTime { return new \DateTime($this->date_fin); }
    public function getIdGroup (): int { return $this->id_evenement; }

    public function setName (string $nom) { $this->nom = $nom; }
    public function setDescription (string $description) { $this->description = $description; }
    public function setStart (string $date_debut) { $this->date_debut = $date_debut;}
    public function setEnd (string $end) { $this->end = $end; }
    public function setIdGroup (int $idGroup) { $this->id_groupe = $idGroup; }

}
