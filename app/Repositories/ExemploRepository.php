<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\Exemplo;

class ExemploRepository
{
    public function get(int $id)
    {
        return Exemplo::find($id);
    }
    
    public function list(array $paramms = null)
    {
        return Exemplo::paginate(10);
    }

    public function create($data)
    {
        return Exemplo::create($data);
    }

    public function update($id, $data)
    {
        $row = Exemplo::find($id);
        $row->fill($data);
        $row->save();
        return $row;
    }

    public function delete($id)
    {
        $row = Exemplo::find($id);
        $row->delete();
        return $row;
    }
}
