<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 19.06.2015
 * Time: 16:32
 */

namespace Ibw\BlogBundle\Tests\Services;


use Doctrine\ORM\EntityManager;
use Ibw\BlogBundle\Services\RequestHelper;
use Ibw\JobeetBundle\Utils\Messages\Error;
use Ibw\JobeetBundle\Utils\Messages\Success;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

class RequestHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SecurityContext | \PHPUnit_Framework_MockObject_MockObject
     */
    private $securityContextMock;

    /**
     * @var EntityManager| \PHPUnit_Framework_MockObject_MockObject
     */
    private $emMock;

    /**
     * @var RequestHelper
     */
    private $service;

    public function setUp()
    {
        $this->securityContextMock = $this->getMock(SecurityContext::class, [], [], '', false);
        $this->emMock = $this->getMock(EntityManager::class, [], [], '', false);
        $this->service = new RequestHelper($this->emMock, $this->securityContextMock);
    }

    public function testParseRequestAction()
    {
        $request = new Request();
        $request->request->set('ping', '{"ok":"asdffasdfa"}');

        $error = $this->service->parseRequestAction($request, true);
        $expectedError = new Error("missing some required parameters", 400);
        $this->assertEquals($expectedError, $error);
    }

}
