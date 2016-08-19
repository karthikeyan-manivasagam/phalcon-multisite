<?php

namespace Extended;

use Phalcon\Mvc\View\Engine\Volt;
use Phalcon\Mvc\View\Engine\Volt\Compiler;

class ExtendedVolt extends Volt
{ 
    public function getCompiler()
    {
        if (!$this->_compiler) {
            $this->_compiler = new VoltCompilerExtension($this->getView());
            $this->_compiler->setOptions($this->getOptions());
            $this->_compiler->setDI($this->getDI());
        }
        return $this->_compiler;
    }
}


class VoltCompilerExtension extends Volt\Compiler
{
    public function compileFile($path, $compiledPath, $extendsMode = null)
    {
        $skinPath = $this->getOption('skinPath');
        if ($skinPath) {
            $skinTemplate = str_replace(
                $this->getDI()->getView()->getViewsDir(),
                $skinPath,
                $path
            );

            if (is_readable($skinTemplate)) {
                $path = $skinTemplate;
            }
        }
        return parent::compileFile($path, $compiledPath, $extendsMode);
    }
 
}