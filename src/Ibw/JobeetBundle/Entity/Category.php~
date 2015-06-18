<?php

namespace Ibw\JobeetBundle\Entity;

/**
 * Category
 */
class Category
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $jobs;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $affiliates;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->jobs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->affiliates = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add job
     *
     * @param \Ibw\JobeetBundle\Entity\Job $job
     *
     * @return Category
     */
    public function addJob(\Ibw\JobeetBundle\Entity\Job $job)
    {
        $this->jobs[] = $job;

        return $this;
    }

    /**
     * Remove job
     *
     * @param \Ibw\JobeetBundle\Entity\Job $job
     */
    public function removeJob(\Ibw\JobeetBundle\Entity\Job $job)
    {
        $this->jobs->removeElement($job);
    }

    /**
     * Get jobs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getJobs()
    {
        return $this->jobs;
    }

    /**
     * Add affiliate
     *
     * @param \Ibw\JobeetBundle\Entity\Affiliate $affiliate
     *
     * @return Category
     */
    public function addAffiliate(\Ibw\JobeetBundle\Entity\Affiliate $affiliate)
    {
        $this->affiliates[] = $affiliate;

        return $this;
    }

    /**
     * Remove affiliate
     *
     * @param \Ibw\JobeetBundle\Entity\Affiliate $affiliate
     */
    public function removeAffiliate(\Ibw\JobeetBundle\Entity\Affiliate $affiliate)
    {
        $this->affiliates->removeElement($affiliate);
    }

    /**
     * Get affiliates
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAffiliates()
    {
        return $this->affiliates;
    }

    public function __toString()
    {
        return $this->getName() ? $this->getName() : "";
    }
}
