<?php

namespace AppBundle\Controller\Manage;

use AppBundle\Entity\BadgeType;
use AppBundle\Entity\Registration;
use AppBundle\Entity\RegistrationStatus;
use AppBundle\Entity\RegistrationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class ManageController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Route("/manage/", name="listRegistrations")
     * @Security("has_role('ROLE_USER')")
     *
     * @param Request $request
     * @return Response
     */
    public function listRegistrationsPage(Request $request)
    {
        $searchText = $request->query->get('search');
        $page = $request->query->get('page');

        $registrationTypeId = '';
        $registrationTypeDescription = 'All';
        if ($request->query->has('registrationTypeId')) {
            $registrationTypeId = $request->query->get('registrationTypeId');
            $registrationType = $this->getDoctrine()
                ->getRepository(RegistrationType::class)
                ->find($registrationTypeId);
            if ($registrationType) {
                $registrationTypeDescription = $registrationType->getDescription();
            } else {
                $registrationTypeId = 'all';
            }
        }

        $registrationStatusId = '';
        $registrationStatusDescription = 'All';
        if ($request->query->has('registrationStatusId')) {
            $registrationStatusId = $request->query->get('registrationStatusId');
            $registrationStatus = $this->getDoctrine()
                ->getRepository(RegistrationStatus::class)
                ->find($registrationStatusId);
            if ($registrationStatus) {
                $registrationStatusDescription = $registrationStatus->getDescription();
            } else {
                $registrationStatusId = 'active';
            }
        }

        $badgeTypeId = '';
        $badgeTypeDescription = 'All';
        if ($request->query->has('badgeTypeId')) {
            $badgeTypeId = $request->query->get('badgeTypeId');
            $badgeType = $this->getDoctrine()
                ->getRepository(BadgeType::class)
                ->find($badgeTypeId);
            if ($badgeType) {
                $badgeTypeDescription = $badgeType->getDescription();
            } else {
                $badgeTypeId = 'all';
            }
        }

        if ($page <= 1 || !is_numeric($page)) {
            $page = 1;
        }

        /** @var RegistrationType[] $registrationTypes */
        $registrationTypes = $this->getDoctrine()->getRepository(RegistrationType::class)->findAll();
        /** @var RegistrationStatus[] $registrationStatuses */
        $registrationStatuses = $this->getDoctrine()->getRepository(RegistrationStatus::class)->findAll();
        /** @var BadgeType[] $badgeTypes */
        $badgeTypes = $this->getDoctrine()->getRepository(BadgeType::class)->findAll();

        $vars = [
            'registrationTypes' => $registrationTypes,
            'registrationStatuses' => $registrationStatuses,
            'badgeTypes' => $badgeTypes,
            'current_RegistrationTypeId' => $registrationTypeId,
            'current_RegistrationStatusId' => $registrationStatusId,
            'current_BadgeTypeId' => $badgeTypeId,
            'current_RegistrationType' => $registrationTypeDescription,
            'current_RegistrationStatus' => $registrationStatusDescription,
            'current_BadgeType' => $badgeTypeDescription,
            'searchText' => $searchText,
            'page' => $page,
        ];

        return $this->render('manage/manage.html.twig', $vars);
    }

    /**
     * @Route("/registration/list/ajax", name="ajaxRegistrationList")
     * @Security("has_role('ROLE_USER')")
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function ajaxRegistrationList(Request $request)
    {
        $returnJson = [];

        $searchText = $request->query->get('search');
        $page = $request->query->get('page');

        $registrationTypeId = $request->query->get('registrationTypeId');
        $registrationType = null;
        if ($registrationTypeId) {
            $registrationType = $this->getDoctrine()
                ->getRepository(RegistrationType::class)
                ->find($registrationTypeId);
        }

        $registrationStatusId = $request->query->get('registrationStatusId');
        $registrationStatuses = [];
        if ($registrationStatusId == 'active') {
            $registrationStatuses = $this->getDoctrine()
                ->getRepository(RegistrationStatus::class)
                ->findAllActive();
        } elseif ($registrationStatusId == 'inactive') {
            $registrationStatuses = $this->getDoctrine()
                ->getRepository(RegistrationStatus::class)
                ->findAllInactive();
        } else {
            $registrationStatus = $this->getDoctrine()
                ->getRepository(RegistrationStatus::class)
                ->find($registrationStatusId);
            if ($registrationStatus) {
                $registrationStatuses[] = $registrationStatus;
            }
        }

        $badgeTypeId = $request->query->get('badgeTypeId');
        $badgeType = null;
        if ($badgeTypeId) {
            $badgeType = $this->getDoctrine()
                ->getRepository(BadgeType::class)
                ->find($badgeTypeId);
        }

        if ($page <= 1 || !is_numeric($page)) {
            $page = 1;
        }

        $returnJson = $this->getDoctrine()->getRepository(Registration::class)->searchFromManageRegistrations(
            $searchText,
            $page,
            $registrationType,
            $registrationStatuses,
            $badgeType
        );

        return new JsonResponse($returnJson);
    }
}
