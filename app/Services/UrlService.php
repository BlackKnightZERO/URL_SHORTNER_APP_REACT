<?php

namespace App\Services;

use App\Repositories\UrlRepositoryInterface;

class UrlService {
    public function __construct(protected UrlRepositoryInterface $urlRepository) {

    }

    public function all() {
        return $this->urlRepository->all();
    }

    public function create(object $data) {
        return $this->urlRepository->create($data);
    }

    public function find($data) {
        return $this->urlRepository->find($data);
    }

    public function update(array $data, $id) {
        return $this->urlRepository->update($data, $id);
    }
}