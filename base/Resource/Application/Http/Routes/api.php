<?php
use Base\Resource\Application\Http\Controllers\Api\V1\RegionAPIController;
use Base\Resource\Application\Http\Controllers\Api\V1\EducationCenterAPIController;
Route::post('regions/add-education-center', [RegionAPIController::class,'addEducationCenter']);
Route::resource('regions', V1\RegionAPIController::class);

Route::resource('cities', V1\CityAPIController::class);


Route::post('education-centers/add-speciality', [EducationCenterAPIController::class,'addSpeciality']);
Route::resource('education-centers', V1\EducationCenterAPIController::class);


Route::resource('specialities', V1\SpecialityAPIController::class);




