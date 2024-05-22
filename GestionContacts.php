<?php
require_once 'Contact.php';
require_once 'Bdd.php';

class GestionContacts
{
    public $tabContacts;
    public $bdd;

    public function __construct()
    {
        $this->tabContacts = array();
        $this->bdd = new Bdd("localhost", "contacts", "root", "");
        $this->tabContacts = $this->bdd->getContacts();
    }

    public function triNomAsc()
    {
        usort($this->tabContacts,
            function ($c1, $c2) {
                return $c1->getNom() <=> $c2->getNom();
            }
        );
    }

    public function triPrenomAsc()
    {
        usort($this->tabContacts,
            function ($c1, $c2) {
                return $c1->getPrenom() <=> $c2->getPrenom();
            }
        );
    }

    public function ajoutContact(Contact $contact) {
        if (!$this->bdd->getContact($contact)) {
            $this->bdd->postContact($contact);
            $this->tabContacts[] = $contact;
        } else {
            echo '<div class="center-align">Ce contact déja existe</div>';
        }
    }

    public function supprimeContact(Contact $contact) {
        $this->bdd->deleteContact($contact);
        $this->tabContacts = $this->bdd->getContacts();
    }

    public function afficheContacts()
    {
        echo '<ul>';
        foreach ($this->tabContacts as $contact) {
            echo '<li>'.$contact->getNom().' '.$contact->getPrenom().'</li>';
        }
        echo '</ul>';
    }
}