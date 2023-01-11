<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApiImportDynlistRequest;
use App\Http\Requests\ApiSearchDynlistRequest;
use Illuminate\Http\Request;
use App\Models\Dynlist;
use App\Models\Field;

class DynlistAPIController extends Controller
{
    public function import(ApiImportDynlistRequest $request)
    {
        if ($request->hasFile('csvfile')) {
            $file = $request->file('csvfile');
            $file_full_name = $file->getClientOriginalName();
            $dynlist_name = pathinfo($file_full_name, PATHINFO_FILENAME); // Filename without extension

            // Convert CSV to Array
            $data = str_getcsv($file->get(), "\n"); // Parse the rows
            foreach ($data as &$row)
                $row = str_getcsv($row, ';'); // Parse the items in rows
        }

        // Create new record in dynamic list table
        $dynlist = new Dynlist();
        $dynlist->name = $dynlist_name;
        $dynlist->save(); // $dynlist->id will contain last id to be used as foreign key reference

        $length_dynlist = count($data);
        $length_fields = count($data[0]);
        for ($i = 1; $i < $length_dynlist; $i++) {
            for ($j = 0; $j < $length_fields; $j++) {
                $field = new Field();
                $field->dynlist_id = $dynlist->id;
                $field->reg_id = $i;
                $field->field = $data[0][$j];
                $field->value = $data[$i][$j];
                $field->save();
            }
        }

        return [
            'result' => 'success',
            'message' => "File $file_full_name successfully imported",
            'data' => [
                'list' => $dynlist_name,
                'registers' => $length_dynlist - 1,
            ],
        ];
    }

    public function search(ApiSearchDynlistRequest $request)
    {
        $filters = $request->only('list', 'field', 'value');

        // Get list ID
        $dynlist = new Dynlist();

        $data = null;
        $reg_ids = [];
        $dynlist_obj = $dynlist->where('name', $filters['list'])->first();
        if ($dynlist_obj) {
            $dynlist_id = $dynlist_obj->id;

            // Get register IDs that meet condition
            $fields = new Field();
            $reg_ids = $fields->where('dynlist_id', $dynlist_id)
                ->where('field', $filters['field'])
                ->where('value', 'like', "%{$filters['value']}%")
                ->pluck('reg_id');
            $reg_ids = $reg_ids->toArray();

            // Get full register data from IDs and group by reg_id
            foreach ($reg_ids as $id) {
                $register_data = $fields->where('dynlist_id', $dynlist_id)
                    ->where('reg_id', $id)
                    ->get();
                $line = [];
                foreach ($register_data as $reg) {
                    $line[$reg->field] = $reg->value;
                }
                $data[] = $line;
            }
        }

        return $data ? [
            'result' => 'success',
            'message' => count($reg_ids) . ' registers found',
            'data' => $data,
        ] : [
            'result' => 'success',
            'message' => 'No registers found',
            'data' => [],
        ];
    }
}
