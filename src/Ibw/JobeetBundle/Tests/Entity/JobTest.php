<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 19.06.2015
 * Time: 14:56
 */

namespace Ibw\JobeetBundle\Tests\Entity;


use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Tests\Functional\WebTestCase;
use Ibw\JobeetBundle\Utils\Jobeet as Jobeet;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;
use Doctrine\Bundle\DoctrineBundle\Command\DropDatabaseDoctrineCommand;
use Doctrine\Bundle\DoctrineBundle\Command\CreateDatabaseDoctrineCommand;
use Doctrine\Bundle\DoctrineBundle\Command\Proxy\CreateSchemaDoctrineCommand;
use Symfony\Bridge\Doctrine\DataFixtures\ContainerAwareLoader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Ibw\JobeetBundle\Entity\Job;

class JobTest extends WebTestCase
{
    private $em;
    private $application;

    public function setUp()
    {
        static::$kernel = static::createKernel();
        static::$kernel->boot();

        $this->application = new Application(static::$kernel);

        // drop the database
        $command = new DropDatabaseDoctrineCommand();
        $this->application->add($command);
        $input = new ArrayInput(array(
            'command' => 'doctrine:database:drop',
            '--force' => true
        ));
        $command->run($input, new NullOutput());

        // we have to close the connection after dropping the database so we don't get "No database selected" error
        $connection = $this->application->getKernel()->getContainer()->get('doctrine')->getConnection();
        if ($connection->isConnected()) {
            $connection->close();
        }

        // create the database
        $command = new CreateDatabaseDoctrineCommand();
        $this->application->add($command);
        $input = new ArrayInput(array(
            'command' => 'doctrine:database:create',
        ));
        $command->run($input, new NullOutput());

        // create schema
        $command = new CreateSchemaDoctrineCommand();
        $this->application->add($command);
        $input = new ArrayInput(array(
            'command' => 'doctrine:schema:create',
        ));
        $command->run($input, new NullOutput());

        // get the Entity Manager
        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        // load fixtures
        $client = static::createClient();
        $loader = new ContainerAwareLoader($client->getContainer());
        $loader->loadFromDirectory(static::$kernel->locateResource('@IbwJobeetBundle/DataFixtures/ORM'));
        $purger = new ORMPurger($this->em);
        $executor = new ORMExecutor($this->em, $purger);
        $executor->execute($loader->getFixtures());
    }

    public function testGetCompanySlug()
    {
        $job = $this->em->createQuery('SELECT j FROM IbwJobeetBundle:Job j ')
            ->setMaxResults(1)
            ->getSingleResult();

        $this->assertEquals($job->getCompanySlug(), Jobeet::slugify($job->getCompany()));
    }

    public function testGetPositionSlug()
    {
        $job = $this->em->createQuery('SELECT j FROM IbwJobeetBundle:Job j ')
            ->setMaxResults(1)
            ->getSingleResult();

        $this->assertEquals($job->getPositionSlug(), Jobeet::slugify($job->getPosition()));
    }

    public function testGetLocationSlug()
    {
        $job = $this->em->createQuery('SELECT j FROM IbwJobeetBundle:Job j ')
            ->setMaxResults(1)
            ->getSingleResult();

        $this->assertEquals($job->getLocationSlug(), Jobeet::slugify($job->getLocation()));
    }

    public function testSetExpiresAtValue()
    {
        $job = new Job();
        $job->setExpiresAtValue();

        $this->assertEquals(time() + 86400 * 30, $job->getExpiresAt()->format('U'));
    }

    protected function tearDown()
    {
        parent::tearDown();
        if ($this->em) {
            $this->em->close();
        }
    }

}