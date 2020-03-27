<?php
  class Validacao{

    public static function validarNome($nome){
      $exp = "/^[A-zÁ-üÀ ]{1,50}$/";
      return preg_match($exp,$nome);
    }

    public static function validarIdade($idade){
      $exp = "/^[0-9]{1,3}$/";
      return preg_match($exp,$idade);
    }

    public static function validarSexo($sexo){
      $exp = "/^(masculino|feminino)$/";
      return preg_match($exp,$sexo);
    }

    public static function validarDia($dia){
      $exp = "/^[0-9]{2,2}$/";
      return preg_match($exp,$dia);
    }

    public static function validarMes($mes){
      $exp = "/^[0-9]{2,2}$/";
      return preg_match($exp,$mes);
    }

    public static function validarAno($ano){
      $exp = "/^[0-9]{4,4}$/";
      return preg_match($exp,$ano);
    }

    public static function validarPeso($peso){
      $exp = "/^[0-9.]{1,10}$/";
      return preg_match($exp,$peso);
    }

    public static function validarAltura($altura){
      $exp = "/^[0-9.]{1,10}$/";
      return preg_match($exp,$altura);
    }

    public static function validarCPF($cpf){
      $exp = "/^[0-9]{1,}$/";
      return preg_match($exp,$cpf);
    }

    public static function validarCNPJ($cnpj){
      $exp = "^[0-9]{0,}$";
      return preg_match($exp,$cnpj);
    }

    public static function validarRG($rg){
      $exp = "/^[0-9]{1,}$/";
      return preg_match($exp,$rg);
    }
  }
