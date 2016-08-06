<?php
namespace PMVC\App\session;

use PMVC;
use PHPUnit_Framework_TestCase;

PMVC\Load::plug();
PMVC\addPlugInFolders(['../']);
PMVC\l(__DIR__.'/vendor/pmvc-plugin/controller/tests/resources/FakeView.php');

class SessionAppTest extends PHPUnit_Framework_TestCase
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
        $c->plugApp(['../'],[],'index_api');
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
    }

}

class FakeGuid extends \PMVC\PlugIn
{
    function getDb(){
        return true;
    }
}

