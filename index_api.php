<?php
namespace PMVC\App\session;

${_INIT_CONFIG}[_CLASS] = '\PMVC\Action';

$yo=\PMVC\plug('yo');

$yo->get('/session/{id}', function($m, $f){
   $session = \PMVC\plug('guid')->getDb('session');
   $go = $m['dump'];
   $go->set('id',$f['id']);
   $go->set('session',(string)$session[$f['id']]);
   return $go;
});

$yo->post('/session/{id}', function($m, $f){
   $session = \PMVC\plug('guid')->getDb('session');
   $session[$f['id']] = $f['data'];
   $go->set('id',$f['id']);
   $go->set('session',(string)$session[$f['id']]);
});

$yo->delete('/session/{id}', function($m, $f){
   $session = \PMVC\plug('guid')->getDb('session');
   unset($session[$f['id']]);
   $go->set('id',$f['id']);
   $go->set('session',(string)$session[$f['id']]);
});


