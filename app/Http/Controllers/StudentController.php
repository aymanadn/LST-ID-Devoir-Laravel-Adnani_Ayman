<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    // Afficher la liste des étudiants
    public function index()
    {
        $students = Student::all();

        return view('index', compact('students'));
    }

    // Afficher le formulaire d'inscription
    public function create()
    {
        return view('create');
    }

    // Enregistrer un nouvel étudiant
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'phone' => 'required',
            'section' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif,svg',
        ]);

        $image = $request->file('image');

        $destinationPath = 'image/';

        $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();

        $image->move($destinationPath, $profileImage);

        $validateData['image'] = $profileImage;

        Student::create($validateData);

        return redirect('/students');
    }

    // Afficher les détails d'un étudiant
    public function show(Student $student)
    {
        return view('show', compact('student'));
    }

    // Afficher le formulaire de modification
    public function edit(Student $student)
    {
        return view('edit', compact('student'));
    }

    // Modifier les informations d'un étudiant
    public function update(Request $request, Student $student)
    {
        $validateData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'phone' => 'required',
            'section' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg',
        ]);

        if ($request->hasFile('image')) {

            $image = $request->file('image');

            $destinationPath = 'image/';

            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();

            $image->move($destinationPath, $profileImage);

            $validateData['image'] = $profileImage;
        }

        $student->update($validateData);

        return redirect('/students');
    }

    // Supprimer un étudiant
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect('/students');
    }
}
