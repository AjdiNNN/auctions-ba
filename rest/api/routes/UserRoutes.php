<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

/**
* @OA\Post(
*     path="/login",
*     description="Login to the system",
*     tags={"user"},
*     @OA\RequestBody(description="Basic user info", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    				@OA\Property(property="email", type="string", example="ajdin@gmail.com",	description="Email"),
*    				@OA\Property(property="password", type="string", example="1234",	description="Password" )
*        )
*     )),
*     @OA\Response(
*         response=200,
*         description="JWT Token on successful response"
*     ),
*     @OA\Response(
*         response=404,
*         description="Wrong Password | User doesn't exist"
*     )
* )
*/
Flight::route('POST /login', function () {
    $login = Flight::request()->data->getData();
    $user = Flight::userDao()->checkExistsEmail($login['email']);
    if (isset($user['id'])) {
        if (password_verify($login['password'], $user['password'])) {
            unset($user['password']);
            $jwt = JWT::encode($user, Config::JWT_SECRET(), 'HS256');
            Flight::json(['token' => $jwt]);
        } else {
            Flight::json(["message" => "Wrong password"], 404);
        }
    } else {
        Flight::json(["message" => "User doesn't exist"], 404);
    }
});
/**
* @OA\Post(
*     path="/register",
*     description="Register to the system",
*     tags={"user"},
*     @OA\RequestBody(description="Basic user info", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    				@OA\Property(property="email", type="string", example="ajdin@gmail.com",	description="Email"),
*    				@OA\Property(property="password", type="string", example="1234",	description="Password" ),
*    				@OA\Property(property="username", type="string", example="ajdin",	description="Username"),
*    				@OA\Property(property="firstname", type="string", example="Ajdin",	description="Firstname" ),
*    				@OA\Property(property="secondname", type="string", example="Hukić",	description="Secondname")
*        )
*     )),
*     @OA\Response(
*         response=200,
*         description="Success user registered"
*     ),
*     @OA\Response(
*         response=500,
*         description="Username or email is already registered"
*     )
* )
*/
Flight::route('POST /register', function () {
    $data = Flight::request()->data->getData();
    if (Flight::userDao()->checkExistsUsername($data['username'])) {
        Flight::json(["message" => "Username already registered"], 500);
    } elseif (Flight::userDao()->checkExistsEmail($data['email'])) {
        Flight::json(["message" => "Email already registered"], 500);
    } else {
        Flight::json(Flight::userDao()->addUser($data));
    }
});


Flight::route('GET /User', function(){
    Flight::json(Flight::user_service() -> get_all());

});

Flight::route("GET /User_by_id", function(){
  Flight::json(Flight::user_service()->get_by_id(Flight::request()->query['id']));
});


Flight::route('GET /User/@id', function($id){
    Flight::json(Flight::user_service() -> get_by_id($id));

});


Flight::route('POST /User', function(){
  $request = Flight::request()->data->getData();
  Flight::json(['message' => "User added successfully",
                'data' => Flight::user_service()->add($request)
               ]);


  });


  Flight::route('PUT /User/@id', function($id){
    $User = Flight::request()->data->getData();
    Flight::json(['message' => "User edit successfully",
                  'data' => Flight::user_service()->update($User, $id)
                 ]);
  });


Flight::route('DELETE /User/@id', function($id){
    Flight::user_service()->delete($id);
    Flight::json(["message"=> "deleted"]);
});

?>;
