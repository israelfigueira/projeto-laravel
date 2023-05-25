<?php
declare(strict_types=1);

namespace App\Services;

use App\Repositories\ExemploRepository;

class ExemploService
{
    private $exemploRepository;

    public function __construct()
    {
        $this->exemploRepository = new ExemploRepository();
    }

    public function get(int $id)
    {
        return $this->exemploRepository->get($id);
    }

    public function list(array $paramms = null)
    {
        return $this->exemploRepository->list($paramms);
    }

    public function create($request)
    {
        return $this->exemploRepository->create($request);
    }

    public function update($id, $request)
    {
        return $this->exemploRepository->update($id, $request);
    }

    public function delete($id)
    {
        return $this->exemploRepository->delete($id);
    }
}
