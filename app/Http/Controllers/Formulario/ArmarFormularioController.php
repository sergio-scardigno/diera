<?php

namespace App\Http\Controllers\Formulario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Def_formulario_organizacion;

use App\Http\Controllers\Formulario\ArmarI2018Controller;
use App\Http\Controllers\Formulario\ArmarF2018Controller;
use App\Http\Controllers\Formulario\ArmarI2019Controller;
use App\Http\Controllers\Formulario\ArmarF2019Controller;
use App\Http\Controllers\Formulario\ArmarI2020Controller;
use App\Http\Controllers\Formulario\ArmarF2020Controller;
use App\Http\Controllers\Formulario\ArmarI2021Controller;
use App\Http\Controllers\Formulario\ArmarF2021Controller;
use App\Http\Controllers\Formulario\ArmarI2022Controller;
use App\Http\Controllers\Formulario\ArmarF2022Controller;
use App\Http\Controllers\Formulario\ArmarI2023Controller;
use App\Http\Controllers\Formulario\ArmarF2023Controller;
use App\Http\Controllers\Formulario\ArmarI2024Controller;

use App\Http\Controllers\Migrador\DefinicionMigracionI2018Controller;
use App\Http\Controllers\Migrador\DefinicionMigracionF2018Controller;
use App\Http\Controllers\Migrador\DefinicionMigracionI2019Controller;
use App\Http\Controllers\Migrador\DefinicionMigracionF2019Controller;
use App\Http\Controllers\Migrador\DefinicionMigracionI2020Controller;
use App\Http\Controllers\Migrador\DefinicionMigracionF2020Controller;
use App\Http\Controllers\Migrador\DefinicionMigracionI2021Controller;
use App\Http\Controllers\Migrador\DefinicionMigracionF2021Controller;
use App\Http\Controllers\Migrador\DefinicionMigracionI2022Controller;
use App\Http\Controllers\Migrador\DefinicionMigracionF2022Controller;
use App\Http\Controllers\Migrador\DefinicionMigracionI2023Controller;
use App\Http\Controllers\Migrador\DefinicionMigracionF2023Controller;
use App\Http\Controllers\Migrador\DefinicionMigracionI2024Controller;

class ArmarFormularioController extends Controller
{


static public function generar_formularios()  { 
 

		// ArmarI2018Controller::I2018();
		// ArmarF2018Controller::F2018();
		// ArmarI2019Controller::I2019();
		// ArmarF2019Controller::F2019();	
		// ArmarI2020Controller::I2020();
		// ArmarF2020Controller::F2020();
		// ArmarI2021Controller::I2021();
        // ArmarF2021Controller::F2021();
		// ArmarI2022Controller::I2022();
		// ArmarF2022Controller::F2022();
		// ArmarI2023Controller::I2023();
		//ArmarF2023Controller::F2023();
		ArmarI2024Controller::I2024();
					
		// DefinicionMigracionI2018Controller::I2018();
		// DefinicionMigracionF2018Controller::F2018();
		// DefinicionMigracionI2019Controller::I2019();
		// DefinicionMigracionF2019Controller::F2019();
		// DefinicionMigracionI2020Controller::I2020();
		// DefinicionMigracionF2020Controller::F2020();
		// DefinicionMigracionI2021Controller::I2021();
        // DefinicionMigracionF2021Controller::F2021();
        // DefinicionMigracionI2022Controller::I2022();
		// DefinicionMigracionF2022Controller::F2022();
		// DefinicionMigracionI2023Controller::I2023();
		// DefinicionMigracionF2023Controller::F2023();
		//DefinicionMigracionI2024Controller::I2024();
    }

        
}
