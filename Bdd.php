<?php

class Bdd
{
    private $host;
    private $dbName;
    private $user;
    private $password;
    private $db;

    public function __construct($host, $nameDB, $user, $password)
    {
        $this->host = $host;
        $this->dbName = $nameDB;
        $this->user = $user;
        $this->password = $password;
        $this->connect();
    }

    public function connect() {
        $this->db = new PDO('mysql:host='.$this->host.';dbname='.$this->dbName, $this->user, $this->password);
    }

    public function getContacts() {
        $tabContacts = array();
        $requete = 'select * from contact';
        $result = $this->db->query($requete);

        while ($tab = $result->fetch(PDO::FETCH_ASSOC)) {
            $tabContacts[] = new Contact($tab['nom'], $tab['prenom']);
        }
        return $tabContacts;
    }

    public function getContact(Contact $contact) {
        $exist = false;
        $requete = 'select * from contact where nom = ? and prenom = ?';
        $stmt = $this->db->prepare($requete);
        $stmt->execute(array($contact->getNom(), $contact->getPrenom()));

        if ($stmt->fetch()) {
            $exist = true;
        }

        return $exist;
    }

    public function postContact(Contact $contact) {
        $requete = 'insert into contact(nom, prenom) values(?, ?)';
        $stmt = $this->db->prepare($requete);
        $stmt->execute(array($contact->getNom(), $contact->getPrenom()));
    }

    public function deleteContact(Contact $contact) {
        $requete = 'delete from contact where nom = ? and prenom = ?';
        $stmt = $this->db->prepare($requete);
        $stmt->execute(array($contact->getNom(), $contact->getPrenom()));

    }
}