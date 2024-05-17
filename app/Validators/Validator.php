<?php
namespace App\Validators;

use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class Validator
{
    /**
     * 驗證輸入
     */
    public function verifyInput(Request $request, $rule)
    {
        try {
            $request->validate($rule);
            return [ "status" => true ];
        } catch(ValidationException $e) {
            return [
                "status" => false,
                "return" => response()->json([
                    "status"  => false,
                    "message" => $e->getMessage()
                ])
            ];
        }
    }
}