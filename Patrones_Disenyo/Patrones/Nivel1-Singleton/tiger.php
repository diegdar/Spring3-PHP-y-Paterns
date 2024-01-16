<?php
/*
NOTAS🗒️
1: Si necesitamos admitir varios tipos de Singletons en nuestra aplicación, podemos definir las características básicas del Singleton en una clase base, mientras movemos la lógica del proceso real (como el registro) en subclases.
2: La instancia del singleton real casi siempre reside dentro de un campo estático. En este caso, el campo estático es una matriz, donde cada subclase de Singleton almacena su propia instancia.
3: Hay que tener en cuenta que aquí utilizamos la palabra clave "static" en lugar del nombre de clase real. En este contexto, la palabra clave "estática" significa "el nombre de la clase actual". Ese detalle es importante porque cuando se llama al método en la subclase, queremos que se cree aquí una instancia de esa subclase.
    3.1: Si la instancia ya esta creada lo que hara sera recuperar esta instancia del array $instances con el nombre de la subclase como clave
4: Crea la nueva instancia de la clase Tiger o si ya esta creada la recupera desde la clase Singleton    
*/

class Singleton
{ //nota 1
    private static $instances = []; //nota 2

    //impide que se pueda instanciar un objeto con el operador 'new'
    protected function __construct(){}

    //impide su clonacion al sobreescribir el metodo magico en protected
    protected function __clone() { }

    //impide que se el singleton sea restaurado desde un string
    public function __wakeup()
    {
        throw new \Exception("No se puede deserializar singleton");
    }

    public static function getInstance()
    {
        $subClase = static::class;
        if(!isset(self::$instances[$subClase]))
        {
            self::$instances[$subClase] = new static(); //nota 3
        }
        return self::$instances[$subClase]; //nota 3.1
    }
}
class Tiger extends Singleton{

    protected int $numRugidos = 0;

    protected function __construct() {
        echo "Building character..." . PHP_EOL;
    }

    public function roar() {
        echo "Grrr!" . PHP_EOL;
    }

    public function hacerRugir()
    {
        $tiger = static::getInstance(); //nota 4
        $tiger->roar();
        $this->numRugidos++;
    }

    public function getCounter()
    {
        echo "El tigre ha rudigo {$this->numRugidos} veces";
    }
}

$tiger1 = Tiger::getInstance();
$tiger2 = Tiger::getInstance();
$tiger1->hacerRugir();
$tiger1->hacerRugir();
$tiger1->hacerRugir();
$tiger1->hacerRugir();

$tiger1->getCounter();