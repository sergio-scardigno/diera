<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Model\Periodos;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()  {
      Session::put('filter', [
        'filter_name' => '',         
        'filter_cue' => '',
        'filter_clave'=> '',
        'filter_rama'=> '',
        'filter_estado'=> '',          
        'filter_distrito'=> '',
        'filter_supervicion'=>'',
        'filter_region_educativa'=>'',
        'filter_aplicado'=>false
    ]);            
    Session::put('filter_user', [
          'filter_name' => '',
          'filter_username' => '',
          'filter_rol'=> '',
          'filter_user_aplicado'=>false
      ]);            
      Session::put('filter_servicio', [        
        'filter_distrito' => '',
        'filter_nronota' => '',                                           
        'filter_aplicado2' =>false
      ]);            

     return view('home');
    }

    public function periodo()
    {
      $periodos=Periodos::select('periodos.*')->Paginate(10);        
      return view('admin.periodo.periodo', compact('periodos'));
    }

    public function geteditperiodo($id)                     
     { 
        $periodo=Periodos::select('periodos.*')->find($id);                
        return view('admin.periodo.edit', compact('periodo'));
     }

    public function posteditperiodo(Request $r, $id)
    {       
       if ($r->en_carga!=null) {
          $en_carga=true;  
        }
        else{
         $en_carga=false;     
        }
           $periodo= Periodos::find($id);
           $periodo->id_periodo=$r->id_periodo;        
           $periodo->periodo=$r->periodo;
           $periodo->año=$r->año;
           $periodo->momento=$r->momento;
           $periodo->en_carga=$en_carga;
           $periodo->fecha_inicio=$r->fecha_inicio;
           $periodo->fecha_fin=$r->fecha_fin;
           $periodo->fecha_cortedealtas=$r->fecha_cortedealtas;
           $periodo->save(); 
           return redirect('periodo');                      
    } 

  public function getnewperiodo()
    {   
      return view('admin.periodo.new'); 
    }
    
    public function postnewperiodo(Request $r)
    {
      if ($r->en_carga!=null) {
          $en_carga=true;  
        }
        else{
         $en_carga=false;     
        }
           $periodo= new Periodos;   
           $periodo->id_periodo=$r->id_periodo;        
           $periodo->periodo=$r->periodo;
           $periodo->año=$r->año;
           $periodo->momento=$r->momento;
           $periodo->en_carga=$en_carga;
           $periodo->fecha_inicio=$r->fecha_inicio;
           $periodo->fecha_fin=$r->fecha_fin;
           $periodo->fecha_cortedealtas=$r->fecha_cortedealtas;
           $periodo->save(); 
        return redirect('periodo');
    }

    public function estadistica()
    {
        return view('estadistica');
    }
}