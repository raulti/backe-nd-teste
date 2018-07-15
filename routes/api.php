<?php

/*
|--------------------------------------------------------------------------
| Rotas referênte a Países
|--------------------------------------------------------------------------
*/

Route::get('country/list', 'CountryController@getCountrys');
Route::get('country/csv', 'CountryController@makeCsv');
Route::get('country/xlsx', 'CountryController@makeXlsx');