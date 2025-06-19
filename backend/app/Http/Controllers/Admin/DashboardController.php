<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AdminDashboardService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(protected AdminDashboardService $service)
    {
        
    }

    public function index()
    {
        return $this->service->getUsers();
    }
}
