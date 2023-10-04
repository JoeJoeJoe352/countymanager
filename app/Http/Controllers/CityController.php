<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{

    /**
     * Létrehoz egy új várost a megadott megye alá
     * @param Request $request
     * @return type
     */
    public function saveCity(Request $request)
    {
        $validator = Validator::make([
                    'name' => 'required|unique:city|max:255',
                    'county_id' => 'exists:county,id',
        ]);

        if ($validator->fails())
        {
            return response()->json($validator->errors, 400);
        }

        $model = new City();
        $model->name = $request->get("name");
        $model->county_id = $request->get("county_id");
        $saveSuccess = $model->save();

        if ($saveSuccess)
        {
            return response()->json(true, 201);
        } else
        {
            return response()->json("Hiba történt a mentés során", 500);
        }
    }

    /**
     * Módosítja a megadott id-hoz tartozó várost. Most mindenki módosíthatja mindenki városát
     * @param int $id
     */
    public function updateCity(Request $request, int $id)
    {
        $cityModel = City::find($id);
        if (!$cityModel)
        {
            return response()->json("Nem létezik város ilyen azonosítóval", 404);
        }
        $validator = Validator::make([
                    'name' => 'required|unique:city|max:255',
        ]);
        if ($validator->fails())
        {
            return response()->json($validator->errors, 400);
        }

        $cityModel->name = $request->get("name");
        $cityModel->save();
        return response()->json(true, 200);
    }

    /**
     * Törli a megadott id-hoz tartozó várost. Most mindenki törölheti mindenki városát
     * @param int $id
     */
    public function deleteCity(int $id)
    {
        $deleteSuccess = City::find($id)->delete();
        if ($deleteSuccess)
        {
            return response()->json("Sikeres törlés", 204);
        } else
        {
            return response()->json("Hiba történt a törlés során", 500);
        }
    }
}
