<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace TestApp\Controller;

use Avolle\Title\Controller\Component\TitleComponent;
use Cake\Controller\Controller;

/**
 * Application Controller
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 * @property \Avolle\Title\Controller\Component\TitleComponent $Title
 */
class AppController extends Controller
{
    /**
     * @var \Avolle\Title\Controller\Component\TitleComponent
     */
    protected TitleComponent $Filter;

    /**
     * Initialization hook method.
     *
     * @return void
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Flash');
        $this->loadComponent('Avolle/Title.Title');
    }
}
