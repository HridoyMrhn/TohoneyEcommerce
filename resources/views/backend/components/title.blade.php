<?php
@if(Route::is('category.*'))
    @section('page_title') Category
@elseif (Route::is('dashbaord'))
    @section('page_title') Dashbaord
