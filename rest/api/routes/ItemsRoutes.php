<?php

Flight::route('GET /items', function(){
    Flight::json(Flight::items_service() -> get_all());

});


Flight::route("GET /items_by_id", function(){
  Flight::json(Flight::items_service()->get_by_id(Flight::request()->query['id']));
});


Flight::route('GET /items/@id', function($id){
    Flight::json(Flight::items_service() -> get_by_id($id));

});


Flight::route('POST /items', function(){
  $request = Flight::request()->data->getData();
  Flight::json(['message' => "items added successfully",
                'data' => Flight::items_service()->add($request)
               ]);


  });


  Flight::route('PUT /items/@id', function($id){
    $items = Flight::request()->data->getData();
    Flight::json(['message' => "items edit successfully",
                  'data' => Flight::items_service()->update($items, $id)
                 ]);
  });


Flight::route('DELETE /items/@id', function($id){
    Flight::items_service()->delete($id);
    Flight::json(["message"=> "deleted"]);
});

Flight::route('GET /items_desc', function(){
  $name_desc = Flight::query('name_desc');
  Flight::json(Flight::items_service()->get_by_desc($name_desc));
});

?>
