<?php

  ini_set('error_reporting', E_ALL);
  ini_set( 'display_errors', 1 );

  header('Content-Type: application/json');
  include_once('../../class/class-sticker.php');

  // Obtener la lista de stickers
  // /stickers
  if (
    $_SERVER['REQUEST_METHOD']=='GET'
  ) { 
    Sticker::obtenerListaStickers();
  }

?>