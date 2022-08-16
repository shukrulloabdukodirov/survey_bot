<?php

Route::resource('regions', V1\RegionAPIController::class);

Route::resource('region_translations', V1\RegionTranslationAPIController::class);






Route::resource('cities', V1\CityAPIController::class);


Route::resource('city_translations', V1\CityTranslationAPIController::class);


Route::resource('education_centers', V1\EducationCenterAPIController::class);


Route::resource('education_center_translations', V1\EducationCenterTranslationAPIController::class);


Route::resource('specialties', V1\SpecialtyAPIController::class);


Route::resource('specialty_translations', V1\SpecialtyTranslationAPIController::class);


