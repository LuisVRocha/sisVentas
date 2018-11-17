<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
     //PASO 5- modelo categoria 
   //declarar a que tabla ase referencia este modelo (categoria)
    protected $table='categoria';
    //el campo idcategoria va hacer el atributo $primaryKey del modelo
    protected $primaryKey='idcategoria';
    //para agregar automaticamente las dos columnas
    public $timestamps=false;
    //declara el atributo $fillablepara los atributos
    protected $fillable =[
             'nombre',
             'descripcion',
             'condicion'
    ];
    //
    protected $guarded =[
    ];
}
