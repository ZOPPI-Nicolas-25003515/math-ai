<?php

//Ce code est inutile dans la nouvelle version de notre MVC.

namespace Core;
use Core\exceptions\ControllerException;
final class Controller
{
    /** @var array<string, mixed> */
    private array $_urlSegments = [];

    /** @var array<string> */
    private array $_urlParameters = [];

    /** @var array<string, mixed> */
    private array $_formData = [];

    /**
     * @param array<string, mixed> $A_postParams
     */
    public function __construct(string $S_url,array $A_postParams)
    {
        $S_url = trim($S_url, '/');

        $A_urlSegments = explode('/', $S_url);

        if (empty($A_urlSegments[0])) {
            $A_urlSegments[0] = 'HomeController';
        } else {
            $A_urlSegments[0] = ucfirst($A_urlSegments[0]) . 'Controller';
        }

        if (empty($A_urlSegments[1])) {
            $A_urlSegments[1] = 'defaultAction';
        } else {
            $A_urlSegments[1] = $A_urlSegments[1] . 'Action';
        }


        $this->_urlSegments['controller'] = array_shift($A_urlSegments);
        $this->_urlSegments['action'] = array_shift($A_urlSegments);

        $this->_urlParameters = $A_urlSegments;

        $this->_formData = $A_postParams;

    }

    public function execute(): mixed
    {
        if (!class_exists($this->_urlSegments['controller'])) {
            throw new ControllerException($this->_urlSegments['controller'] . " n'est pas un controleur valide.");
        }

        if (!method_exists($this->_urlSegments['controller'], $this->_urlSegments['action'])) {
            throw new ControllerException($this->_urlSegments['action'] . " du contrôleur " .
                    $this->_urlSegments['controller'] . " n'est pas une action valide.");
        }

        $B_called = call_user_func_array(array(new $this->_urlSegments['controller'],
                $this->_urlSegments['action']), array($this->_urlParameters, $this->_formData ));

        if (false === $B_called) {
            throw new ControllerException("L'action " . $this->_urlSegments['action'] .
                    " du contrôleur " . $this->_urlSegments['controller'] . " a rencontré une erreur.");
        }

        return $B_called;
    }
}
?>
