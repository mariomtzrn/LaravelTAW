<?php

namespace App\Http\Controllers;

use App\User;
use App\Calification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $user = User::where('id', $id)->first();
        return view('user.profile', compact('user'));
    }

    /**
     * Muestra la vista de las propuetas del usuario en sesion
     *
     * @return void
     */
    public function propuestas()
    {
        return view('user.propuestas');
    }

    /**
     * Muestra la vista de los usuarios del tipo freelancer, a excepcion del usuario en sesion
     *
     * @return void
     */
    public function freelancers()
    {
        $users = User::all()->where('type', 1)->where('id', '!=', auth()->id());
        return view('user.freelancers', compact('users'));
    }
  
    /**
     * Edita los campos de la descripcion del usuario en la vista de perfil
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit_desc(Request $request)
    {
        $campos = request()->validate([
          'descripcion'=>['required', 'min:10', 'max:255']
        ]);
        User::where('id', auth()->id())->update($campos);
        return redirect('/user/' . auth()->id() . '/profile');
    }
  
    /**
     * Obtiene el promedio de las calificaciones del usuario en el modelo Calification
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function get_calif($id_user){
      return Calification::where('id_user_calificado', $id_user)->avg('calificacion');
    }
  
    /**
     * Edita la foto de perfil del usuario
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit_foto(Request $request){
      $name = 'profpic_user_' . auth()->id() . '.png';
      Storage::delete($name);
      $request['picture']->storeAs('public/profile_pictures', $name);
      User::where('id', auth()->id())->update(array('foto_perfil'=>$name));
      return redirect('/user/' . auth()->id() . '/profile');
    }
}
