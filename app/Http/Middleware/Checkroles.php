<?php

namespace App\Http\Middleware;

use App\model\Muser_role;

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
        // dd($request->User()->role);
        $user = Muser_role::find($request->User()->role);

      // dd($user->role_name);
        ///cek role yang masuk jika ada maka lanjutkan ketahap selanjutnya
        if(in_array($user->role_name,$roles)){

            return $next($request);
        }
        abort(403, 'UPS!! Anda tidak mempunyai akses kesini');
        //return redirect('/home');

    }
}
