<?php
namespace App\Repository\Contracts;

interface UserRepositoryContracts {
    public function index():object;
    public function store(array $data):object;  
    public function destroy(int $id): bool; 
}