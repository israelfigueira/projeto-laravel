<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *   description="Exemplo schema",
 *   title="Exemplo",
 *   required={},
 *   @OA\Property(type="integer",description="identificador do exmeplo",title="id",property="id",example="1",readOnly="true"),
 *   @OA\Property(type="string",description="nome do exemplo",title="nome",property="nome",example="Vaca amarela"),
 *   @OA\Property(type="integer",description="quanttidade de exemplos",title="quantidade",property="quantidade",example="99"),
 *   @OA\Property(type="number",description="valor de exemplos",title="valor_real",property="valor_real",example="99.99"),
 *   @OA\Property(type="dateTime",title="dt_exemplo",property="dt_exemplo",example="2022-07-04T02:41:42.336Z"),
 *   @OA\Property(type="dateTime",title="created_at",property="created_at",example="2022-07-04T02:41:42.336Z",readOnly="true"),
 *   @OA\Property(type="dateTime",title="updated_at",property="updated_at",example="2022-07-04T02:41:42.336Z",readOnly="true"),
 * )
 * 
 * @OA\Schema(
 *   schema="Exemplos",
 *   title="Exemplos",
 *   @OA\Property(title="data",property="data",type="array",
 *     @OA\Items(type="object",ref="#/components/schemas/Exemplo"),
 *   )
 * )
 * 
 * @OA\Parameter(
 *      parameter="Exemplo--id",
 *      in="path",
 *      name="exemplo_id",
 *      required=true,
 *      description="Id do Exemplo",
 *      @OA\Schema(
 *          type="integer",
 *          example="1",
 *      )
 * ),
 */
class Exemplo extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nome',
        'quantidade',
        'dt_exemplo',
        'valor_real',
        'created_at',
        'updated_at',
    ];

    protected $casts = [];
}
