<?php
namespace Calendar;

class Events {

    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Récupère les évènements commençant entre 2 dates
     * @param \DateTime $start
     * @param \DateTime $end
     * @return array
     */
    public function getEventsBetween (\DateTime $start, \DateTime $end): array {
        $sql = "SELECT * FROM evenements WHERE date_debut BETWEEN '{$start->format('Y-m-d 00:00:00')}' AND '{$end->format('Y-m-d 23:59:59')}'";
        $statement = $this->pdo->query($sql);
        $results = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $results;
    }

    /**
     * Récupère les évènements commençant entre 2 dates indexé par jour
     * @param \DateTime $start
     * @param \DateTime $end
     * @return array
     */
    public function getEventsBetweenByDay (\DateTime $start, \DateTime $end): array {
        $events = $this->getEventsBetween($start, $end);
        $days = [];
        foreach($events as $event) {
            $date = explode(' ', $event['date_debut'])[0];
            if (!isset($days[$date])) {
                $days[$date] = [$event];
            } else {
                $days[$date][] = $event;
            }
        }
        return $days;
    }

    /**
     * Récupère un évènement
     * @param int $id
     * @return Event
     * @throws \Exception
     */
    public function find (int $id): \Calendar\Event {
        require "Event.php";
        $statement = $this->pdo->query("SELECT * FROM evenements WHERE id_evenement = $id LIMIT 1");
        $statement->setFetchMode(\PDO::FETCH_CLASS, \Calendar\Event::class);
        $result = $statement->fetch();
        if ($result === false) {
            throw new \Exception('Aucun résultat n\'a été trouvé');
        }
        return $result;
    }

}
