<?php 
  class Chat {
    private $emisor;
    private $receptor;
    private $mensaje;
    private $tipo;
    private $hora;

    public function __construct($emisor, $receptor, $mensaje, $tipo, $hora) {
      $this->emisor = $emisor;
      $this->receptor = $receptor;
      $this->mensaje = $mensaje;
      $this->tipo = $tipo;
      $this->hora = $hora;
    }

    public function getEmisor() {
      return $this->emisor;
    }

    public function getReceptor() {
      return $this->receptor;
    }

    public function getMensaje() {
      return $this->mensaje;
    }

    public function getTipo() {
      return $this->tipo;
    }

    public function getHora() {
      return $this->hora;
    }

    public function setEmisor($emisor) {
      $this->emisor = $emisor;
    }

    public function setReceptor($receptor) {
      $this->receptor = $receptor;
    }

    public function setMensaje($mensaje) {
      $this->mensaje = $mensaje;
    }

    public function setTipo($tipo) {
      $this->tipo = $tipo;
    }

    public function setHora($hora) {
      $this->hora = $hora;
    }

    public function __toString() {
      return json_encode($this->getData());
    }

    public function getData() {
      return array(
        'emisor' => $this->emisor,
        'receptor' => $this->receptor,
        'mensaje' => $this->mensaje,
        'tipo' => $this->tipo,
        'hora' => $this->hora
      );
    }

    public function guardarMensaje($idChat) {
      $mensaje = $this->getData();
      $contenido = file_get_contents("../../data/$idChat.json");
      $chat = json_decode($contenido,true);
      $chat[] = $mensaje;
      $archivo  = fopen("../../data/$idChat.json", "w");
      fwrite($archivo, json_encode($chat));
      fclose($archivo);
      echo json_encode(array(
        'mensaje' => "Mensaje guardado"
      ));
    }

    public static function obtenerListaChats($rutaArchivo, $id) {
      $contenido = file_get_contents($rutaArchivo);
      $usuarios = json_decode($contenido,true);
      $respuesta = array();
      for ($i=0; $i < count($usuarios); $i++) {
        if ($usuarios[$i]['id'] == $id) {
          $respuesta = $usuarios[$i]['conversaciones'];
          break;
        }
      }
      echo json_encode($respuesta);
    }

    public static function obtenerDetalleChat($idChat) {
      $contenido = file_get_contents("../../data/$idChat.json");
      $chat = json_decode($contenido,true);
      ///
      echo json_encode($chat);
    }
  }
?>