<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class ApiController extends BaseController
{
   // use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
   public function actionExchanger(): JsonResponse
   {

      $users = \DB::table('users')->get();

      return response()->json([
         'success' => true,
         'data' => $users
     ]);
   }
}
