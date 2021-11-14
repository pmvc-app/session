<?php
namespace PMVC\App\session;

use PMVC;
use PMVC\TestCase;

class SessionAppTest extends TestCase 
{
    private $_app = 'session';
    
    function testPlugin()
    {
        $c = \PMVC\plug('controller');
        $c->setApp($this->_app);
        $r = $c->getRequest();
        $r->setMethod('GET');
        $url = \PMVC\plug('url', [
            'REQUEST_URI'=>'/yo/session/xxid',
            'SCRIPT_NAME'=>'/yo/'
        ]);
        $c->plugApp(['../'],[],'index_middleware');
        \PMVC\initPlugIn([
            'guid'=>[
                _CLASS=>__NAMESPACE__.'\FakeGuid'
            ],
            'view'=>[
                _CLASS => '\PMVC\FakeView',
            ],
            'default_forward'=>null
        ]);
        $result = $c->process();
        $this->assertTrue(!empty($result));
    }

}

class FakeGuid extends \PMVC\PlugIn
{
    function getModel(){
        return new FakeSessionDb();
    }
}

class FakeSessionDb extends \PMVC\HashMap
{
    function ttl()
    {
        return 0;
    }
}


