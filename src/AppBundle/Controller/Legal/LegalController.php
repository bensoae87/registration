<?php
/**
 * Copyright (c) 2018. Anime Twin Cities, Inc.
 *
 * This project, including all of the files and their contents, is licensed under the terms of MIT License
 *
 * See the LICENSE file in the root of this project for details.
 */

namespace AppBundle\Controller\Legal;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LegalController extends Controller
{
    /**
     * @Route("/privacy", name="privacy")
     */
    public function showLogin()
    {
        return $this->render('legal/privacy.html.twig');
    }
}
