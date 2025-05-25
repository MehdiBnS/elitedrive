<?php

namespace elitedrive\Core;

use PDO;
use Exception;

class DbConnect
{
    protected $connection;
    protected $request;

    const SERVER = 'sqlprive-pc2372-001.eu.clouddb.ovh.net:35167';
    const USER = 'cefiidev1444';
    const PASSWORD = 'n8Zi9FPu9';
    const BASE = 'cefiidev1444';

    public function __construct()
    {
        try {
            $this->connection = new PDO('mysql:host=' . self::SERVER . ';dbname=' . self::BASE, self::USER, self::PASSWORD);

            // Activation des erreurs PDO
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Les retours de requête seront en Tableau objet par défaut
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

            // Encodage des caractères spéciaux en "utf8"
            $this->connection->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES utf8");
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}