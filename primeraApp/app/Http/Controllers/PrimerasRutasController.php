<?php

//package 
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrimerasRutasController extends Controller
{
    function primerMetodo(){
        //return view('welcome');//
        echo '<h1>Yo soy el <a href="hola">primer método.</h1>';
    }
}
