<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Customer;
use App\Projet;
use App\ProjetFiles;
use App\User;
class ProjetController extends Controller
{
    
/*===============================================
    INDEX
===============================================*/
public function index()
{
    
    $users =  User::all() ; 
    $projets  = Projet::orderBy('created_at', 'desc')->paginate(10) ;  // Paginate Tasks 
    
    return view('projet.projets')->with('projets', $projets) 
                             ->with('users', $users ) ;
                            //  ->with('today', $today) ;
}

/*===============================================
LIST Tasks
===============================================*/
public function projetlist( $customerid ) {

    // dd($projectid);
    $users =  User::all() ;
    $c_name = Customer::find($customerid) ;
    // ->get()  will return a collection
    $projet_list = Projet::where('customer_id','=' ,$customerid)->get();
    return view('projet.list')->with('users', $users) 
                            ->with('c_name', $c_name)
                            ->with('projet_list', $projet_list) ;
}

/*===============================================
VIEW Task
===============================================*/
public function view($id)  {
    $images_set = [] ;
    $files_set = [] ;
    $images_array = ['png','gif','jpeg','jpg'] ;
    // get task file names with task_id number
    $projetfiles = ProjetFiles::where('projet_id', $id )->get() ;

    if ( count($projetfiles) > 0 ) { 
        foreach ( $projetfiles as $projetfile ) {

            // explode the filename into 2 parts: the filename and the extension
            $projetfile = explode(".", $projetfile->filename ) ;
            // store images only in one array
            // $taskfile[0] = filename
            // $taskfile[1] = jpg
            // check if extension is a image filetype
            if ( in_array($projetfile[1], $images_array ) ) 
                $images_set[] = $projetfile[0] . '.' . $projetfile[1] ;
                // if not an image, store in files array
            else
                $files_set[] = $projetfile[0] . '.' . $projetfile[1]; 
        }
    }



    $projet_view = Projet::find($id) ;

    // Get task created and due dates
    $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $projet_view->created_at);
    $to   = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $projet_view->duedate ); // add here the due date from create task

    $current_date = \Carbon\Carbon::now();

    // Format dates for Humans
    $formatted_from = $from->toRfc850String();  
    $formatted_to   = $to->toRfc850String();

    // Get Difference between current_date and duedate = days left to complete task
    // $diff_in_days = $from->diffInDays($to);
    $diff_in_days = $current_date->diffInDays($to);

    // Check for overdue tasks
    $is_overdue = ($current_date->gt($to) ) ? true : false ;

    // $task_view->project->project_name   will output the project name for this specific task
    // to populate the right sidebar with related tasks
    $customers = Customer::all() ;
    return view('projet.view')
        ->with('projet_view', $projet_view) 
        ->with('customers', $customers) 
        ->with('projetfiles', $projetfiles)
        ->with('diff_in_days', $diff_in_days )
        ->with('is_overdue', $is_overdue) 
        ->with('formatted_from', $formatted_from ) 
        ->with('formatted_to', $formatted_to )
        ->with('images_set', $images_set)
        ->with('files_set', $files_set) ;
}

/*===============================================
SORT TASKS
===============================================*/
public function sort( $key ) {
    $users = User::all() ;
    // dd ($key) ; 
    switch($key) {
        case 'projet':
            $projets = Projet::orderBy('projet')->paginate(10); // replace get() with paginate()
        break;
        case 'priority':
            $projets = Projet::orderBy('priority')->paginate(10);
        break;
        case 'completed':
            $projets = Projet::orderBy('completed')->paginate(10);
        break;
    }

    return view('projet.projets')->with('users', $users)
                            ->with('projets', $projets) ;
}

/*===============================================
CREATE TASK
===============================================*/
public function create()
{
    $customers = Customer::all()  ;
    $users = User::all() ;
    return view('projet.create')->with('customers', $customers) 
                              ->with('users', $users) ;        
}

/*===============================================
STORE NEW TASK
===============================================*/
public function store(Request $request)
{
    // dd($request->all() ) ;
    $projets_count = Projet::count() ;
    
    if ( $projets_count < 20  ) { 
        // dd( $request->all()  ) ;
        // dd($request->file('photos'));

        $this->validate( $request, [
            'projet_title' => 'required',
            'projet'       => 'required',
            'customer_id' => 'required|numeric',
            'photos.*'   => 'sometimes|required|mimes:png,gif,jpeg,jpg,txt,pdf,doc',  // photos is an array: photos.*
            'duedate'    => 'required'
        ]) ;

        // dd($request->all() ) ;
        // First save Task Info
        $projet = Projet::create([
            'customer_id' => $request->customer_id,
            'user_id'    => $request->user,
            'projet_title' => $request->projet_title,
            'projet'       => $request->projet,
            'priority'   => $request->priority,
            'duedate'    => $request->duedate
        ]);

        // Then save files using the newly created ID above
        if( $request->hasFile('photos') ) {
            foreach ($request->photos as $file) {
                // To Storage
                //$filename = $file->store('public'); // /storage/app/public

                // filename will be saved as: public/wKZsF9ltDSNj82ynh.png
                // explode this value at / and get the second element
                // $filename = explode("/", $filename ) ; // FOR STORAGE

                // If you want to save into  /public/images
               // $filename = str_replace(' ' , '' , time() . '_' .$file->getClientOriginalName() );  // get original file name ex:   cat.jpg
                // remove whitespaces and dots in filenames : [' ' => '', '.' => ''] 
                $filename = strtr( pathinfo( time() . '_' . $file->getClientOriginalName(), PATHINFO_FILENAME) , [' ' => '', '.' => ''] ) . '.' . pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
                $file->move('images',$filename);

                // save to DB
                ProjetFiles::create([
                    'projet_id'  => $projet->id, // newly created ID
                    'filename' => $filename  // For Regular Public Images
                    //'filename' => $filename[1]  // [0] => public, [1] => wKZsF9ltDSNj82ynh.png FOR STORAGE
                ]);
            }
        }

        Session::flash('success', 'Project Created') ;
        return redirect()->route('projet.show') ; 
    }
    
    else {
        Session::flash('info', 'Please delete some projet, Demo max Customers: 20') ;
        return redirect()->route('projet.show') ;         
    }

}

