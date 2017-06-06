<?php
namespace PMVC\App\session;

${_INIT_CONFIG}[_CLASS] = '\PMVC\Action';

$yo=\PMVC\plug('yo');

$yo->get('/session/{id}', function($m, $f){
   $session = \PMVC\plug('guid')->getDb('session');
   $id = $f['id'];
   $go = $m['dump'];
   $go->set('id',$id);
   $go->set('session',$session[$id]);
   $go->set('ttl', $session->ttl($id));
   return $go;
});

$yo->post('/session/{id}', function($m, $f){
   $session = \PMVC\plug('guid')->getDb('session');
   $id = $f['id'];
   $session[$id] = $f['data'];
   $go = $m['dump'];
   $go->set('id',$id);
   $go->set('session',$session[$id]);
   return $go;
});

$yo->delete('/session/{id}', function($m, $f){
   $session = \PMVC\plug('guid')->getDb('session');
   unset($session[$f['id']]);
   $go->set('id',$f['id']);
   $go->set('session',(string)$session[$f['id']]);
});


