<?php

class JobeetCategory extends BaseJobeetCategory implements JsonSerializable
{
    public function __toString()
    {
        return $this->getName();
    }

    public function getActiveJobs($max = 10)
    {
        $criteria = $this->getActiveJobsCriteria();
        $criteria->setLimit($max);

        return JobeetJobPeer::doSelect($criteria);
    }

    public function countActiveJobs()
    {
        $criteria = $this->getActiveJobsCriteria();

        return JobeetJobPeer::doCount($criteria);
    }


    public function setName($name)
    {
        parent::setName($name);

        $this->setSlug(Jobeet::slugify($name));
    }

    public function getActiveJobsCriteria()
    {
        $criteria = new Criteria();
        $criteria->add(JobeetJobPeer::CATEGORY_ID, $this->getId());

        return JobeetJobPeer::addActiveJobsCriteria($criteria);
    }

    public function getLatestPost()
    {
        $jobs = $this->getActiveJobs(1);

        return $jobs[0];
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        $retorno = $this->toArray(BasePeer::TYPE_STUDLYPHPNAME);
        $retorno['jobs'] = $this->getActiveJobs();
        $retorno['actives'] = $this->countActiveJobs();
        return $retorno;
    }
}
