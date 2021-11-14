<?php
namespace PMVC\App\session;

${_INIT_CONFIG}[_CLASS] = '\PMVC\Action';

$yo=\PMVC\plug('yo');

$yo->get('/session/{id}', function($m, $f){
   $session = \PMVC\plug('guid')->getModel('session');
   $id = $f['id'];
   $go = $m['dump'];
   $go->set('id',$id);
   if (isset($session[$id])) {
       $lifeTime = \PMVC\plug('session')->getLifeTime();
       if ($lifeTime) {
            $result = $session->setExpire($id, $lifeTime);
       }
       $go->set('session',$session[$id]);
       $go->set('expire', date('Y/m/d H:i:s', time()+$session->ttl($id)));
   }
   return $go;
});

$yo->post('/session/{id}', function($m, $f){
   $session = \PMVC\plug('guid')->getModel('session');
   $id = $f['id'];
   $session[$id] = $f['data'];
   $go = $m['dump'];
   $go->set('id',$id);
   $go->set('session',$session[$id]);
   return $go;
});

$yo->delete('/session/{id}', function($m, $f){
   $session = \PMVC\plug('guid')->getModel('session');
   unset($session[$f['id']]);
   $go->set('id',$f['id']);
   $go->set('session',(string)$session[$f['id']]);
});


