<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Ultraware\Roles\Models\Role;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
    public function index(Request $request)
    {

      switch($request->submitbutton) {
        case 'filter-user-true':        
          $request->session()->put('filter_user', [
            'filter_name' => ($request->get('name') !== null) ? $request->get('name') : '',
            'filter_username'=>($request->get('username') !== null) ? $request->get('username') : '',          
            'filter_rol'=>($request->get('rol') !== null) ? $request->get('rol') : '',           
            'filter_user_aplicado'=>true
        ]);       
        break;
        case 'filter-user-false': 
          $request->session()->put('filter_user', [
            'filter_name' => '',
            'filter_username' => '',
            'filter_rol'=> '',
            'filter_user_aplicado'=>false
        ]);            
        break;
       }

      // pasamos el recues a una variable local $filter_user
      $filter_user = $request->session()->get('filter_user') ;    
       
      $users=User::join('role_user', 'role_user.user_id','=','users.id')
          ->join('roles', 'roles.id','=','role_user.role_id')
          ->orderBy('name', 'asc')      
          ->select('users.id','users.name', 'users.username', 'users.email', 'users.activo',           
                   'roles.name as rol', 'roles.slug', 'roles.level')
          ->Name($filter_user['filter_name'])
          ->Username($filter_user['filter_username'])
          ->Rol($filter_user['filter_rol'])
          ->Paginate(10);             
          
         $roles=Role::select('name')->get();         
         return view('admin.user.index', compact('users', 'roles', 'filter_user'));      
    }

   public function deleteuser($id){
     User::destroy($id);        
     return back();
    }

    public function getnewuser()
    {   
      $perfil=Role::all();      
      return view('admin.user.new', compact('perfil')); 
    }

    public function postnewuser(Request $r)
    {
         $this->validate($r, [
            'name' => 'required|string|max:255',
            'username'=>'required|string|min:6|max:15|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            //'activo' => 'required|boolean',            
        ]);
  
       if ($r->activo!=1) {
              $r->activo=0;
            }
         $user= new User;
         $user->name=$r->name;
         $user->username=$r->username;
         $user->email=$r->email;
         $user->password=bcrypt($r->password);
         $user->activo=$r->activo;
         $user->save();
        
         $user->attachRole($r->id_perfil);

           // CHEQUEAMOS USUARIO SUPERVISOR y asignamos localizaciones supervisadas
                  /* ESTATAL:
                     RE00101 Referente distrital
                     JD001 Jefe distrital
                     JRE001 Jefe Regional

                     DIPREGEP:
                     RP02501 Referente Privado x region
                     JRP001 Jefe Regional Privado
                  */

         if (   (substr($user->username,0,2) == 'RE'  and is_numeric(substr($user->username,2,3)) )
             or (substr($user->username,0,2) == 'JD'  and is_numeric(substr($user->username,2,3)) )
             or (substr($user->username,0,3) == 'JRE' and is_numeric(substr($user->username,3,3)) )
             or (substr($user->username,0,2) == 'RP'  and is_numeric(substr($user->username,2,3)) )
             or (substr($user->username,0,3) == 'JRP' and is_numeric(substr($user->username,3,3)) )
            )
            {
               //-- determinar filtro de sector
               if (  substr($user->username,0,2) == 'RE' or substr($user->username,0,2) == 'JD' or substr($user->username,0,3) == 'JRE' )
                 {   $f_dep='0.1.2'; } //-- uso mascara de estatales
               elseif (substr($user->username,0,2) ==  'RP' or substr($user->username,0,3) == 'JRP') 
                 {   $f_dep='3.4'; } //-- uso mascara de dipregep
                    
               //--determinar filtro de region o distrito
               if (substr($user->username,0,2) == 'RE' or substr($user->username,0,2) == 'JD' )  
                 {   $f_area="pa.codigo_distrito='".substr($user->username,2,3)."'";   }
               elseif (substr($user->username,0,2) ==  'RP') 
                 {   $f_area="r.id_region_educativa='".substr($user->username,2,3)."'"; } 
               elseif (substr($user->username,0,3) == 'JRE' or substr($user->username,0,3) == 'JRP')
                 {   $f_area="r.id_region_educativa='".substr($user->username,3,3)."'"; }

               //--buscar las localizaciones del usuario
               $query="select distinct id_localizacion from localizaciones_periodo lp
                     join partidos pa on pa.c_departamento=lp.c_departamento join regiones r on r.id_region_educativa=pa.id_region_educativa
                     where '".$f_dep."' like '%'||substring(lp.codigo_jurisdiccional,1,1)||'%' and " .$f_area;

               $loc=DB::select($query,  [] );
               foreach ($loc as $key => $l)
                  {
                     // agrego la asignacion del usuario con la localizacion
                     Usuario_localizacion_assn::insert( ['id_localizacion' => $l->id_localizacion, 'id_usuario' => $user->id ]);
                  }
            }
            
        // toastr()->success('Datos guardados correctamente!!');    
        return redirect('newuser');
    }

  
     public function getedituser($id)                     
     { 
  
        $user=User::select('users.*', 
         'role_user.role_id')
          ->join('role_user', 'role_user.user_id' ,'users.id')
           ->find($id);

        $perfil=Role::pluck('name','id');
        // toastr()->success('Datos modificados correctamente!!');  
        return view('admin.user.edit', compact('user', 'perfil'));
     }

     public function postedituser(Request $r, $id)
    {        
           $user= User::find($id);

            $user->name= $r->name;
            $user->username= $r->username;
            $user->email=$r->email;        
            if ($r->activo!=1) {
              $r->activo=0;
            }
            $user->activo=$r->activo;
             $user->save(); 

            $user->detachAllRoles();
            $user->attachRole($r->id_perfil);
            // toastr()->success('Datos eliminados correctamente!!');  
            return redirect('usuarios');  
                    
    }

    public function geteditpass($id)                     
     {
        $user=User::find($id);            
        return view('admin.user.pass', compact('user'));
     }

    public function posteditpass(Request $r, $id)
    {        
            $user= User::find($id);
            $user->password=bcrypt($r->password);
            $user->save();
         if (
              substr($user->username,0, 2) == 'RE' || 
              substr($user->username,0, 2) == 'JD' || 
              substr($user->username,0, 2) == 'RP' ||
              substr($user->username,0, 3) == 'JRE' || 
              substr($user->username,0, 3) == 'JRP'
          ) {
            $DL = DB::connection('manager')->select('
            UPDATE usuario
              SET email = :email, password = :password, nombre_completo = :nombre_completo, telefono = :telefono
              WHERE nombre = :username', [                
                'email' => $user->email,
                'password' => md5($r->password),
                'nombre_completo' => $user->name,
                'telefono' => '(DNI '.$r->password.')',
                'username' => $user->username,
              ]);               
          }
         
         return redirect('usuarios');                      
    }  
}
