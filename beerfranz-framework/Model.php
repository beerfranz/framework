<?php

namespace beerfranz\framework;

Abstract class Model {
    
    public function __construct(array $data = []) {
        $this->hydrator($data);
    }
    
    public function hydrator(array $data = []) {
        foreach ($data as $name => $value) {
            $this->__set($name, $value);
        }
    }
    
    public function __set($name, $value) {

        $methodName = 'set' . ucfirst($name);
        
        if (method_exists($this, $methodName)) {
            $this->$methodName($value);
            return true;
        }
        
        if (property_exists($this, $name)) {
            $this->$name = $value;
            return true;
        }
            
        throw new Exception('Impossible d\'affecter de valeur à la propriété ' . $name);
    }
    
    public function __get($name) {
        $methodName = 'get' . ucfirst($name);
        
        if (method_exists($this, $methodName)) {
            return $this->$methodName();
        }
        
        if (property_exists($this, $name)) {
            return $this->$name;
        }
        
        throw new Exception('La propriété ' . $name . ' n\'existe pas');
    }

}