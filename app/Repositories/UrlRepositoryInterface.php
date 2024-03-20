<?php

namespace App\Repositories;

interface UrlRepositoryInterface {
    public function all();
    public function create(object $data);
    public function update(array $data, $id);
    public function find($data);
    public function generateShortURL();
}