<?php
  class Usuario {
    private $id;
    private $nombre;
    private $imagen;
    private $contactos;
    private $conversaciones;

    public function __construct($id, $nombre, $imagen, $contactos, $conversaciones) {
      $this->id = $id;
      $this->nombre = $nombre;
      $this->imagen = $imagen;
      $this->contactos = $contactos;
      $this->conversaciones = $conversaciones;
    }

    public function getId() {
      return $this->id;
    }

    public function getNombre() {
      return $this->nombre;
    }

    public function getImagen() {
      return $this->imagen;
    }

    public function getContactos() {
      return $this->contactos;
    }

    public function getConversaciones() {
      return $this->conversaciones;
    }

    public function setId($id) {
      $this->id = $id;
    }

    public function setNombre($nombre) {
      $this->nombre = $nombre;
    }

    public function setImagen($imagen) {
      $this->imagen = $imagen;
    }

    public function setContactos($contactos) {
      $this->contactos = $contactos;
    }

    public function setConversaciones($conversaciones) {
      $this->conversaciones = $conversaciones;
    }

    public function __toString() {
      return json_encode($this->getData());
    }

    public function getData() {
      return array(
        'id' => $this->id,
        'nombre' => $this->nombre,
        'imagen' => $this->imagen,
        'contactos' => $this->contactos,
        'conversaciones' => $this->conversaciones
      );
    }

    public static function obtenerUsuarios($rutaArchivo) {
      $contenido = file_get_contents($rutaArchivo);
      $usuarios = json_decode($contenido,true);
      $respuesta = array();
      for ($i=0; $i < count($usuarios); $i++) {
        $respuesta[] = array(
          "id" => $usuarios[$i]["id"],
          "nombre" => $usuarios[$i]["nombre"],
          "imagen" => $usuarios[$i]["imagen"],
          "contactos" => $usuarios[$i]["contactos"],
        );
      }
      echo json_encode($respuesta);
    }

    public static function obtenerContactosUsuario($rutaArchivo, $idUsuario) {
      $contenido = file_get_contents($rutaArchivo);
      $usuarios = json_decode($contenido,true);
      $codigosContactos = array();
      for ($i=0; $i < count($usuarios); $i++) {
        if ($usuarios[$i]["id"] == $idUsuario) {
          $codigosContactos = $usuarios[$i]["contactos"];
        }
      }
      $respuesta = array();
      for($i=0; $i < count($codigosContactos); $i++) {
        for ($j=0; $j < count($usuarios); $j++) {
          if ($usuarios[$j]["id"] == $codigosContactos[$i]) {
            $respuesta[] = array(
              "id" => $usuarios[$j]["id"],
              "nombre" => $usuarios[$j]["nombre"],
              "imagen" => $usuarios[$j]["imagen"],
            );
          }
        }
      }

      echo json_encode($respuesta);
    }

    public static function agregarContacto($rutaArchivo, $idUsuario, $idContacto) {
      // echo "agregarContacto";
      // return;
      $contenido = file_get_contents($rutaArchivo);
      $usuarios = json_decode($contenido, true);
      
      for ($i=0; $i < count($usuarios); $i++) {
        if ($usuarios[$i]["id"] == $idUsuario) {
          $contactos = $usuarios[$i]["contactos"];
          $contactos[] = (int)$idContacto;
          $usuarios[$i]["contactos"] = $contactos;
        }
      }
      // echo json_encode($usuarios);
      // return;

      $archivo = fopen($rutaArchivo, "w");
      fwrite($archivo, json_encode($usuarios));
      fclose($archivo);
      // echo json_encode($respuesta);

      echo json_encode(array(
        "mensaje" => "Contacto agregado"
      ));
    }
  }
?>