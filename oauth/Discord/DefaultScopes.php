<?php

namespace humhub\modules\user\authclient;

class DefaultScopes
{

  public static $defaultScopes = ['identify', 'email'];

  public static function setDefaultScopes($array) {
    self::$defaultScopes = $array;
  }
}
