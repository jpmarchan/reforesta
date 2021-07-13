<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class Usuarios extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;
    protected $primaryKey = 'id';
    protected $fillable = ['id_arbol','id_codigo','codigo','nombre','apellido','email','nacionalidad','nombre_certificado','tipo_certificado','nombre_de','newsletter','dni','metodopago','fecha_registro','updated_at'];

}
