<?php


namespace App\Model;

class LocationManager extends AbstractManager
{
    const TABLE = 'locations';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function selectPicture($picture)
    {
        $statement = $this->pdo->prepare("SELECT  locations.picture  FROM  locations
        join stories s on locations.id = s.locations_id");
        $statement->bindValue('location_id', $picture, \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch();
    }
}
