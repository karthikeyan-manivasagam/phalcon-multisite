<?php 
namespace Extended;

use Phalcon\Mvc\View\Exception;
use Phalcon\Mvc\View;

class ExtendedView extends View
{
    protected $_viewsDirs;
    /**
     * @var
     */
    protected $_eventsManager;
    /**
     * @param $path
     *
     * @return $this
     */
    public function addViewsDir($path)
    {
       $this->_viewsDirs = $path;
       $this->setViewsDir($path);
        return $this;
    }
    /**
     * @param $view
     * @param array $vars
     *
     * @return string
     */
    public function getPartial($view, $vars = [])
    {
        ob_start();
        $this->partial($view, $vars);
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    protected function _engineRender($engines, $viewPath, $silence, $mustClean, $cache = null)
    {
        if (is_object($cache)) {
            throw new Exception('Cache view not supported...');
            return;
        }
        $viewsDirs = is_array($this->_viewsDirs) ? array_reverse($this->_viewsDirs) : [$this->_viewsDir];
        $notExists = true;
        $viewEnginePath = null;
        foreach ($engines as $extension => $engine) {
            foreach ($viewsDirs as $viewsDir) {
                $viewsDirPath   = $this->_basePath . $viewsDir . $viewPath;
                $viewEnginePath = $viewsDirPath . $extension;
                if (is_file($viewEnginePath)) {
                    if (is_object($this->_eventsManager)) {
                        $this->_activeRenderPath = $viewEnginePath;
                        if($this->_eventsManager->fire('view:beforeRenderView', $this, $viewEnginePath) === false) {
                            break;
                        }
                    }
                    $engine->render($viewEnginePath, $this->_viewParams, $mustClean);
                    if (is_object($this->_eventsManager)) {
                        $this->_eventsManager->fire('view:afterRenderView', $this);
                    }
                    $notExists = false;
                    break 2;
                }
            }
        }
        if ($notExists) {
            if (is_object($this->_eventsManager)) {
                $this->_activeRenderPath = $viewEnginePath;
                $this->_eventsManager->fire('view:notFoundView', $this);
            }
            if (!$silence) {
                $exceptionMessage = 'View "'.($viewPath).'" was not found in the views directories';
                throw new Exception($exceptionMessage);
                return;
            }
        }
    }
}