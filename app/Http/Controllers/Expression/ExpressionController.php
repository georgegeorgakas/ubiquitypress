<?php

namespace App\Http\Controllers\Expression;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ExpressionModel;

class ExpressionController extends Controller
{
    private $indexes = [
        "add" => "+",
        "minus" => "-",
        "divide" => "/",
        "multiply" => "*",
    ];
    public function __construct()
    {
        $this->middleware('xml');
    }

    public function expression() {
        return response()->json(ExpressionModel::get(), 200);
    }

    public function expressionByID($id) {
        return response()->json(ExpressionModel::find($id), 200);
    }

    public function expressionSave(Request $request) {
        $xmlResponse = $request->xml();
        if (!isset($xmlResponse["expression"])) {
            return response()->json(["message" => "Invalid Parameters on XML"], 400);
        }
        $expressions = $xmlResponse["expression"];

        foreach ($expressions as $expression) {
            $data = $this->getResult($expression);
            $expression = ExpressionModel::create($data);
        }
        return response()->json($expression, 201);
    }

    public function expressionUpdate(Request $request, $id) {
        $xmlResponse = $request->xml();
        if (!isset($xmlResponse["expression"])) {
            return response()->json(["message" => "Invalid Parameters on XML"], 400);
        }
        $expression = $xmlResponse["expression"];

        $data = $this->getResult($expression);
        $updateModel = ExpressionModel::find($id);
        $updateModel->update($data);

        return response()->json(null, 201);
    }

    public function expressionDelete($id) {
        $isDeleted =  ExpressionModel::destroy($id);
        if($isDeleted) {
            return response()->json(null, 204);
        }
        return response()->json("Id $id was not found", 400);
    }

    private function getResult($expression) {
        $data = [
            'result' => 0,
            'expression' => ''
        ];
        foreach ($expression as $key => $math) {
            foreach ($this->indexes as $indexKey => $index) {
                if (isset($math[$indexKey])) {
                    $data = $this->calculate($indexKey, 0, $math[$indexKey], "");
                }
            }
            $data = $this->calculate($key, $data["result"], $math['number'], $data["expression"]);
        }
        return $data;
    }

    private function calculate($type, $result, $value, $expression) {
        switch ($type) {
            case 'add' :
                $result += $value;
                $expression = $expression."+".$value;
                return [
                    'expression' => $expression,
                    'result' => $result
                ];
            case 'minus' :
                $result -= $value;
                $expression = $expression."-".$value;
                return [
                    'expression' => $expression,
                    'result' => $result
                ];
            case 'multiply' :
                return $this->multiply($value['number']);
            case 'divide' :
                return $this->divide($value['number']);
            default :
                return 0;
        }
    }

    private function multiply (array $numbers) {
        $expression = $numbers[0]."*".$numbers[1];
        $result = $numbers[0] * $numbers[1];
        return [
            'expression' => $expression,
            'result' => $result
        ];
    }

    private function divide (array $numbers) {
        $expression = $numbers[0]."/".$numbers[1];
        $result = $numbers[0] / $numbers[1];
        return [
            'expression' => $expression,
            'result' => $result
        ];
    }
}
