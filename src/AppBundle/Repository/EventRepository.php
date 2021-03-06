<?php
/**
 * Copyright (c) 2018. Anime Twin Cities, Inc.
 *
 * This project, including all of the files and their contents, is licensed under the terms of MIT License
 *
 * See the LICENSE file in the root of this project for details.
 */

namespace AppBundle\Repository;

use AppBundle\Entity\Event;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Component\HttpFoundation\Session\Session;

class EventRepository extends EntityRepository
{
    /**
     * @return Event[]
     */
    public function findAll()
    {
        return $this->findBy([], ['year' => 'DESC']);
    }

    /**
     * @return Event|null
     */
    public function getCurrentEvent()
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $queryBuilder->select('e')
            ->from(Event::class, 'e')
            ->where("e.active = :active")
            ->setParameter('active', true);

        try {
            return $queryBuilder->getQuery()->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }

    /**
     * @return Event|null
     */
    public function getSelectedEvent()
    {
        $session = new Session();
        $selectedEvent = $session->get('selectedEvent');
        if (!$selectedEvent) {

            return $this->getCurrentEvent();
        }

        return $this->getEventFromYear($selectedEvent);
    }

    /**
     * @return String
     */
    public function getCurrentEventYear()
    {
        return $this->getCurrentEvent()->getYear();
    }

    /**
     * @param String $year
     * @return Event|null
     */
    public function getEventFromYear($year)
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $queryBuilder->select('e')
            ->from(Event::class, 'e')
            ->where("e.year = :year")
            ->setParameter('year', $year);

        try {
            return $queryBuilder->getQuery()->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }
}
