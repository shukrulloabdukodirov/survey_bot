<?php

Route::resource('regions', V1\RegionAPIController::class);


Route::resource('cities', V1\CityAPIController::class);


Route::resource('education-centers', V1\EducationCenterAPIController::class);


Route::resource('specialities', V1\SpecialityAPIController::class);




