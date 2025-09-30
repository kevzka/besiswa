<?php

namespace App\Http\Controllers;

use App\Models\Tb_kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class CrudController extends Controller
{
    protected $routeModuleMapping = [
        'admin.bimbingan.index' => [1, 'bimbingan'],
        'admin.prestasi.index' => [2, 'prestasi'],
        'admin.ekskul.index' => [3, 'ekskul'],
        'admin.bimbingan.store' => [1, 'bimbingan'],
        'admin.prestasi.store' => [2, 'prestasi'],
        'admin.ekskul.store' => [3, 'ekskul'],
        'admin.bimbingan.update' => [1, 'bimbingan'],
        'admin.prestasi.update' => [2, 'prestasi'],
        'admin.ekskul.update' => [3, 'ekskul'],
        'admin.bimbingan.destroy' => [1, 'bimbingan'],
        'admin.prestasi.destroy' => [2, 'prestasi'],
        'admin.ekskul.destroy' => [3, 'ekskul'],
        'admin.bimbingan.edit' => [1, 'bimbingan'],
        'admin.prestasi.edit' => [2, 'prestasi'],
        'admin.ekskul.edit' => [3, 'ekskul'],
        'admin.bimbingan.create' => [1, 'bimbingan'],
        'admin.prestasi.create' => [2, 'prestasi'],
        'admin.ekskul.create' => [3, 'ekskul'],
    ];
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $currentRouteName = $request->route()->getName();
        $activityType = $this->routeModuleMapping[$currentRouteName][0];
        // $activities = Http::get('http://besiswa.test/api/crud')->json()['data'];
        // $activities = [];
        $user = Auth::user();
        $roleName = $user->getRole ? $user->getRole->role : '';
        
        return view("admin.{$this->routeModuleMapping[$currentRouteName][1]}.index", compact('activities'), ['role' => $roleName, 'id_role' => $user->id_roles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $currentRouteName = $request->route()->getName();
        $activityType = $this->routeModuleMapping[$currentRouteName][0];
        $activities = Http::post('http://besiswa.test/api/crud/create', ['type' => $activityType])->json()['data'];
        $user = Auth::user();
        $roleName = $user->getRole ? $user->getRole->role : '';
        return view("admin.{$this->routeModuleMapping[$currentRouteName][1]}.create", compact('activities'), ['role' => $roleName, 'id_role' => $user->id_roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Interact with API through HTTP request
        $user = Auth::user();
        $currentRouteName = $request->route()->getName();
        $activityType = $this->routeModuleMapping[$currentRouteName][0];

        $requestData = array_merge(
            $request->except(['_token', 'files']),
            [
                'id_admin' => $user->id, 
                'type' => $activityType
            ]
        );

        $httpRequest = Http::asMultipart();

        // Add form data to multipart request
        foreach ($requestData as $key => $value) {
            $httpRequest = $httpRequest->attach($key, $value);
        }

        // Handle file attachment if present
        if ($request->hasFile('file')) {
            $uploadedFile = $request->file('file');
            $httpRequest = $httpRequest->attach(
                'file',
                file_get_contents($uploadedFile->getRealPath()),
                $uploadedFile->getClientOriginalName()
            );
        }

        $response = $httpRequest->post('http://besiswa.test/api/crud');
        
        $currentRouteName = $request->route()->getName();
        return redirect()->route("admin.{$this->routeModuleMapping[$currentRouteName][1]}.create");
    }

    /**
     * Display the specified resource.
     */
    public function show(Tb_kegiatan $tb_kegiatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, Request $request)
    {
        $currentRouteName = $request->route()->getName();
        $activityType = $this->routeModuleMapping[$currentRouteName][0];
        $activityData = Http::get("http://besiswa.test/api/crud/{$id}/edit")->json()['data'];
        return view("admin.{$this->routeModuleMapping[$currentRouteName][1]}.edit", compact('activityData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $activityId)
    {
        $requestData = array_merge(
            $request->except(['_token', 'files'])
        );

        $httpRequest = Http::asMultipart();

        // Add form data to multipart request
        foreach ($requestData as $key => $value) {
            $httpRequest = $httpRequest->attach($key, $value);
        }

        // Handle file attachment if present
        if ($request->hasFile('file')) {
            $uploadedFile = $request->file('file');
            $httpRequest = $httpRequest->attach(
                'file',
                file_get_contents($uploadedFile->getRealPath()),
                $uploadedFile->getClientOriginalName()
            );
        }

        $response = $httpRequest->post("http://besiswa.test/api/crud/{$activityId}");
        
        $currentRouteName = $request->route()->getName();
        return redirect()->route("admin.{$this->routeModuleMapping[$currentRouteName][1]}.create");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, Request $request)
    {
        $response = Http::delete("http://besiswa.test/api/crud/{$id}");
        $currentRouteName = $request->route()->getName();
        return redirect()->route("admin.{$this->routeModuleMapping[$currentRouteName][1]}.create");
    }
}