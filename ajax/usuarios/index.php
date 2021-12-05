<?php

  ini_set('error_reporting', E_ALL);
  ini_set( 'display_errors', 1 );

  header('Content-Type: application/json');
  include_once('../../class/class-usuario.php');
  $rutaArchivo = '../../data/usuarios.json';

  // Obtener todos los usuarios
  if (
    $_SERVER['REQUEST_METHOD']=='GET'
    && !isset($_GET['id']) 
    && !isset($_GET['accion']) 
  ) { 
    Usuario::obtenerUsuarios($rutaArchivo);
  }

  // /usuarios/index.php?id=1&accion=contactos
  if (
    $_SERVER['REQUEST_METHOD']=='GET' 
    && isset($_GET['id']) 
    && isset($_GET['accion']) 
    && $_GET['accion'] == 'contactos'
  ) { 
    Usuario::obtenerContactosUsuario($rutaArchivo, $_GET['id']);
  }

  // /usuarios/index.php?id=1&idContacto=2&accion=agregarContacto
  if (
    $_SERVER['REQUEST_METHOD']=='POST' 
    && isset($_GET['id']) 
    && isset($_GET['idContacto']) 
    && isset($_GET['accion']) 
    && $_GET['accion'] == 'agregarContacto'
  ) { 
    // echo "Agregar contacto";

    Usuario::agregarContacto($rutaArchivo, $_GET['id'], $_GET['idContacto']);
  }


