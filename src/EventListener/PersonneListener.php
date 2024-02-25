<?php

namespace App\EventListener;

use App\Event\AddPersonneEvent;
use App\Event\ListAllPersonneEvent;
use Psr\Log\LoggerInterface;

class PersonneListener
{
    public function __construct(
        private LoggerInterface $logger
    )
    {

    }
    public function onPersonneAdd( AddPersonneEvent $event)
    {
        $this->logger->debug("cc je suis en train decouter evenement personne.add et une personne vient detre ajouter et c'est ".$event->getPersonne()->getName());
    }
    public function onListAllPersonne( ListAllPersonneEvent $event)
    {
        $this->logger->debug("tout le nombre de personne dans la base  ".$event->getNbPersonne());
    }

}