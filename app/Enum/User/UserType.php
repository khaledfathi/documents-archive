<?php 
namespace App\Enum\User;

/**
 * enum for User types [admin | user]
 */
enum UserType:string{
    case ADMIN = "admin"; 
    case USER = "user"; 
}; 