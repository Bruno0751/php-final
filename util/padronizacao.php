<?php
  class Padronizacao{

    public static function antiXSS($inputs){
      return htmlspecialchars($inputs);
    }
    public static function nomePadronizacao($nome){
      return ucwords(strtolower($nome));
    }

    public static function juntarDatas($dia,$mes,$ano){
      $data = array($dia,$mes,$ano);
      $juntar = implode("/",$data);
      return $juntar;
    }
  }
