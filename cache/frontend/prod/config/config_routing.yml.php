<?php
// auto-generated by sfRoutingConfigHandler
// date: 2018/01/25 22:35:03
return array(
'job_json' => new sfRoute('/json', array (
  'module' => 'job',
  'action' => 'json',
), array (
), array (
)),
'job_post' => new sfRoute('/postJob', array (
  'module' => 'job',
  'action' => 'post',
), array (
  'sf_method' => 
  array (
    0 => 'POST',
  ),
), array (
)),
'job_search' => new sfRoute('/:sf_culture/search', array (
  'module' => 'job',
  'action' => 'search',
), array (
), array (
)),
'affiliate' => new sfPropelRouteCollection(array (
  'model' => 'JobeetAffiliate',
  'actions' => 
  array (
    0 => 'new',
    1 => 'create',
  ),
  'object_actions' => 
  array (
    'wait' => 'get',
  ),
  'prefix_path' => '/:sf_culture/affiliate',
  'name' => 'affiliate',
  'requirements' => 
  array (
  ),
)),
'api_jobs' => new sfPropelRoute('/api/:token/jobs.:sf_format', array (
  'module' => 'api',
  'action' => 'list',
), array (
  'sf_format' => '(?:xml|json|yaml)',
), array (
  'model' => 'JobeetJob',
  'type' => 'list',
  'method' => 'getForToken',
)),
'category' => new sfPropelRoute('/:sf_culture/category/:slug.:sf_format', array (
  'module' => 'category',
  'action' => 'show',
  'sf_format' => 'html',
), array (
  'sf_format' => '(?:html|atom)',
), array (
  'model' => 'JobeetCategory',
  'type' => 'object',
)),
'job' => new sfPropelRouteCollection(array (
  'model' => 'JobeetJob',
  'column' => 'token',
  'object_actions' => 
  array (
    'publish' => 'put',
    'extend' => 'PUT',
  ),
  'prefix_path' => '/:sf_culture/job',
  'name' => 'job',
  'requirements' => 
  array (
    'token' => '\\w+',
  ),
)),
'job_show_user' => new sfPropelRoute('/:sf_culture/job/:company_slug/:location_slug/:id/:position_slug', array (
  'module' => 'job',
  'action' => 'show',
), array (
  'id' => '\\d+',
  'sf_method' => 
  array (
    0 => 'GET',
  ),
), array (
  'model' => 'JobeetJob',
  'type' => 'object',
  'method_for_criteria' => 'doSelectActive',
)),
'homepage' => new sfRoute('/', array (
  'module' => 'job',
  'action' => 'index',
), array (
), array (
)),
'localized_homepage' => new sfRoute('/:sf_culture/', array (
  'module' => 'job',
  'action' => 'index',
), array (
  'sf_culture' => '(?:fr|en)',
), array (
)),
);