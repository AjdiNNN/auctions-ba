<?php

Flight::route('GET /bids', function(){
    Flight::json(Flight::bids_service() -> get_all());

});


Flight::route("GET /bids_by_id", function(){
  Flight::json(Flight::bids_service()->get_by_id(Flight::request()->query['id']));
});


Flight::route('GET /bids/@id', function($id){
    Flight::json(Flight::bids_service() -> get_by_id($id));

});


Flight::route('POST /bids', function(){
  $request = Flight::request()->data->getData();
  Flight::json(['message' => "bids added successfully",
                'data' => Flight::bids_service()->add($request)
               ]);


  });


  Flight::route('PUT /bids/@id', function($id){
    $bids = Flight::request()->data->getData();
    Flight::json(['message' => "bids edit successfully",
                  'data' => Flight::bids_service()->update($bids, $id)
                 ]);
  });


Flight::route('DELETE /bids/@id', function($id){
    Flight::bids_service()->delete($id);
    Flight::json(["message"=> "deleted"]);
});


?>
