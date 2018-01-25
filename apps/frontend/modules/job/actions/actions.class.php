<?php

/**
 * job actions.
 *
 * @package    jobeet
 * @subpackage job
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class jobActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
    {
        if (!$request->getParameter('sf_culture')) {
            if ($this->getUser()->isFirstRequest()) {
                $culture = $request->getPreferredCulture(array('en', 'fr'));
                $this->getUser()->setCulture($culture);
                $this->getUser()->isFirstRequest(false);
            } else {
                $culture = $this->getUser()->getCulture();
            }

            $this->redirect('@localized_homepage');
        }
        $this->categories = JobeetCategoryPeer::getWithJobs();
    }

    public function executeJson(sfWebRequest $request)
    {
        if ($request->hasParameter('slug')) {
            $category = JobeetCategoryPeer::getForSlug($request->getParameter('slug'));
            $list['name'] = $category->getName();
            $list['slug'] = $category->getSlug();
            $list['jobs'] = $category->getActiveJobs($category->countActiveJobs());
            $this->categories = $list;
        } else if($request->hasParameter('id')){
           // $category = JobeetCategoryPeer::getForSlug('design');
            $id = $request->getParameter('id');
            $job = JobeetJobPeer::getForID($id);
            $this->categories = $job;
        }else{
            $this->categories = JobeetCategoryPeer::getWithJobs();
        }
        return $this->renderText(json_encode($this->categories));
    }

    public function executePost(sfWebRequest $request){
        $job = new JobeetJob();
        $job->setCategoryId($request->getParameter('category'));
        $job->setType($request->getParameter('type'));
        $job->setCompany($request->getParameter('company'));
        $job->setLogo($request->getParameter('logo'));
        $job->setUrl($request->getParameter('url'));
        $job->setPosition($request->getParameter('position'));
        $job->setLocation($request->getParameter('location'));
        $job->setDescription($request->getParameter('description'));
        $job->setHowToApply($request->getParameter('howToApply'));
        $job->setIsPublic(true);
        $job->setEmail($request->getParameter('email'));
        $job->setToken($job->getCompany().$job->getPosition().rand(0,100000));
        BaseJobeetJobPeer::doInsert($job);

    }

    public function executeSearch(sfWebRequest $request)
    {
        if (!$query = $request->getParameter('query')) {
            return $this->forward('job', 'index');
        }

        $this->jobs = JobeetJobPeer::getForLuceneQuery($query);

        if ($request->isXmlHttpRequest()) {
            if ('*' == $query || !$this->jobs) {
                return $this->renderText('No results.');
            } else {
                return $this->renderPartial('job/list', array('jobs' => $this->jobs));
            }
        }
    }

    public function executeShow(sfWebRequest $request)
    {
        $this->job = $this->getRoute()->getObject();

        $this->getUser()->addJobToHistory($this->job);
    }

    public function executeNew(sfWebRequest $request)
    {
        $job = new JobeetJob();
        $job->setType('full-time');

        $this->form = new JobeetJobForm($job);
    }

    public function executeCreate(sfWebRequest $request)
    {
        $this->form = new JobeetJobForm();
        $this->processForm($request, $this->form);
        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request)
    {
        $job = $this->getRoute()->getObject();
        $this->forward404If($job->getIsActivated());

        $this->form = new JobeetJobForm($job);
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->form = new JobeetJobForm($this->getRoute()->getObject());
        $this->processForm($request, $this->form);
        $this->setTemplate('edit');
    }

    public function executePublish(sfWebRequest $request)
    {
        $request->checkCSRFProtection();

        $job = $this->getRoute()->getObject();
        $job->publish();

        $this->getUser()->setFlash('notice', sprintf('Your job is now online for %s days.', sfConfig::get('app_active_days')));

        $this->redirect($this->generateUrl('job_show_user', $job));
    }

    public function executeExtend(sfWebRequest $request)
    {
        $request->checkCSRFProtection();

        $job = $this->getRoute()->getObject();
        $this->forward404Unless($job->extend());

        $this->getUser()->setFlash('notice', sprintf('Your job validity has been extend until %s.', $job->getExpiresAt('m/d/Y')));

        $this->redirect($this->generateUrl('job_show_user', $job));
    }

    public function executeDelete(sfWebRequest $request)
    {
        $request->checkCSRFProtection();

        $job = JobeetJobPeer::retrieveByPk($request->getParameter('id'));
        $this->forward404Unless($job, sprintf('Object jobeet_job does not exist (%s).', $request->getParameter('id')));
        $job->delete();

        $this->redirect('job/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind(
            $request->getParameter($form->getName()),
            $request->getFiles($form->getName())
        );

        if ($form->isValid()) {
            $job = $form->save();

            $this->redirect($this->generateUrl('job_show', $job));
        }
    }
}
