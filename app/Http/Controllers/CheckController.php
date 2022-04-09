<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Customer;
use App\Check;
use App\Check\convertNumberToWord;
use App\CheckFiles;
use App\User;

class CheckController extends Controller
{
    
    
/*===============================================
    INDEX
===============================================*/
public function index()
{
    
    $customers= Customer::all();
    $users =  User::all() ; 
    $checks  = Check::orderBy('created_at', 'desc')->paginate(10) ;  // Paginate Tasks 
   
    return view('check.checks')->with('checks', $checks) 
                             ->with('users', $users ) 
                             ->with('customers', $customers ) ;
                            //  ->with('today', $today) ;
}
public function index_2()
{
    
    $customers= Customer::all();
    $users =  User::all() ; 
    $checks  = Check::orderBy('created_at', 'desc')->paginate(10) ;  // Paginate Tasks 
   
    return view('check.checks_2')->with('checks', $checks) 
                             ->with('users', $users ) 
                             ->with('customers', $customers ) ;
                            //  ->with('today', $today) ;
}
public function checklist( $customerid ) {

    // dd($projectid);
    $users =  User::all() ;
    $c_name = Customer::find($customerid) ;
    // ->get()  will return a collection
    $check_list = Check::where('customer_id','=' ,$customerid)->get();
    return view('check.list')->with('users', $users) 
                            ->with('c_name', $c_name)
                            ->with('check_list', $check_list) ;
}

public function view($id)  {
    $images_set = [] ;
    $files_set = [] ;
    $images_array = ['png','gif','jpeg','jpg'] ;
    // get task file names with task_id number
    $checkfiles = CheckFiles::where('check_id', $id )->get() ;

    if ( count($checkfiles) > 0 ) { 
        foreach ( $checkfiles as $checkfile ) {

            // explode the filename into 2 parts: the filename and the extension
            $checkfile = explode(".", $checkfile->filename ) ;
            // store images only in one array
            // $taskfile[0] = filename
            // $taskfile[1] = jpg
            // check if extension is a image filetype
            if ( in_array($checkfile[1], $images_array ) ) 
                $images_set[] = $checkfile[0] . '.' . $checkfile[1] ;
                // if not an image, store in files array
            else
                $files_set[] = $checkfile[0] . '.' . $checkfile[1]; 
        }
    }



    $check_view = Check::find($id) ;

    // Get task created and due dates
    $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $check_view->created_at);
    $to   = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $check_view->duedate ); // add here the due date from create task

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
    $users = User::all() ;
    return view('check.view')
        ->with('check_view', $check_view) 
        ->with('customers', $customers) 
        ->with('users', $users) 
        ->with('checkfiles', $checkfiles)
        ->with('diff_in_days', $diff_in_days )
        ->with('is_overdue', $is_overdue) 
        ->with('formatted_from', $formatted_from ) 
        ->with('formatted_to', $formatted_to )
        ->with('images_set', $images_set)
        ->with('files_set', $files_set) ;
}


public function create()
{
    $customers = Customer::all()  ;
    $users = User::all() ;
    return view('check.create')->with('customers', $customers) 
                              ->with('users', $users) ;        
}

/*===============================================
STORE NEW TASK
===============================================*/
public function store(Request $request)
{
    // dd($request->all() ) ;
    $checks_count = Check::count() ;
    
    if ( $checks_count < 20  ) { 
        // dd( $request->all()  ) ;
        // dd($request->file('photos'));

        $this->validate( $request, [
            // 'beneficiary' => 'required',
            'location'       => 'required',
            'bank'=>'required',
            // 'observation'=>'required',
            'amount'     => 'required|numeric',
            'customer_id' => 'required|numeric',
            'photos.*'   => 'sometimes|required|mimes:png,gif,jpeg,jpg,txt,pdf,doc',  // photos is an array: photos.*
            'duedate'    => 'required'
        ]) ;
    
    $words = Check::convertNumberToWord($request->amount);
        // dd($request->all() ) ;
        // First save Task Info
        $check = Check::create([
            'customer_id' => $request->customer_id,
            'user_id'    => Auth::user()->id,
            'coment' => $words,
            'amount'       => $request->amount,
            'observation'       => $request->observation,
            'bank'       => $request->bank,
            'location'       => $request->location,
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
                CheckFiles::create([
                    'check_id'  => $check->id, // newly created ID
                    'filename' => $filename  // For Regular Public Images
                    //'filename' => $filename[1]  // [0] => public, [1] => wKZsF9ltDSNj82ynh.png FOR STORAGE
                ]);
            }
        }

        Session::flash('success', 'Check Created') ;
        return redirect()->route('check.show') ; 
    }
    
    else {
        Session::flash('info', 'Please delete some Files, Demo max Check: 20') ;
        return redirect()->back() ;         
    }

}

