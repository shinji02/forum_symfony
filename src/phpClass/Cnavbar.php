<?php

namespace App\phpClass;

class Cnavbar{

    const Navbar = array(
        array('nameMenu' => 'Gestion catégorie', 'icon' => 'fas fa-book','perm' => 80, 'link' => 'categorie'),
        array('nameMenu' => 'Gestion suject', 'icon' => 'fas fa-book', 'perm' => 50,'link' => 'suject'),
        array('nameMenu' => 'Gestion des utlisateur', 'icon' => 'fas fa-user', 'perm' => 50,'link'=>'userAccount'),
        array('nameMenu' => 'Gestion des roles', 'icon' => 'fas fa-user', 'perm' => 100,'link'=>'roles'),
        array('nameMenu' => 'Paramétre','icon' => 'fas fa-cogs', 'perm' => 100, 'link'=>'settings')
    );


    public static function getNavbar(){
        return self::Navbar;
    }
}