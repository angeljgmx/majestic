<?php

    /********************************************************/
    /* Administrador Web SmartNova                            */
    /* Funciones de cadenas de caracteres                   */
    /* Junio de 2016                                        */
    /********************************************************/

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

    function Menu($path){

        $menu = "<!-- BEGIN SIDEBAR MENU --> \n"
            ."<ul class=\"page-sidebar-menu  page-header-fixed \" data-keep-expanded=\"false\" data-auto-scroll=\"true\" data-slide-speed=\"200\" style=\"padding-top: 20px\"> \n"
            ."<li class=\"sidebar-toggler-wrapper hide\"> \n"
            
            ."<!-- BEGIN SIDEBAR TOGGLER BUTTON --> \n"
            ."<div class=\"sidebar-toggler\"> </div> \n"
            ."<!-- END SIDEBAR TOGGLER BUTTON --> \n"
            ."</li> \n"
            ."<li class=\"sidebar-search-wrapper\"> \n"
            ."<!-- BEGIN RESPONSIVE QUICK SEARCH FORM --> \n"
            ."<form class=\"sidebar-search  \" action=\"page_general_search_3.html\" method=\"POST\"> \n"
            ."<a href=\"javascript:;\" class=\"remove\"> \n"
            ."<i class=\"icon-close\"></i> \n"
            ."</a> \n"
            ."<div class=\"input-group\"> \n"
            ."<input type=\"text\" class=\"form-control\" placeholder=\"Search...\"> \n"
            ."<span class=\"input-group-btn\"> \n"
            ."<a href=\"javascript:;\" class=\"btn submit\"> \n"
            ."<i class=\"icon-magnifier\"></i> \n"
            ."</a> \n"
            ."</span> \n"
            ."</div> \n"
            ."</form> \n"
            ."<!-- END RESPONSIVE QUICK SEARCH FORM --> \n"
            ."</li> \n"
            ."<li class=\"nav-item start \"> \n"
            ."<a href=\"javascript:;\" class=\"nav-link nav-toggle\"> \n"
            ."<i class=\"icon-home\"></i> \n"
            ."<span class=\"title\">Dashboard</span> \n"
            ."<span class=\"arrow\"></span> \n"
            ."</a> \n"
            ."<ul class=\"sub-menu\"> \n"
            ."<li class=\"nav-item start \"> \n"
            ."<a href=\"index.html\" class=\"nav-link \"> \n"
            ."<i class=\"icon-bar-chart\"></i> \n"
            ."<span class=\"title\">Dashboard 1</span> \n"
            ."</a> \n"
            ."</li> \n"
            ."<li class=\"nav-item start \"> \n"
            ."<a href=\"dashboard_2.html\" class=\"nav-link \"> \n"
            ."<i class=\"icon-bulb\"></i> \n"
            ."<span class=\"title\">Dashboard 2</span> \n"
            ."<span class=\"badge badge-success\">1</span> \n"
            ."</a> \n"
            ."</li> \n"
            ."<li class=\"nav-item start \"> \n"
            ."<a href=\"dashboard_3.html\" class=\"nav-link \"> \n"
            ."<i class=\"icon-graph\"></i> \n"
            ."<span class=\"title\">Dashboard 3</span> \n"
            ."<span class=\"badge badge-danger\">5</span> \n"
            ."</a> \n"
            ."</li> \n"
            ."</ul> \n"
            ."</li> \n"
            ."<li class=\"heading\"> \n"
            ."<h3 class=\"uppercase\">Features</h3> \n"
            ."</li> \n"

            ."</ul> \n"
            ."<!-- END SIDEBAR MENU --> \n";
        return $menu;
    }