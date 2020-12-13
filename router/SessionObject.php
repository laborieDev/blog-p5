<?php
class SessionObject
{
    private $session;

    public function __construct()
    {
        $this->session = $_SESSION;
    }

   public function getAll()
   {
        return $this->session;
   }

   public function getVariable($name)
   {
       if (!isset($this->session[$name])) {
           return false;
       }
        return $this->session[$name];
   }

   public function addVariable($variableName, $value)
   {
       $_SESSION[$variableName] = $value;
   }
}
