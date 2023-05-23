<?php
namespace App\Repository\Contracts;

interface UserRepositoryContracts {
    public function index(int $paginate=null):object;
    public function store(array $data):object;  
    public function destroy(int $id): bool; 
    public function show(int $id): object | null ;
}