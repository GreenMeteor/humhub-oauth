<?php

namespace humhub\modules\user\authclient;

class DefaultScopes
{

  public static $defaultScopes = array_merge(['identify', 'email'], $this->scopes);

  public static function setDefaultScopes($array) {
    self::$defaultScopes = $array;
  }
}
