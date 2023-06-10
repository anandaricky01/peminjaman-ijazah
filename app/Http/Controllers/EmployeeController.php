<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('superadmin');
    }

    public function index()
    {
        $employee = Employee::all();
        return view('admin.employee.index', [
            'employee' => $employee,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.employee.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nip' => ['required', 'unique:employees,nip'],
            'nama_pegawai' => ['required', 'max:100'],
            'email' => ['required', 'unique:employees,email', 'email:dns'],
            'password' => ['required', 'min:6'],
        ]);

        $validated['password'] = Hash::make($request->password);

        try {
            Employee::create($validated);

            return redirect()->route('dashboard.employee.index')->with('success', 'Data Employee berhasil ditambah');
        } catch (QueryException $e) {
            return redirect()->back()->with('danger', 'Terdapat masalah saat pembuatan data ' . $e->errorInfo);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        return view('admin.employee.edit', [
            'employee' => $employee,
        ]);
        // return view(
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'nama_pegawai' => ['required', 'max:255'],
            'email' => ['required', 'email'],
            'role' => ['required'],
            'password-baru' => ['nullable','min:6', 'max:255']
        ]);

        if($request->email != $employee->email){
            if (Employee::where('email', $request->email)->where('id', '!=', $employee->id)->count() > 0) {
                return redirect()->back()->with('danger', 'Email sudah dipakai user lain');
            }
        }

        if($validated['password-baru']){
            $newPassword = Hash::make($validated['password-baru']);
            $validated['password'] = $newPassword;
        }

        $employee->update($validated);

        return redirect()->route('dashboard.employee.index')->with('success', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $nama = $employee->nama_pegawai;
        try {
            $employee->delete();

            return redirect()->route('dashboard.employee.index')->with('success', 'Data ' . $nama . ' berhasil dihapus!');
        } catch (QueryException $e) {
            return redirect()->back()->with('danger', 'terdapat masalah saat proses delete data ' . $nama);
        }
    }
}
