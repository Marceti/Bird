<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectTasksController extends Controller
{

    public function store(Project $project)
    {
        $project->addTask();

        /* Todo: Acum Vrem sa adaugam taskuri (ProjectTask) la proiecte
                , am creat un alt fisier de test : ProjectTasksTest
                avem primul test : a_project_can_have_Tasks , acest test inca are erori , video 12 min 5:00
                , am creat controllerul ProjectTasksController
                , am creat ruta de post
                , am de creat la ruta se post in modelul projects metoda addTask -> creaza intai testul in ProjectTest
        */

    }
}
