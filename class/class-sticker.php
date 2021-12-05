<?php 
  class Sticker {
    public $id;
    public $sticker;

    public function __construct($id, $sticker) {
      $this->id = $id;
      $this->sticker = $sticker;
    }

    public function getId() {
      return $this->id;
    }

    public function getSticker() {
      return $this->sticker;
    }

    public function setId($id) {
      $this->id = $id;
    }

    public function setSticker($sticker) {
      $this->sticker = $sticker;
    }

    public function __toString() {
      return $this->id . " " . $this->sticker;
    }

    public static function obtenerListaStickers() {
      $contenido = file_get_contents("../../data/stickers.json");
      $usuarios = json_decode($contenido,true);
      echo json_encode($usuarios);
    }

  }
?>