/*===============================================
MARK TASK AS COMPLETED
===============================================*/
public function completed($id)
{
    $projet_complete = Projet::find($id) ;
    $projet_complete->completed = 1;
    $projet_complete->save() ;
    return redirect()->back();
}

/*===============================================
EDIT TASK
===============================================*/
public function edit($id)
{
// $project::find(1)->tasks; retrieves the project record with id 1 and lists all tasks that have the project_id 1.

    // $task_list = Task::where('project_id','=' , $projectid)->get();
    $projet = Projet::find($id)  ; 
    $projetfiles = ProjetFiles::where('projet_id', '=', $id)->get() ;
    // dd($taskfiles) ;
    $customers = Customer::all() ;
    $users = User::all() ;
    //$project_edit = Project::find($id)->tasks ; 
    // echo '<pre>';
    // print_r( Project::all() );
    // echo '</pre>';

    // dd($task_edit) ;  // returns NULL

    //dd($task_edit) ;  // Works
    //$project_edit = Project::find($id) ;
    return view('projet.edit')->with('projet', $projet)
                            ->with('customers', $customers ) 
                            ->with('users', $users)
                            ->with('projetfiles', $projetfiles);
}

/*===============================================
UPDATE TASK
===============================================*/
public function update(Request $request, $id)
{
    // dd( $request->all() ) ;
    $update_projet = Projet::find($id) ;
    // dd( $update_task->id ) ;

    $this->validate( $request, [
        'projet_title' => 'required',
        'projet'       => 'required',
        'customer_id' => 'required|numeric',
        'photos.*'   => 'sometimes|required|mimes:png,gif,jpeg,jpg,txt,pdf,doc' // photos is an array: photos.*
    ]) ;

    $update_projet->projet_title = $request->projet_title; 
    $update_projet->projet       = $request->projet;
    $update_projet->user_id    = $request->user_id;
    $update_projet->customer_id = $request->customer_id;
    $update_projet->priority   = $request->priority;
    $update_projet->completed  = $request->completed;
    $update_projet->duedate    = $request->duedate;

    if( $request->hasFile('photos') ) {
        foreach ($request->photos as $file) {
            // remove whitespaces and dots in filenames : [' ' => '', '.' => ''] 
            $filename = strtr( pathinfo( time() . '_' . $file->getClientOriginalName(), PATHINFO_FILENAME) , [' ' => '', '.' => ''] ) . '.' . pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
           // $filename = str_replace(' ' , '' , pathinfo( time() . '_' . $file->getClientOriginalName(), PATHINFO_FILENAME)   ) . '.' . pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);  // get original file name ex:   cat.jpg
          //  echo 'filename: ' . $filename ; 

           // dd ($filename) ; 
            $file->move('images',$filename);

            // save to DB
            ProjetFiles::create([
                'projet_id'  => $request->projet_id,
                'filename' => $filename  // For Regular Public Images
            ]);
        }        
    }

    $update_projet->save() ;
    
    Session::flash('success', 'Project was sucessfully edited') ;
    return redirect()->route('projet.show') ;
}

/*===============================================
DESTROY TASK
===============================================*/
public function destroy($id)
{
    $delete_projet = Projet::find($id) ;
    $delete_projet->delete() ;
    Session::flash('success', 'Project was deleted') ;
    return redirect()->back();
}

/*===============================================
DELETE FILE
===============================================*/
public function deleteFile($id) {
    $delete_file = ProjetFiles::find($id) ;
    // remove  file from public directory
    unlink( public_path() . '/images/' . $delete_file->filename ) ;

    // delete entry from database
    $delete_file->delete() ;
    Session::flash('success', 'File Deleted') ;
    return redirect()->back(); 
}

/*===============================================
SEARCH TASK
===============================================*/
public function searchProjet() {
    $value = Input::get('search_projet');
    $projets = Projet::where('projet', 'LIKE', '%' . $value . '%')->limit(25)->get();

    return view('projet.search', compact('value', 'projets')  ) ;
}


}