/*===============================================
MARK TASK AS COMPLETED
===============================================*/
public function completed($id)
{
    $check_complete = Check::find($id) ;
    $check_complete->completed = 1;
    $check_complete->save() ;
    return redirect()->back();
}

/*===============================================
EDIT TASK
===============================================*/
public function edit($id)
{
// $project::find(1)->tasks; retrieves the project record with id 1 and lists all tasks that have the project_id 1.

    // $task_list = Task::where('project_id','=' , $projectid)->get();
    $check = Check::find($id)  ; 
    $checkfiles = CheckFiles::where('check_id', '=', $id)->get() ;
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
    return view('check.edit')->with('check', $check)
                            ->with('customers', $customers ) 
                            ->with('users', $users)
                            ->with('checkfiles', $checkfiles);
}

/*===============================================
UPDATE TASK
===============================================*/
public function update(Request $request, $id)
{
    // dd( $request->all() ) ;
    $update_check = Check::find($id) ;
    // dd( $update_task->id ) ;

    $this->validate( $request, [
        'bank' => 'required',
        'location'       => 'required',
        // 'coment'       => 'required',
        'amount' => 'required|numeric',
        // 'customer_id' => 'required|numeric',
        'photos.*'   => 'sometimes|required|mimes:png,gif,jpeg,jpg,txt,pdf,doc',  // photos is an array: photos.*
       ]) ;
    $words = Check::convertNumberToWord($request->amount);

    $update_check->coment = $words; 
    $update_check->amount = $request->amount;
    $update_check->location  = $request->location;
    $update_check->user_id    = Auth::user()->id;
    $update_check->customer_id = $request->customer_id;
    $update_check->priority   = $request->priority;
    $update_check->completed  = $request->completed;
    $update_check->duedate    = $request->duedate;
    $update_check->observation     = $request->observation;
    $update_check->bank      = $request->bank;

    if( $request->hasFile('photos') ) {
        foreach ($request->photos as $file) {
            // remove whitespaces and dots in filenames : [' ' => '', '.' => ''] 
            $filename = strtr( pathinfo( time() . '_' . $file->getClientOriginalName(), PATHINFO_FILENAME) , [' ' => '', '.' => ''] ) . '.' . pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
           // $filename = str_replace(' ' , '' , pathinfo( time() . '_' . $file->getClientOriginalName(), PATHINFO_FILENAME)   ) . '.' . pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);  // get original file name ex:   cat.jpg
          //  echo 'filename: ' . $filename ; 

           // dd ($filename) ; 
            $file->move('images',$filename);

            // save to DB
            CheckFiles::create([
                'check_id'  => $request->check_id,
                'filename' => $filename  // For Regular Public Images
            ]);
        }        
    }

    $update_check->save() ;
    
    Session::flash('success', 'Check was sucessfully edited') ;
    return redirect()->route('check.show') ;
}


public function destroy($id)
{
    $delete_check = Check::find($id) ;
    $delete_check->delete() ;
    Session::flash('success', 'Check was deleted') ;
    return redirect()->back();
}

/*===============================================
DELETE FILE
===============================================*/
public function deleteFile($id) {
    $delete_file = CheckFiles::find($id) ;
    // remove  file from public directory
    unlink( public_path() . '/images/' . $delete_file->filename ) ;

    // delete entry from database
    $delete_file->delete() ;
    Session::flash('success', 'File Deleted') ;
    return redirect()->back(); 
}



}
