<?php

  ini_set('error_reporting', E_ALL);
  ini_set( 'display_errors', 1 );

  header('Content-Type: application/json');
  include_once('../../class/class-chat.php');
  $rutaArchivo = '../../data/usuarios.json';

  // Obtener todos los chats de un usuario
  // /chats/?idUsuario=1
  if (
    $_SERVER['REQUEST_METHOD']=='GET'
    && isset($_GET['idUsuario'])
  ) { 
    Chat::obtenerListaChats($rutaArchivo, $_GET['idUsuario']);
  }

  //Obtener el detalle de un chat
  // /chats/?id=1
  if (
    $_SERVER['REQUEST_METHOD']=='GET'
    && isset($_GET['id'])
  ) { 
    Chat::obtenerDetalleChat($_GET['id']);
  }

  // Enviar nuevo mensaje
  // /chats/?id=chat-1-2
  if (
    $_SERVER['REQUEST_METHOD']=='POST'
    && isset($_GET['id'])
  ) { 
    $_POST = json_decode(file_get_contents("php://input"),true);
    
    $chat = new Chat(
      $_POST["emisor"], 
      $_POST["receptor"],
      $_POST["mensaje"],
      $_POST["tipo"],
      $_POST["hora"]
    );

    $chat->guardarMensaje($_GET['id']);
  }

?>