<?php
namespace CloudFlare\Listener;

use Zend\Console\Request as ConsoleRequest;
use Zend\EventManager\EventManagerInterface as Events;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\ConsoleModel;

class ErrorListener implements ListenerAggregateInterface
{
    /**
     * @var array 
     */
    protected $listeners;

    /**
     * @param Events $events
     */
    public function detach(Events $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }

    /**
     * @param  Events $events
     * @return void
     */
    public function attach(Events $events)
    {
        $this->listeners[] = $events->attach(MvcEvent::EVENT_DISPATCH_ERROR, array($this, 'onError'));
    }

    /**
     * @param  MvcEvent $event
     * @return void
     */
    public function onError(MvcEvent $event)
    {
        $exception = $event->getParam('exception');
        if (!$exception) {
            return;
        }

        $request = $event->getRequest();
        if (!$request instanceof ConsoleRequest) {
            return;
        }

        $model = new ConsoleModel();
        $model->setResult(sprintf("\nError: %s\n\n", $exception->getMessage()));

        $event->setResult($model);
    }
}