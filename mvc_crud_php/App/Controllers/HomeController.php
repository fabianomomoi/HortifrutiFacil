<?php

/* A classe HomeController é um controlador padrão do sistema, 
 * constituído apenas por um único método (action) chamado index,
 * que renderiza uma única view.*/

namespace App\Controllers;

class HomeController extends Controller //HomeController estende Controller pai.
{
    public function index() //Nome da action é o mesmo que o nome do método.
    {
        $this->render('home/index'); //Utilizamos o método da classe pai para renderizar a view.
    }
}