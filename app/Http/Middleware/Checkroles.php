<?php

namespace App\Http\Middleware;

use App\models\Muser_role;

use Closure;

class Checkroles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,...$roles)
    {
        $user = Muser_role::find($request->User()->role);
        //dump($user);
      // dd($roles);
        ///cek role yang masuk jika ada maka lanjutkan ketahap selanjutnya
        if(in_array($user->role_name,$roles)){

            return $next($request);
        }

        if($user->role_name == 'guests'){
            return redirect('/'); 
        }
        abort(403, 'UPS!! Anda tidak mempunyai akses kesini');
        //return redirect('/');

    }
}
