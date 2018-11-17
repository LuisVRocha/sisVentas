<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;

//PASO 9 AGREGAR REFERENCIA A Categoria DE MODELO
use sisVentas\Categoria;

use Illuminate\Support\Facades\Redirect;//Asemos REFERENCIA A Redirect PARA HACER ALGUNAS REDIRECCIONES

use sisVentas\Http\Requests\CategoriaFormRequest;// Asemos REFERENCIA A CategoriaFormRequest

use DB; // agregamos DB para trabajar en una clase DB de laravel

class CategoriaController extends Controller
{
   //PASO 10 DECLARAR UN CONSTRUCTOR PARA EL MODELO
    public function __construct() 
    {

    } // AGREGAMOS LA FUNCION INDEX
    public function index(Request $request) 
    {  
        if ($request)//SI EXISTE request VOY A OBTENER TODOS LOS REGISTROS DE LA TABLA CATEGORIA DE LA BD
        {  
            $query=trim($request->get('searchText'));//VARIABLE $query, DETERMINAR CUAL VA ASER EL TEXTO DE BUSQUEDA PARA PODER FILTRAR TODAS LAS CATEGORIA
            
            $categorias=DB::table('categoria')->where('nombre','LIKE','%'.$query.'%')  // VARIABLE $categorias
            ->where ('condicion','=','1') //condicion solo me muestre las categorias activas 
            ->orderBy('idcategoria','desc')//para ordenar los parametros,  
            ->paginate(7); //de cuantos registros va hacer la paginacion
            return view('almacen.categoria.index',["categorias"=>$categorias,"searchText"=>$query]); // retornar las vistas 
        }
    }
    public function create() // AGREGAMOS LA FUNCION CREATE
    {
        return view("almacen.categoria.create");//retornar a una vista (create)
    }
    public function store (CategoriaFormRequest $request) // AGREGAMOS LA FUNCION STORE(PARA ALMACENAR)
    {
        $categoria=new Categoria; //CREO UN OBJETO CATEGORIA QUE HACE REFERENCIA AL MODELO CATEGORIA 
        $categoria->nombre=$request->get('nombre'); //A CADA UNA DE PROPIEDADE DEL MODELO LE VOY A ENVIAR UN VALOR
        $categoria->descripcion=$request->get('descripcion'); //A CADA UNA DE PROPIEDADE DEL MODELO LE VOY A ENVIAR UN VALOR
        $categoria->condicion='1'; //A CADA UNA DE PROPIEDADE DEL MODELO LE VOY A ENVIAR UN VALOR Y YA CUANDO ELIMINE LA CATEGORIA DEL SISTEMA DE VENTASM¿ VA A PASAR A UN VALOR 0
        $categoria->save(); //PARA ALMACENAR EN LA BD
        return Redirect::to('almacen/categoria'); // VAMOS A RETURNAR UNA REDIRECCION A almacen/categoria, PARA QUE LUEGO DE ALMACENAR NOS MANDE A ESA DIRECCION

    }
    public function show($id)// AGREGAMOS LA FUNCION SHOW (PARA MOSTRAR)
    {
        return view("almacen.categoria.show",["categoria"=>Categoria::findOrFail($id)]); //RETURNAR UNA VISTA,PERO LE ENVIO CIERTOS PARAMETROS EN UNA MATRIZ
    }
    public function edit($id) // AGREGAMOS LA FUNCION EDIT (PARA EDITAR)
    {
        return view("almacen.categoria.edit",["categoria"=>Categoria::findOrFail($id)]); //RETURNAR UNA VISTA,PERO LE ENVIO CIERTOS PARAMETROS EN UNA MATRIZ
    }
    public function update(CategoriaFormRequest $request,$id)// AGREGAMOS LA FUNCION UPDATE (PARA ACTUALIZAR)
    {
        $categoria=Categoria::findOrFail($id); // DECLARAR VARIABLE, Y LE ENVIO  LA CATEGORIA QUE QUIERO MODIFICAR
        $categoria->nombre=$request->get('nombre');//
        $categoria->descripcion=$request->get('descripcion');
        $categoria->update();//PARA ACTUALIZAR 
        return Redirect::to('almacen/categoria'); //PARA RETURNAR A UNA REDIRECCION A UNA VISTA
    }
    public function destroy($id)// AGREGAMOS LA FUNCION DESTROY (PARA DESTRUIR UN OBEJTO Y ELIMINARLO DE LA TABLA)
    {
        $categoria=Categoria::findOrFail($id);// SELECCIONE LA CATEGORIA QUE CUYO  $id ESTOY RECIVIENDO POR PARAMETRO
        $categoria->condicion='0'; //QUE LA CATEGORIA SEA IGUAL A 0
        $categoria->update(); //ACTUELIZO 
        return Redirect::to('almacen/categoria'); //PARA RETURNAR A UNA REDIRECCION A UNA VISTA
    }
}
