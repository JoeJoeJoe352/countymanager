<?php

namespace App\Http\Controllers;

use App\Models\City;
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
        $validator = Validator::make($request->all(), [
                    'name' => 'required|unique:city|max:255|min:2',
                    'county_id' => 'required|integer|exists:county,id',
                        ], $this->getValidatorMessages());

        if ($validator->fails())
        {
            return response()->json(["data" => $validator->errors()], 400);
        }

        $model = City::saveNew($request->get("county_id"), $request->get("name"));

        return response()->json(["data" => $model->id], 201);
    }

    /**
     * Módosítja a megadott id-hoz tartozó várost. Most mindenki módosíthatja mindenki városát
     * @param int $id
     */
    public function updateCity(Request $request, int $id)
    {
        $cityModel = $this->preprocessData($id);

        $validator = Validator::make($request->all(), [
                    'name' => 'required|max:255|min:2|unique:city,name,' . $cityModel->id,
                        ], $this->getValidatorMessages());
        if ($validator->fails())
        {
            return response()->json(["data" => $validator->errors()], 400);
        }

        $cityModel->name = $request->get("name");
        $saveSuccess = $cityModel->save();
        if ($saveSuccess)
        {
            return response()->json(["data" => true], 200);
        } else
        {
            return response()->json(["data" => "Hiba történt a mentés során"], 500);
        }
    }

    /**
     * Törli a megadott id-hoz tartozó várost. Most mindenki törölheti mindenki városát
     * @param int $id
     */
    public function deleteCity(int $id)
    {
return response()->json(["alma"], 204);
    }

    /**
     * Validációs hibaüzenetek
     * @return array
     */
    private function getValidatorMessages(): array
    {
        return [
            'name.required' => 'Városnevet kötelező megadni!',
            'county_id.required' => 'Megyenevet kötelező megadni!',
            'county_id.exists' => 'Érvénytelen megyenév!',
            'county_id.integer' => 'Érvénytelen megyenév!',
            'name.unique' => 'Városnév foglalt!',
            'name.max' => 'Városnév túl hosszú!',
            'name.min' => 'Városnév legalább két karakter legyen!',
        ];
    }

    /**
     * Előfeldolgozza az adatokat és exceptiont dob, ha gond van
     * @param int $id
     * @return City
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    private function preprocessData(int $id): City
    {
        $cityModel = City::find($id);

        if (!$cityModel)
        {
            throw new \Illuminate\Database\Eloquent\ModelNotFoundException("Nem létezik város ilyen azonosítóval", 404);
        }
        return $cityModel;
    }
}
