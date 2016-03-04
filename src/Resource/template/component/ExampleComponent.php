<?php

namespace XVEngine\Bundle\ExampleBundle\Component\Utils;

use XVEngine\Core\Component\AbstractComponent;

class ExampleComponent extends AbstractComponent
{

    public function initialize()
    {
        $this->setComponentName('utils.exampleComponent');
    }

}