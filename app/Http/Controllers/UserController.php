<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Item;
use App\Models\Inventory;
use App\Models\ItemEquipped;


class UserController extends BaseController
{
    //
    public function createUser (Request $request) 
    {
  
        $user = $request;

        try {

            $newUser = User::create([

                'name'=>$user->name,
                'email'=>$user->email,
                'player_type'=>$user->player_type,
                'user_type'=>$user->user_type,
                'password'=>$user->password

            ]);

	        $newUser->save();

            $response = $newUser;

            return $this->sendResponse($response, "User Create");
        
        }catch (\Throwable $th) {

            throw $th;

        }

    }

    public function UpdateUser (Request $request)
    {
        $user = $request;

        try {

            $userUpdate = User::find($user->id);

            $form = [
                'name'=>$user->name,
                'email'=>$user->email,
                'player_type'=>$user->player_type,
                'user_type'=>$user->user_type,
                'password'=>$user->password
            ];

            $userUpdate->update($form);

            return $this->sendResponse(true, 'The User have been successfully updated.');

        
        }catch (\Throwable $th) {

            throw $th;

        }

    }

    public function getUser(Request $request)
    {
        $userId = $request->id;
        try {
                
            $user = User::find($userId);
            return $this->sendResponse($user, 'User information');

        }catch (\Throwable $th) {

            throw $th;

        }
    }
    

    public function deleteUser (Request $request)
    {
        $userId = $request->id;

        try {

            $user = User::where("id", $userId);
            $user->delete();
            return $this->sendResponse(true, 'User Delete');

        } catch (\Throwable $th) {

            throw $th;

        }
    }

    public function createItem (Request $request) 
    {
  
        $item = $request;
  
        try {

            $newUser = Item::create([

                'name'=>$item->name,
                'item_type'=>$item->item_type,
                'armour_points'=>$item->armour_points,
                'attack_points'=>$item->attack_points,

            ]);

            $response = $newUser;

            return $this->sendResponse($response, "Item Create");
        
        }catch (\Throwable $th) {

            throw $th;

        }

    }

    public function UpdateItem (Request $request)
    {
        $item = $request;

        try {

            $itemUpdate = Item::find($item->id);

            $form = [
                'name'=>$item->name,
                'item_type'=>$item->item_type,
                'armour_points'=>$item->armour_points,
                'attack_points'=>$item->attack_points
            ];

            $itemUpdate->update($form);

            return $this->sendResponse(true, 'The Item have been successfully updated.');

        
        }catch (\Throwable $th) {

            throw $th;

        }

    }

    public function getItem(Request $request)
    {
        $itemId = $request->id;
        try {
                
            $item = Item::find($itemId);
            return $this->sendResponse($item, 'item information');

        }catch (\Throwable $th) {

            throw $th;

        }
    }

    public function deleteItem (Request $request)
    {
        $itemId = $request->id;
        try {

            $item = Item::where("id", $itemId);
            $item->delete();
            return $this->sendResponse(true, 'Item Delete');

        } catch (\Throwable $th) {

            throw $th;

        }
    }

    public function addItemToInventory (Request $request)
    {
        $item = $request;
  
        try {

            $newItem = Inventory::create([

                'user_id'=>$item->user_id,
                'item_id'=>$item->item_id

            ]);

            $response = $newItem;

            return $this->sendResponse($response, "Item added to inventory");
        
        }catch (\Throwable $th) {

            throw $th;

        }
    }

    public function deleteItemToInventory (Request $request) 
    {
        // gaston dudoso
        $inventoryId = $request->id;
        try {

            $item = Item::where("id", $inventoryId);
            $item->delete();
            return $this->sendResponse(true, 'Item Delete');

        } catch (\Throwable $th) {

            throw $th;

        }
    }

    public function equipItem (Request $request)
    {
        $itemToEquipped = $request;
  
        try {

            $itemEquipped = ItemEquipped::create([

                'user_id'=>$itemToEquipped->user_id,
                'item_id'=>$itemToEquipped->item_id,
                'type_item'=>$itemToEquipped->type_item

            ]);

            $response = $itemEquipped;

            return $this->sendResponse($response, "Item Equipped");
        
        }catch (\Throwable $th) {

            throw $th;

        }
    }

    public function unequipItem (Request $request)
    {
        // gaston dudoso
        $itemId = $request->id;
        try {

            $itemToUnequip = Item::where("id", $itemId);
            $itemToUnequip->delete();
            return $this->sendResponse(true, 'Item Delete');

        } catch (\Throwable $th) {

            throw $th;

        }
    }


}
