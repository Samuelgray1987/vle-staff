<?php

class ResourceSeeder
extends DatabaseSeeder
{
    public function run()
    {
        $resources = [
            [
                "pattern" => "/",
                "name"    => "user/login",
                "target"  => "UserController@loginAction",
                "secure"  => false
            ],
            [
                "pattern" => "/admin",
                "name"    => "admin/",
                "target"  => "\Admin\Controllers\HomeController",
                "secure"  => true
            ]
        ];

        foreach ($resources as $resource)
        {
            Resource::create($resource);
        }
    }
}