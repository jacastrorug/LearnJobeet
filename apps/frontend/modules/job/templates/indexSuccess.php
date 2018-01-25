<?php use_stylesheet('jobs.css') ?>
<?php use_stylesheet('job.css') ?>
<?php use_javascript('app/bower_components/jquery/dist/jquery.js')?>
<?php use_javascript('app/bower_components/angular/angular.js')?>
<?php use_javascript('app/bower_components/angular-animate/angular-animate.js')?>
<?php use_javascript('app/bower_components/angular-resource/angular-resource.js')?>
<?php use_javascript('app/bower_components/angular-route/angular-route.js')?>
<?php use_javascript('list/list.js')?>
<?php use_javascript('list/list.component.js')?>
<?php use_javascript('list-all/list-all.js')?>
<?php use_javascript('list-all/list-all.component.js')?>
<?php use_javascript('job/job.js')?>
<?php use_javascript('job/job-detail.component.js')?>
<?php use_javascript('job/job-new.component.js')?>
<?php use_javascript('app.js')?>
<?php use_javascript('app.config.js') ?>

<div id="jobs">
    <?php
    /**
     *
    <?php foreach ($categories as $category): ?>
    <div class="category_<?php echo Jobeet::slugify($category->getName()) ?>">
    <div class="category">
    <div class="feed">
    <a href="<?php echo url_for('category', array('sf_subject' => $category, 'sf_format' => 'atom')) ?>">Feed</a>
    </div>
    <h1><?php echo link_to($category, 'category', $category) ?></h1>
    </div>

    <?php include_partial('job/list', array('jobs' => $category->getActiveJobs(sfConfig::get('app_max_jobs_on_homepage')))) ?>

    <?php if (($count = $category->countActiveJobs() - sfConfig::get('app_max_jobs_on_homepage')) > 0): ?>
    <div class="more_jobs">
    and <?php echo link_to($count, 'category', $category) ?>
    more...
    </div>
    <?php endif; ?>
    </div>
    <?php endforeach; ?>
     */?>
    <div ng-view></div>
</div>
