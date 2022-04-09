<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Report;
use App\User;
class ReportController extends Controller
{
    public function index()
    {
        
        $users =  User::all() ; 
        $report  = Report::orderBy('created_at', 'desc')->paginate(10) ;  
       
        return view('report.reports')->with('reports', $report) 
                                 ->with('users', $users ) ;
                               
    }

    public function view($id)  {
       
        $report_view = Report::find($id) ;

        // Get task created and due dates
        $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $report_view->created_at);
        $to   = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $report_view->duedate ); // add here the due date from create task

        $current_date = \Carbon\Carbon::now();
 
        // Format dates for Humans
        $formatted_from = $from->toRfc850String();  
        $formatted_to   = $to->toRfc850String();

        $users=User::all();
        $diff_in_days = $current_date->diffInDays($to);
        $reports = Report::all() ;
        return view('report.view')
            ->with('report_view', $report_view) 
            ->with('reports', $reports) 
            ->with('users', $users) 
            ->with('diff_in_days', $diff_in_days )
            ->with('formatted_from', $formatted_from ) 
            ->with('formatted_to', $formatted_to ) ;
    }



/*===============================================
    CREATE TASK
===============================================*/
    public function create()
    {
        $reports = Report::all()  ;
        $users = User::all() ;
        return view('report.create')->with('reports', $reports) 
                                  ->with('users', $users) ;        
    }

/*===============================================
    STORE NEW TASK
===============================================*/
    public function store(Request $request)
    {
        
        
       
            $this->validate( $request, [
                'raport_title' => 'required',
                'raport'       => 'required',           
                'duedate'    => 'required'
            ]) ;

            
            $report = Report::create([
                'user_id'    => Auth::user()->id,
                'raport_title' => $request->raport_title,
                'raport'       => $request->raport,
                'duedate'    => $request->duedate
            ]);

            // Then save files using the newly created ID above
            
            Session::flash('success', 'Report Created') ;
            return redirect()->route('report.show') ; 
        }
/*===============================================
    EDIT TASK
===============================================*/
    public function edit($id)
    {
        $report = Report::find($id)  ; 
        $users = User::all() ;
        
        return view('report.edit')->with('report', $report)
                                ->with('users', $users);
    }

/*===============================================
    UPDATE TASK
===============================================*/
    public function update(Request $request, $id)
    {
        
        $update_report = Report::find($id) ;

        $this->validate( $request, [
            'raport_title' => 'required',
            'raport'       => 'required',           
            'duedate'    => 'required'
        ]) ;

        $update_report->report_title =$request->report_title;
        $update_report->report       = $request->report;
        $update_report->duedate       = $request->duedate;
        // $update_report->user_id       = $request->Auth::user()->id;
        $update_report->save() ;
        
        Session::flash('success', 'Report was sucessfully edited') ;
        return redirect()->route('report.show') ;
    }

/*===============================================
    DESTROY TASK
===============================================*/
    public function destroy($id)
    {
        $delete_report = Report::find($id) ;
        $delete_report->delete() ;
        Session::flash('success', 'Report was deleted') ;
        return redirect()->back();
    }


}
