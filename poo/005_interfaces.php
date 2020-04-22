<?php
  interface Automovil{
      //metodos siempre publicos en una interface
      public function encender();
      public function apagar();
  }
  interface Gasolina extends Automovil{
      public function vaciarTanque();
      public function llenarTanque($cant);
  }
  class Deportivo implements Gasolina{
      
    //atributos
    private $estado = false;
    private $tanque = 0;
    
      public function estado(){
          if ($this->estado) {
              echo "El auto esta encendido y tiene ". $this->tanque." litros en el tanque";
          }else{
              echo "el auto esta apagado";
          }
      }

      public function encender(){
        if ($this->estado) {
            echo "No puedes encender el auto dos veces<br>";
        } else {
            if ($this->tanque <=0) {
                echo "Ud no puede encender el auto por que el tanque esta vacio<br>";
            }else{
                echo "Auto encendido<br>";
                $this->estado = true;
            }
            
        }
        
      }
      public function apagar(){
        if ($this->estado) {
            echo "Auto apagado<br>";
            $this->estado = false;
        } else {
            echo "El auto ya esta apagado<br>";
            
        }
      }

      public function vaciarTanque(){
        $this->tanque = 0;
      }
      public function llenarTanque($cant){
        $this->tanque = $cant;
      }

      public function usar($km){
          if ($this->estado) {
              $reducir = $km / 3;
              $this->tanque = $this->tanque - $reducir;
              if ($this->tanque <= 0) {
                  $this->estado-> false;
              }
          } else {
              echo "El auto esta apagado y no se puede usar<br>";
          }
          
      }
  }
  
  $objDeportivo = new Deportivo();
  $objDeportivo->llenarTanque(100);
   
  $objDeportivo->encender(); 
  $objDeportivo->usar(20);
  $objDeportivo->estado();
?>